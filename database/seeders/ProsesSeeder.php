<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProsesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
/*************  ✨ Codeium Command 🌟  *************/
    public function run(): void
{
    $userId = 1;
    $data = [
        ['luas_lahan' => 4.5, 'biaya_produksi' => 81000000, 'hasil_produksi' => 6250, 'dosis_pemupukan' => 1912],
        ['luas_lahan' => 4.5, 'biaya_produksi' => 29250000, 'hasil_produksi' => 4750, 'dosis_pemupukan' => 150],
        ['luas_lahan' => 3, 'biaya_produksi' => 48000000, 'hasil_produksi' => 6250, 'dosis_pemupukan' => 1912],
        ['luas_lahan' => 1.5, 'biaya_produksi' => 6750000, 'hasil_produksi' => 5500, 'dosis_pemupukan' => 220],
        ['luas_lahan' => 2.4, 'biaya_produksi' => 28800000, 'hasil_produksi' => 8250, 'dosis_pemupukan' => 1275],
        ['luas_lahan' => 3, 'biaya_produksi' => 30000000, 'hasil_produksi' => 6000, 'dosis_pemupukan' => 175],
        ['luas_lahan' => 2.1, 'biaya_produksi' => 14700000, 'hasil_produksi' => 5200, 'dosis_pemupukan' => 637],
        ['luas_lahan' => 3, 'biaya_produksi' => 19500000, 'hasil_produksi' => 4000, 'dosis_pemupukan' => 140],
        ['luas_lahan' => 1.5, 'biaya_produksi' => 9250000, 'hasil_produksi' => 4750, 'dosis_pemupukan' => 1020],
        ['luas_lahan' => 1.5, 'biaya_produksi' => 6000000, 'hasil_produksi' => 3250, 'dosis_pemupukan' => 200],
        ['luas_lahan' => 3, 'biaya_produksi' => 40500000, 'hasil_produksi' => 8250, 'dosis_pemupukan' => 1275],
        ['luas_lahan' => 1.8, 'biaya_produksi' => 9900000, 'hasil_produksi' => 4750, 'dosis_pemupukan' => 150],
        ['luas_lahan' => 2.1, 'biaya_produksi' => 21700000, 'hasil_produksi' => 6500, 'dosis_pemupukan' => 892],
        ['luas_lahan' => 1.8, 'biaya_produksi' => 13800000, 'hasil_produksi' => 5050, 'dosis_pemupukan' => 220],
        ['luas_lahan' => 1.8, 'biaya_produksi' => 40500000, 'hasil_produksi' => 8250, 'dosis_pemupukan' => 765],
        ['luas_lahan' => 2.1, 'biaya_produksi' => 21700000, 'hasil_produksi' => 6000, 'dosis_pemupukan' => 175],
        ['luas_lahan' => 2.1, 'biaya_produksi' => 14700000, 'hasil_produksi' => 5200, 'dosis_pemupukan' => 637],
        ['luas_lahan' => 1.8, 'biaya_produksi' => 13800000, 'hasil_produksi' => 4000, 'dosis_pemupukan' => 140],
        ['luas_lahan' => 1.8, 'biaya_produksi' => 14700000, 'hasil_produksi' => 5050, 'dosis_pemupukan' => 637],
        ['luas_lahan' => 2.1, 'biaya_produksi' => 21700000, 'hasil_produksi' => 4500, 'dosis_pemupukan' => 200],
        ['luas_lahan' => 2.1, 'biaya_produksi' => 40500000, 'hasil_produksi' => 8250, 'dosis_pemupukan' => 1275],
        ['luas_lahan' => 1.8, 'biaya_produksi' => 21700000, 'hasil_produksi' => 6500, 'dosis_pemupukan' => 150],
        ['luas_lahan' => 2.4, 'biaya_produksi' => 21700000, 'hasil_produksi' => 7500, 'dosis_pemupukan' => 765],
        ['luas_lahan' => 2.1, 'biaya_produksi' => 14700000, 'hasil_produksi' => 5050, 'dosis_pemupukan' => 220],
        ['luas_lahan' => 2.1, 'biaya_produksi' => 21700000, 'hasil_produksi' => 6000, 'dosis_pemupukan' => 892],
        ['luas_lahan' => 1.5, 'biaya_produksi' => 21700000, 'hasil_produksi' => 6000, 'dosis_pemupukan' => 175],
        ['luas_lahan' => 2.4, 'biaya_produksi' => 21700000, 'hasil_produksi' => 6750, 'dosis_pemupukan' => 765],
        ['luas_lahan' => 2.1, 'biaya_produksi' => 21700000, 'hasil_produksi' => 5250, 'dosis_pemupukan' => 140],
        ['luas_lahan' => 1.8, 'biaya_produksi' => 40500000, 'hasil_produksi' => 8250, 'dosis_pemupukan' => 765],
        ['luas_lahan' => 2.4, 'biaya_produksi' => 21700000, 'hasil_produksi' => 5750, 'dosis_pemupukan' => 200],
        ['luas_lahan' => 3, 'biaya_produksi' => 21700000, 'hasil_produksi' => 6500, 'dosis_pemupukan' => 892],
        ['luas_lahan' => 3, 'biaya_produksi' => 21700000, 'hasil_produksi' => 5250, 'dosis_pemupukan' => 150],
        ['luas_lahan' => 3, 'biaya_produksi' => 21700000, 'hasil_produksi' => 6500, 'dosis_pemupukan' => 892],
        ['luas_lahan' => 2.4, 'biaya_produksi' => 21700000, 'hasil_produksi' => 6000, 'dosis_pemupukan' => 220],
        ['luas_lahan' => 2.1, 'biaya_produksi' => 21700000, 'hasil_produksi' => 6750, 'dosis_pemupukan' => 765],
    ];

    foreach ($data as $item) {
        DB::table('proses')->insertOrIgnore([
            'uuid' => Str::uuid(),
            'user_id' => $userId,
            'luas_lahan' => $item['luas_lahan'],
            'luas_tanah_id' => $this->getLuasTanahId($item['luas_lahan']),
            'biaya_produksi' => $item['biaya_produksi'],
            'biaya_produksi_id' => $this->getBiayaProduksiId($item['biaya_produksi']),
            'hasil_produksi' => $item['hasil_produksi'],
            'hasil_produksi_id' => $this->getHasilProduksiId($item['hasil_produksi']),
            'dosis_pemupukan' => $item['dosis_pemupukan'],
            'dosis_pemupukan_id' => $this->getDosisPemupukanId($item['dosis_pemupukan']),
        ]);
    }
}

