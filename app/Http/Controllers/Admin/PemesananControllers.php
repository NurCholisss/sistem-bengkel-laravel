<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class PemesananControllers extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::with(['pengguna', 'kendaraan', 'layanan'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.pemesanan.index', compact('pemesanan'));
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['pengguna', 'kendaraan', 'layanan'])->findOrFail($id);
        return view('admin.pemesanan.detail', compact('pemesanan'));
    }

    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $layanan = Layanan::all();
        return view('admin.pemesanan.edit', compact('pemesanan', 'layanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,selesai,dibatalkan',
            'layanan_id' => 'nullable|exists:services,id',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update($request->all());

        return redirect()->route('admin.pemesanan.index')
            ->with('success', 'Pemesanan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('admin.pemesanan.index')
            ->with('success', 'Pemesanan berhasil dihapus');
    }
}