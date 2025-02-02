<?php

namespace App\Http\Controllers;

use App\Models\Proses;
use App\Models\Produksi;
use App\Models\LuasTanah;
use App\Models\DosisPemupukan;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        $petaniCount = Proses::count();
        $produksiCount = Produksi::count();
        $totalLuasTanah = LuasTanah::sum('luas_lahan');
        $maxdosis = DosisPemupukan::max('dosis_pemupukan');

        return view('welcome', compact('petaniCount', 'produksiCount', 'totalLuasTanah', 'maxdosis'));

    }
}
