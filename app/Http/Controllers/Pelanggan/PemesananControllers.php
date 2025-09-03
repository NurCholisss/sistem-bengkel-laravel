<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Kendaraan;
use App\Models\Layanan;
use App\Http\Requests\SimpanPemesananRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananControllers extends Controller
{
    public function index()
    {
        $pengguna = Auth::user();
        $pemesanan = Pemesanan::with(['kendaraan', 'layanan'])
            ->where('pengguna_id', $pengguna->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pelanggan.pemesanan.index', compact('pemesanan'));
    }

    public function create()
    {
        $kendaraan = Kendaraan::where('pengguna_id', Auth::id())->get();
        $layanan = Layanan::all();
        return view('pelanggan.pemesanan.buat', compact('kendaraan', 'layanan'));
    }

    public function store(SimpanPemesananRequests $request)
    {
        $data = $request->validated();
        $data['pengguna_id'] = Auth::id();
        
        // Proses rekomendasi sistem
        $rekomendasi = app('App\Services\MesinAturanLayanan')
            ->prosesKeluhan($data['keluhan_pelanggan']);
            
        $data['rekomendasi_sistem'] = $rekomendasi;
        
        Pemesanan::create($data);
        
        return redirect()->route('pelanggan.pemesanan.index')
            ->with('success', 'Pemesanan berhasil dibuat. Sistem memberikan rekomendasi: ' . $rekomendasi);
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['kendaraan', 'layanan'])
            ->where('pengguna_id', Auth::id())
            ->findOrFail($id);
            
        return view('pelanggan.pemesanan.detail', compact('pemesanan'));
    }
}