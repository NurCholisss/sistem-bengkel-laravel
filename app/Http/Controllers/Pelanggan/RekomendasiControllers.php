<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Services\MesinAturanLayanan;
use Illuminate\Http\Request;

class RekomendasiControllers extends Controller
{
    public function index(Request $request)
    {
        $keluhan = $request->input('keluhan', '');
        $rekomendasi = '';
        
        if (!empty($keluhan)) {
            $rekomendasi = app(MesinAturanLayanan::class)->prosesKeluhan($keluhan);
        }
        
        return view('pelanggan.rekomendasi.index', compact('keluhan', 'rekomendasi'));
    }
}