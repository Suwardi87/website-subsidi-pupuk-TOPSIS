<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\KomoditasController;
use App\Http\Controllers\admin\LuasTanahController;
use App\Http\Controllers\admin\MusimTanamController;
use App\Http\Controllers\admin\DosisPemupukanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('dashboard',[AdminController::class,'index'])->name('admin.index');
    Route::resource('luas-tanah', LuasTanahController::class)->names('backend.luas-tanah');
    Route::resource('komoditas', KomoditasController::class)->names('backend.komoditas');
    Route::resource('musim-tanam', MusimTanamController::class)->names('backend.musim-tanam');
    Route::resource('dosis-pupuk', DosisPemupukanController::class)->names('backend.dosis-pupuk');
});

require __DIR__.'/auth.php';
