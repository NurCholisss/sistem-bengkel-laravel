<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Pengguna;
use App\Models\Kendaraan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class DasborControllers extends Controller
{
    public function index()
    {
        $totalPelanggan = Pengguna::where('role', 'pelanggan')->count();
        $totalKendaraan = Kendaraan::count();
        $totalLayanan = Layanan::count();
        
        $pemesananTerbaru = Pemesanan::with(['pengguna', 'kendaraan'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $statistikPemesanan = [
            'menunggu' => Pemesanan::where('status', 'menunggu')->count(),
            'disetujui' => Pemesanan::where('status', 'disetujui')->count(),
            'selesai' => Pemesanan::where('status', 'selesai')->count(),
            'dibatalkan' => Pemesanan::where('status', 'dibatalkan')->count(),
        ];

        return view('admin.dasbor', compact(
            'totalPelanggan', 
            'totalKendaraan', 
            'totalLayanan',
            'pemesananTerbaru',
            'statistikPemesanan'
        ));
    }
}