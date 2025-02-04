<?php

namespace App\Http\Services\Backend;

use App\Models\User;
use App\Models\Proses;
use App\Models\LuasTanah;
use App\Models\Produksi;
use App\Models\HasilProduksi;
use App\Models\DosisPemupukan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProsesService
{
    public function select()
    {
        return Proses::latest()
            ->paginate(10);
        // ->with('user:id,name', 'komoditas:id,nama', 'musimTanam:id,nama')
    }
    public function getFirstBy(string $column, string $value, bool $relation = false)
    {
        $query = Proses::where($column, $value);

        if ($relation) {
            $query->with('user:id,name');
        }

        return $query->firstOrFail();
    }
    public function getUser()
    {
        return User::latest()->get(['id', 'name']);
    }
    public function create(array $data)
{
    $userId = auth()->id();

    // Ambil bobot dari database dengan Eloquent
    $bobotLuasLahan = LuasTanah::pluck('bobot', 'id')->toArray();
    $bobotBiayaProduksi = Produksi::pluck('bobot', 'id')->toArray();
    $bobotHasilProduksi = HasilProduksi::pluck('bobot', 'id')->toArray();
    $bobotDosisPemupukan = DosisPemupukan::pluck('bobot', 'id')->toArray();

    // Fungsi untuk menentukan bobot berdasarkan rentang nilai
    function determineWeight($value, $bobotMap, $ranges)
    {
        foreach ($ranges as $index => $maxValue) {
            if ($value <= $maxValue) {
                return [
                    'bobot' => $bobotMap[$index + 1] ?? null,
                    'id' => $index + 1
                ];
            }
        }
        return [
            'bobot' => $bobotMap[count($ranges)] ?? null,
            'id' => count($ranges)
        ];
    }

    // Rentang nilai untuk setiap kriteria
    $rangesLuasLahan = [1.2, 1.5, 2.0, 2.5];
    $rangesBiayaProduksi = [9000000, 15000000, 22000000, 30000000];
    $rangesHasilProduksi = [4500, 6000, 7500, 9000];
    $rangesDosisPemupukan = [500, 1000, 1350, 1500];

    // Menentukan bobot untuk setiap kriteria
    $luasLahan = determineWeight($data['luas_lahan'], $bobotLuasLahan, $rangesLuasLahan);
    $biayaProduksi = determineWeight($data['biaya_produksi'] ?? 0, $bobotBiayaProduksi, $rangesBiayaProduksi);
    $hasilProduksi = determineWeight($data['hasil_produksi'] ?? 0, $bobotHasilProduksi, $rangesHasilProduksi);
    $dosisPemupukan = determineWeight($data['dosis_pemupukan'] ?? 0, $bobotDosisPemupukan, $rangesDosisPemupukan);

    try {
        // Simpan data menggunakan Eloquent
        $proses = Proses::create([
            'uuid' => Str::uuid(),
            'user_id' => $userId,
            'luas_lahan' => $data['luas_lahan'],
            'biaya_produksi' => $data['biaya_produksi'],
            'hasil_produksi' => $data['hasil_produksi'],
            'dosis_pemupukan' => $data['dosis_pemupukan'],
            'luas_tanah_id' => $luasLahan['id'],
            'biaya_produksi_id' => $biayaProduksi['id'],
            'hasil_produksi_id' => $hasilProduksi['id'],
            'dosis_pemupukan_id' => $dosisPemupukan['id'],
        ]);

        return redirect()->route('proses.index')->with('success', 'Data Petani Berhasil Ditambahkan');
    } catch (\Throwable $th) {
        return back()->with('error', 'Data Petani Gagal Ditambahkan: ' . $th->getMessage());
    }
}



    /**
     * Ambil bobot berdasarkan nama tabel dan ID.
     *
     * @param string $table Nama tabel.
     * @param int|null $id ID dari data.
     * @return float Bobot nilai dari tabel.
     */
    private function getBobotById(string $table, ?int $id)
    {
        $result = DB::table($table)->where('id', $id)->first();
        return $result ? $result->bobot : 0; // Return 0 jika data tidak ditemukan.
    }
    public function update(array $data, string $uuid)
    {
        $userId = auth()->user()->id;

        // Ambil semua bobot dalam satu query untuk efisiensi
        $bobotLuasLahan = DB::table('luas_tanahs')->pluck('bobot', 'id')->toArray();
        $bobotBiayaProduksi = DB::table('biaya_produksis')->pluck('bobot', 'id')->toArray();
        $bobotHasilProduksi = DB::table('hasil_produksis')->pluck('bobot', 'id')->toArray();
        $bobotDosisPemupukan = DB::table('dosis_pemupukans')->pluck('bobot', 'id')->toArray();

        // Fungsi untuk menentukan bobot berdasarkan rentang nilai
        $getBobot = function ($value, $bobotMap, $ranges) {
            foreach ($ranges as $index => $maxValue) {
                if ($value <= $maxValue) {
                    return [
                        'bobot' => $bobotMap[$index + 1] ?? null,
                        'id' => $index + 1
                    ];
                }
            }
            return [
                'bobot' => $bobotMap[count($ranges)] ?? null,
                'id' => count($ranges)
            ];
        };

        // Definisi rentang nilai untuk tiap kriteria
        $rangesLuasLahan = [1.2, 1.5, 2.0, 2.5,4.5];
        $rangesBiayaProduksi = [9000000, 15000000, 22000000, 30000000, 40000000];
        $rangesHasilProduksi = [4500, 6000, 7500, 9000];
        $rangesDosisPemupukan = [500, 1000, 1350, 1500];

        // Tentukan bobot berdasarkan nilai input
        $luasLahan = $getBobot($data['luas_lahan'] ?? 0, $bobotLuasLahan, $rangesLuasLahan);
        $biayaProduksi = $getBobot($data['biaya_produksi'] ?? 0, $bobotBiayaProduksi, $rangesBiayaProduksi);
        $hasilProduksi = $getBobot($data['hasil_produksi'] ?? 0, $bobotHasilProduksi, $rangesHasilProduksi);
        $dosisPemupukan = $getBobot($data['dosis_pemupukan'] ?? 0, $bobotDosisPemupukan, $rangesDosisPemupukan);

        // Simpan data ke database
        return DB::transaction(function () use ($userId, $uuid, $luasLahan, $biayaProduksi, $hasilProduksi, $dosisPemupukan, $data) {
            DB::table('proses')->where('uuid', $uuid)->update([
                'user_id' => $userId,
                'luas_lahan' => $data['luas_lahan'] ?? 0,
                'luas_tanah_id' => $luasLahan['id'] ?? 1,
                'biaya_produksi' => $data['biaya_produksi'] ?? 0,
                'biaya_produksi_id' => $biayaProduksi['id'] ?? 1,
                'hasil_produksi' => $data['hasil_produksi'] ?? 0,
                'hasil_produksi_id' => $hasilProduksi['id'] ?? 1,
                'dosis_pemupukan' => $data['dosis_pemupukan'] ?? 0,
                'dosis_pemupukan_id' => $dosisPemupukan['id'] ?? 1,
                'updated_at' => now()
            ]);
        });
    }

    public function delete(string $uuid)
    {
        return Proses::where('uuid', $uuid)->delete();
    }
}
