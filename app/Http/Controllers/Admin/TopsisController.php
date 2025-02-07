<?php

namespace App\Http\Controllers\Admin;

use App\Models\Proses;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TopsisController extends Controller
{
    public function index()
    {
        $data = Proses::with(['user:id,name', 'luasTanah', 'BiayaProduksi', 'HasilProduksi', 'DosisPemupukan'])->get();

        if ($data->isEmpty()) {
            return view('backend.proses.topsis', ['message' => 'Data not found']);
        }

        $bobot = $this->getBobot();
        //Data Mentah
        $dataMentah = $this->DataMentah($data);
        $matriksX = $this->generateMatriksX($data);
        $normalisasi = $this->normalizeMatriks($matriksX, $bobot);
        $matriksKeputusan = $this->generateMatriksKeputusan($normalisasi, $bobot);
        $solusiIdeal = $this->calculateIdealSolutions($matriksKeputusan);
        $distances = $this->calculateDistances($matriksKeputusan, $solusiIdeal);
        $preferenceValues = $this->calculatePreferenceValues($distances);
        $bestAlternative = $this->determineBestAlternative($preferenceValues);
        $top35Alternatives = $this->getTop35Alternatives($preferenceValues);
        $top5Alternatives = $this->getTop5Alternatives($preferenceValues);

        return view('backend.proses.topsis', compact(
            'data',
            'bobot',
            'dataMentah',
            'matriksX',
            'normalisasi',
            'matriksKeputusan',
            'solusiIdeal',
            'distances',
            'preferenceValues',
            'bestAlternative',
            'top35Alternatives',
            'top5Alternatives'
        ));
    }


    // private function getBobot()
    // {
    //     return [
    //         'luas_lahan' => (float) DB::table('luas_tanahs')->latest()->value('bobot') ?: 0.0,
    //         'dosis_pemupukan' => (float) DB::table('dosis_pemupukans')->latest()->value('bobot') ?: 0.0,
    //         'biaya_produksi' => (float) DB::table('biaya_produksis')->latest()->value('bobot') ?: 0.0,
    //         'hasil_produksi' => (float) DB::table('hasil_produksis')->latest()->value('bobot') ?: 0.0,
    //     ];
    // }
    private function getBobot()
    {
        return [
            'luas_lahan' => 0.4,
            'biaya_produksi' => 0.3,
            'hasil_produksi' => 0.2,
            'dosis_pemupukan' => 0.1,
        ];
    }


    private function DataMentah($data)
    {
        return $data->map(function ($item) {
            return [
                'luas_lahan' => (float) $item->luas_lahan . ' ha',
                'biaya_produksi' => 'Rp. ' . number_format((float) $item->biaya_produksi, 0, ',', '.'),
                'hasil_produksi' => (float) $item->hasil_produksi . ' kg',
                'dosis_pemupukan' => (float) $item->dosis_pemupukan . ' kg',
            ];
        })->toArray();
    }

    private function generateMatriksX($data)
    {
        return $data->map(function ($item) {
            return [
                'luas_lahan' => (float) $item->luasTanah->bobot,
                'biaya_produksi' => (float) $item->biayaProduksi->bobot,
                'hasil_produksi' => (float) $item->hasilProduksi->bobot,
                'dosis_pemupukan' => (float) $item->dosisPemupukan->bobot,
            ];
        })->toArray();
    }



    private function normalizeMatriks($matriksX, $bobot)
{
    $squaredSums = [];

    // Menghitung akar kuadrat dari jumlah kuadrat untuk setiap kriteria
    foreach ($matriksX[0] as $key => $value) {
        $squaredSums[$key] = sqrt(array_sum(array_map(fn($val) => $val ** 2, array_column($matriksX, $key))));
    }

    // Normalisasi matriks dengan membagi nilai tiap elemen dengan akar jumlah kuadratnya
    return array_map(function ($item) use ($squaredSums) {
        return array_map(fn($val, $key) => $val / ($squaredSums[$key] ?: 1), $item, array_keys($item));
    }, $matriksX);
}


private function generateMatriksKeputusan($normalisasi)
{
    $bobot = $this->getBobot();

    // Pecah bobot jadi array kolom per indeks
    $weightedColumns = array_map(null, ...array_values($normalisasi));

    $weightedMatriks = array_map(function ($column, $index) use ($bobot) {
        return array_map(fn($val) => $val * ($bobot[$index] ?? 1), $column);
    }, $weightedColumns, array_keys($bobot));
    return array_map(null, ...$weightedMatriks);
}







    private function calculateIdealSolutions($matriksKeputusan)
    {
        $columns = array_keys($matriksKeputusan[0]);
        return [
            'max' => array_map(fn($col) => max(array_column($matriksKeputusan, $col)), $columns),
            'min' => array_map(fn($col) => min(array_column($matriksKeputusan, $col)), $columns),
        ];
    }

    private function calculateDistances($matriksKeputusan, $solusiIdeal)
    {
        return array_map(function ($item) use ($solusiIdeal) {
            $dPlus = sqrt(array_sum(array_map(fn($key) => pow(($item[$key] - $solusiIdeal['max'][$key]), 2), array_keys($item))));
            $dMinus = sqrt(array_sum(array_map(fn($key) => pow(($item[$key] - $solusiIdeal['min'][$key]), 2), array_keys($item))));

            return ['d_plus' => $dPlus, 'd_minus' => $dMinus];
        }, $matriksKeputusan);
    }

    private function calculatePreferenceValues($distances)
    {
        return array_map(function ($item) {
            $total = $item['d_plus'] + $item['d_minus'];
            return $total != 0 ? $item['d_minus'] / $total : 0;
        }, $distances);
    }

    private function determineBestAlternative($preferenceValues)
    {
        $maxValue = max($preferenceValues);
        $index = array_search($maxValue, $preferenceValues);
        return ['alternatif' => 'A' . ($index + 1), 'nilai_preferensi' => number_format($maxValue, 4)];
    }

    private function getTop35Alternatives($preferenceValues)
    {
        arsort($preferenceValues);
        return array_slice(array_map(function ($value, $index) {
            return ['alternatif' => 'A' . ($index + 1), 'nilai_preferensi' => number_format($value, 4)];
        }, $preferenceValues, array_keys($preferenceValues)), 0, 35);
    }

    private function getTop5Alternatives($preferenceValues)
    {
        arsort($preferenceValues);
        return array_slice(array_map(function ($value, $index) {
            return ['alternatif' => 'A' . ($index + 1), 'nilai_preferensi' => number_format($value, 4)];
        }, $preferenceValues, array_keys($preferenceValues)), 0, 5);
    }

    public function cetakPDF()
    {
        $data = Proses::with(['user:id,name', 'luasTanah', 'BiayaProduksi', 'HasilProduksi', 'DosisPemupukan'])->get();

        if ($data->isEmpty()) {
            return view('backend.proses.topsis', ['message' => 'Data not found']);
        }

        $bobot = $this->getBobot();
        //Data Mentah
        $dataMentah = $this->DataMentah($data);
        $matriksX = $this->generateMatriksX($data);
        $normalisasi = $this->normalizeMatriks($matriksX, $bobot);
        $matriksKeputusan = $this->generateMatriksKeputusan($normalisasi, $bobot);
        $solusiIdeal = $this->calculateIdealSolutions($matriksKeputusan);
        $distances = $this->calculateDistances($matriksKeputusan, $solusiIdeal);

        $preferenceValues = $this->calculatePreferenceValues($distances); // Pastikan variabel ini ada
        // Ambil Top 5 Alternatif langsung
        $top5Alternatives = $this->getTop5Alternatives($preferenceValues);

        // Debugging (pastikan nilainya benar sebelum cetak PDF)

        // Load tampilan PDF dan cetak
        $pdf = Pdf::loadView('backend.proses.cetak', compact('top5Alternatives'));
        return $pdf->download('laporan.pdf');
    }
}
