<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aturan;
use Illuminate\Http\Request;

class AturanControllers extends Controller
{
    public function index()
    {
        $aturan = Aturan::all();
        return view('admin.aturan.index', compact('aturan'));
    }

    public function create()
    {
        return view('admin.aturan.buat');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kata_kunci' => 'required|string|max:255',
            'rekomendasi' => 'required|string',
        ]);

        Aturan::create($request->all());
        
        return redirect()->route('admin.aturan.index')
            ->with('success', 'Aturan berhasil ditambahkan');
    }

    public function show($id)
    {
        $aturan = Aturan::findOrFail($id);
        return view('admin.aturan.detail', compact('aturan'));
    }

    public function edit($id)
    {
        $aturan = Aturan::findOrFail($id);
        return view('admin.aturan.edit', compact('aturan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kata_kunci' => 'required|string|max:255',
            'rekomendasi' => 'required|string',
        ]);

        $aturan = Aturan::findOrFail($id);
        $aturan->update($request->all());
        
        return redirect()->route('admin.aturan.index')
            ->with('success', 'Aturan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $aturan = Aturan::findOrFail($id);
        $aturan->delete();
        
        return redirect()->route('admin.aturan.index')
            ->with('success', 'Aturan berhasil dihapus');
    }
}