<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaControllers extends Controller
{
    public function index()
    {
        $pengguna = Auth::user();
        $totalKendaraan = Kendaraan::where('pengguna_id', $pengguna->id)->count();
        
        $pemesananTerbaru = Pemesanan::with('kendaraan')
            ->where('pengguna_id', $pengguna->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $statistikPemesanan = [
            'menunggu' => Pemesanan::where('pengguna_id', $pengguna->id)
                ->where('status', 'menunggu')->count(),
            'disetujui' => Pemesanan::where('pengguna_id', $pengguna->id)
                ->where('status', 'disetujui')->count(),
            'selesai' => Pemesanan::where('pengguna_id', $pengguna->id)
                ->where('status', 'selesai')->count(),
            'dibatalkan' => Pemesanan::where('pengguna_id', $pengguna->id)
                ->where('status', 'dibatalkan')->count(),
        ];

        return view('pelanggan.beranda', compact(
            'totalKendaraan',
            'pemesananTerbaru',
            'statistikPemesanan'
        ));
    }
}