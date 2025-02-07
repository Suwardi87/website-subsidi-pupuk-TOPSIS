<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\ProsesController;
use App\Http\Controllers\admin\TopsisController;
use App\Http\Controllers\admin\ProduksiController;
use App\Http\Controllers\admin\LuasTanahController;
use App\Http\Controllers\admin\HasilProduksiController;
use App\Http\Controllers\admin\DosisPemupukanController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::group(['middleware' => ['role:admin']], function () {
        Route::get('dashboard',[AdminController::class,'index'])->name('admin.index');
        Route::resource('luas-tanah', LuasTanahController::class)->names('backend.luas-tanah');
        Route::resource('biaya-produksi', ProduksiController::class)->names('backend.biaya-produksi');
        Route::resource('hasil-produksi', HasilProduksiController::class)->names('backend.hasil-produksi');
        Route::resource('dosis-pupuk', DosisPemupukanController::class)->names('backend.dosis-pupuk');
        Route::resource('proses', ProsesController::class)->names('backend.proses');
        Route::resource('topsis', TopsisController::class)->names('backend.topsis');
        Route::get('cetak/{preferenceValues}', [TopsisController::class, 'cetakPDF'])->name('backend.proses.cetak');
    // });

    // Route::group(['middleware' => ['role:petugasDinas']], function () {
        Route::resource('proses', ProsesController::class)->names('backend.proses');
        Route::put('/proses/verifikasi/{uuid}', [ProsesController::class, 'verifikasi'])->name('backend.proses.verifikasi');
    // });

    // Route::group(['middleware' => ['role:petani']], function () {
        Route::resource('proses', ProsesController::class)->names('backend.proses');
    // });
});

require __DIR__.'/auth.php';
