<?php

namespace App\Http\Controllers\admin;

use App\Models\Proses;
use App\Models\Produksi;
use App\Models\LuasTanah;
use App\Models\HasilProduksi;
use App\Models\DosisPemupukan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TopsisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all the necessary data
        $data = Proses::with(['luasTanah', 'BiayaProduksi', 'hasilProduksi', 'dosisPemupukan'])->get();

        // If no data found, return a message
        if ($data->isEmpty()) {
            return view('backend.proses.topsis')->with('message', 'Data not found');
        }

        // Retrieve weights for each criterion
        $bobot = $this->getBobot();

        //Data Mentah
        $dataMentah = $this->DataMentah($data);

        // Generate matrix X
        $matriksX = $this->generateMatriksX($data);

        // Normalize the matrix
        $normalisasi = $this->normalizeMatriks($matriksX, $bobot);

        // Normalize the matrix using the vector R
        $normalisasiR = $this->normalizeMatriksR($normalisasi);

        // Generate decision matrix (Y)
        $matriksKeputusan = $this->generateMatriksKeputusan($normalisasiR, $bobot);

        // Calculate the ideal solutions
        $solusiIdeal = $this->calculateIdealSolutions($matriksKeputusan);

        // // Calculate the distances to the ideal solutions (A+ and A-)
        $distances = $this->calculateDistances($normalisasi, $solusiIdeal);

        // // Calculate the preference values
        $preferenceValues = $this->calculatePreferenceValues($distances);

        // // Determine the best alternative based on the preference values
        $bestAlternative = $this->determineBestAlternative($preferenceValues);

        // Return the data to the view
        return view('backend.proses.topsis', [
            'data' => $data,
            'bobot' => $bobot,
            'dataMentah' => $dataMentah,
            'solusiIdeal' => $solusiIdeal,
            'distances' => $distances,
            'nilaiPreferensi' => $preferenceValues,
            'bestAlternative' => $bestAlternative,
            'matriksX' => $matriksX,
            'normalisasi' => $normalisasi,
            'normalisasiR' => $normalisasiR,
            'matriksKeputusan' => $matriksKeputusan,
        ]);
    }

    /**
     * Fetch the weight for each criterion from the database.
     */
    private function getBobot()
    {
        return [
            'luas_lahan' => (float) $this->getBobotForTable('luas_tanahs'),
            'dosis_pemupukan' => (float) $this->getBobotForTable('dosis_pemupukans'),
            'biaya_produksi' => (float) $this->getBobotForTable('biaya_produksis'),
            'hasil_produksi' => (float) $this->getBobotForTable('hasil_produksis'),
        ];
    }

    /**
     * Fetch the latest weight for a given table.
     */
    private function getBobotForTable(string $table)
    {
        return (float) DB::table($table)->latest()->value('bobot') ?: 0.0;
    }

    /**
     * Generate matrix X from the data.
     */
    private function DataMentah($data)
    {
        return $data->map(function ($item) {
            return [
                'luas_lahan' => (float) $item->luas_lahan . ' ha',
                'dosis_pemupukan' => (float) $item->dosis_pemupukan . ' kg',
                'biaya_produksi' => 'Rp. ' . number_format((float) $item->biaya_produksi, 0, ',', '.'),
                'hasil_produksi' => (float) $item->hasil_produksi . ' kg'
            ];
        })->toArray();
    }

    private function generateMatriksX($data)
    {
        return $data->map(function ($item) {
            return [
                'luas_lahan' => (float) $item->luasTanah->bobot,
                'dosis_pemupukan' => (float) $item->dosisPemupukan->bobot,
                'biaya_produksi' => (float) $item->biayaProduksi->bobot,
                'hasil_produksi' => (float) $item->hasilProduksi->bobot,
            ];
        })->toArray();
    }

    /**
     * Normalize the matrix X.
     */
    private function normalizeMatriks($matriksX, $bobot)
    {
        $sumBobot = array_sum($bobot);
        return array_map(function ($item) use ($bobot, $sumBobot) {
            return array_map(fn($val, $b) => (float) $val * ($b / $sumBobot), $item, $bobot);
        }, $matriksX);
    }


    /**
     * Normalize the matrix X using the vector R.
     */
    private function normalizeMatriksR($matriksX)
    {
        $r = array_map(function ($item) {
            return sqrt(array_sum(array_map(fn($v) => pow($v, 2), $item)));
        }, $matriksX);

        return array_map(function ($item, $index) use ($r) {
            return array_map(fn($v) => $v / $r[$index], $item);
        }, $matriksX, array_keys($matriksX));
    }


    /**
     * Create a decision matrix with weighted normalization (Y).
     */
    private function generateMatriksKeputusan($normalisasiR, $bobot)
    {
        return array_map(function ($item) use ($bobot) {
            return array_map(fn($v, $b) => $v * $b, $item, $bobot);
        }, $normalisasiR);
    }

    /**
     * Calculate the ideal solutions (A+ and A-).
     */
    private function calculateIdealSolutions($matriksKeputusan)
    {
        $columns = array_keys($matriksKeputusan[0]);
        $maxValues = array_map(fn($c) => max(array_column($matriksKeputusan, $c)), $columns);
        $minValues = array_map(fn($c) => min(array_column($matriksKeputusan, $c)), $columns);

        return [
            'max' => $maxValues,
            'min' => $minValues,
        ];
    }

    /**
     * Calculate the distances to the ideal solutions.
     */
    private function calculateDistances($normalisasiR, $sosialIdeal)
    {
        return array_map(function ($item) use ($sosialIdeal) {
            $jarakAPlus = 0;
            $jarakAMinus = 0;

            foreach ($sosialIdeal['max'] as $key => $solusi) {
                $jarakAPlus += pow(((float) ($item[$key] ?? 0) - $solusi), 2);
                $jarakAMinus += pow(((float) ($item[$key] ?? 0) - $sosialIdeal['min'][$key]), 2);
            }

            return [
                'name' => $item['name'] ?? 'Unknown', // Assuming 'user' relationship is set
                'jarak_a_plus' => sqrt($jarakAPlus),
                'jarak_a_minus' => sqrt($jarakAMinus),
            ];
        }, $normalisasiR);
    }

    // /**
    //  * Calculate the preference values.
    //  */
    private function calculatePreferenceValues($distances)
    {
        return array_map(function ($item) {
            $jarakAPlus = (float) $item['jarak_a_plus'];
            $jarakAMinus = (float) $item['jarak_a_minus'];

            $nilaiPreferensi = ($jarakAPlus + $jarakAMinus) != 0 ? $jarakAMinus / ($jarakAPlus + $jarakAMinus) : 0.0;
            return [
                'nama' => $item['name'],
                'nilai_preferensi' => $nilaiPreferensi
            ];
        }, $distances);
    }

    /**
     * Determine the best alternative based on the preference values.
     */
    private function determineBestAlternative($preferenceValues)
    {
        usort($preferenceValues, fn($a, $b) => $b['nilai_preferensi'] <=> $a['nilai_preferensi']);
        return $preferenceValues[0] ?? null;
    }

    /**
     * Return the best alternative.
     */
    public function bestAlternative()
    {
        $data = Proses::with(['luasTanah', 'BiayaProduksi', 'hasilProduksi', 'dosisPemupukan'])->get();
        $bobot = $this->getBobot();
        $matriksX = $this->generateMatriksX($data);
        $normalisasi = $this->normalizeMatriks($matriksX, $bobot);
        $normalisasiR = $this->normalizeMatriksR($normalisasi);
        $matriksKeputusan = $this->generateMatriksKeputusan($normalisasiR, $bobot);
        $solusiIdeal = $this->calculateIdealSolutions($matriksKeputusan);
        $distances = $this->calculateDistances($normalisasiR, $solusiIdeal);
        $preferenceValues = $this->calculatePreferenceValues($distances);
        return $this->determineBestAlternative($preferenceValues);
    }

}