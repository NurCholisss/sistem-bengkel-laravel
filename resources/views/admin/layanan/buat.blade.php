<!-- resources/views/admin/layanan/buat.blade.php -->
@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.layanan.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Layanan
    </a>
    <h2 class="text-2xl font-bold text-gray-800 mt-4">Tambah Layanan Baru</h2>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <form action="{{ route('admin.layanan.store') }}" method="POST">
        @csrf
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Informasi Layanan</h3>
        </div>
        <div class="px-6 py-4">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Layanan</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
                </div>
                
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga') }}" min="0" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                <i class="fas fa-save mr-2"></i> Simpan Layanan
            </button>
        </div>
    </form>
</div>
@endsection