/**
 * Menentukan luas_tanah_id berdasarkan luas lahan.
 */
private function getLuasTanahId(float $luasLahan): int
{
    return match (true) {
        $luasLahan <= 1.2 => 1,
        $luasLahan <= 1.5 => 2,
        $luasLahan <= 2.0 => 3,
        $luasLahan <= 2.5 => 4,
        default => 5,
    };
}

/**
 * Menentukan biaya_produksi_id berdasarkan biaya produksi.
 */
private function getBiayaProduksiId(float $biayaProduksi): int
{
    return match (true) {
        $biayaProduksi <= 9_000_000 => 1,
        $biayaProduksi <= 15_000_000 => 2,
        $biayaProduksi <= 22_000_000 => 3,
        $biayaProduksi <= 30_000_000 => 4,
        $biayaProduksi <= 40_000_000 => 5,
        default => 5,
    };
}

/**
 * Menentukan hasil_produksi_id berdasarkan jumlah hasil produksi.
 */
private function getHasilProduksiId(float $hasilProduksi): int
{
    return match (true) {
        $hasilProduksi <= 4000 => 1,
        $hasilProduksi <= 5000 => 2,
        $hasilProduksi <= 6000 => 3,
        $hasilProduksi <= 7500 => 4,
        $hasilProduksi <= 9000 => 5,
        default => 5,
    };
}

/**
 * Menentukan dosis_pemupukan_id berdasarkan jumlah dosis pemupukan.
 */
private function getDosisPemupukanId(float $dosisPemupukan): int
{
    return match (true) {
        $dosisPemupukan <= 200 => 1,
        $dosisPemupukan <= 500 => 2,
        $dosisPemupukan <= 1000 => 3,
        $dosisPemupukan <= 1500 => 4,
        $dosisPemupukan <= 2000 => 5,
        default => 5,
    };
}

}
