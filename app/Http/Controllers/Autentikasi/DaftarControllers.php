<?php

namespace App\Http\Controllers\Autentikasi;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DaftarControllers extends Controller
{
    public function index()
    {
        return view('autentikasi.daftar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'kata_sandi' => 'required|string|min:8|confirmed',
            'telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->kata_sandi),
            'role' => 'pelanggan',
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('masuk')
            ->with('success', 'Pendaftaran berhasil. Silakan masuk dengan akun Anda.');
    }
}