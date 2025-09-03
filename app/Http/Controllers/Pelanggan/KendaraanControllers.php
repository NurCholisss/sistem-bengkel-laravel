<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendaraanControllers extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::where('pengguna_id', Auth::id())->get();
        return view('pelanggan.kendaraan.index', compact('kendaraan'));
    }

    public function create()
    {
        return view('pelanggan.kendaraan.buat');
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'plat_nomor' => 'required|string|max:20|unique:vehicles,plat_nomor',
        ]);

        $data = $request->all();
        $data['pengguna_id'] = Auth::id();
        
        Kendaraan::create($data);
        
        return redirect()->route('pelanggan.kendaraan.index')
            ->with('success', 'Kendaraan berhasil ditambahkan');
    }

    public function show($id)
    {
        $kendaraan = Kendaraan::where('pengguna_id', Auth::id())
            ->findOrFail($id);
            
        return view('pelanggan.kendaraan.detail', compact('kendaraan'));
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::where('pengguna_id', Auth::id())
            ->findOrFail($id);
            
        return view('pelanggan.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'plat_nomor' => 'required|string|max:20|unique:vehicles,plat_nomor,' . $id,
        ]);

        $kendaraan = Kendaraan::where('pengguna_id', Auth::id())
            ->findOrFail($id);
            
        $kendaraan->update($request->all());
        
        return redirect()->route('pelanggan.kendaraan.index')
            ->with('success', 'Kendaraan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::where('pengguna_id', Auth::id())
            ->findOrFail($id);
            
        // Cek apakah kendaraan digunakan dalam pemesanan
        if ($kendaraan->pemesanan()->count() > 0) {
            return redirect()->route('pelanggan.kendaraan.index')
                ->with('error', 'Tidak dapat menghapus kendaraan yang memiliki riwayat pemesanan');
        }
        
        $kendaraan->delete();
        
        return redirect()->route('pelanggan.kendaraan.index')
            ->with('success', 'Kendaraan berhasil dihapus');
    }
}