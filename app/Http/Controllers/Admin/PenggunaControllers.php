<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaControllers extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::where('role', 'pelanggan')->get();
        return view('admin.pengguna.index', compact('pengguna'));
    }

    public function show($id)
    {
        $pengguna = Pengguna::with('kendaraan')->findOrFail($id);
        return view('admin.pengguna.detail', compact('pengguna'));
    }

    public function edit($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return view('admin.pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $pengguna = Pengguna::findOrFail($id);
        $pengguna->update($request->all());
        
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();
        
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus');
    }
}