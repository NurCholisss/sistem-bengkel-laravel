<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Http\Requests\SimpanLayananRequests;
use Illuminate\Http\Request;

class LayananControllers extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.buat');
    }

    public function store(SimpanLayananRequests $request)
    {
        Layanan::create($request->validated());
        
        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan');
    }

    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.detail', compact('layanan'));
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(SimpanLayananRequests $request, $id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->update($request->validated());
        
        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();
        
        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus');
    }
}