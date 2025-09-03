<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananControllers extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        return view('pelanggan.layanan.index', compact('layanan'));
    }

    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('pelanggan.layanan.detail', compact('layanan'));
    }
}