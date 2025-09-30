<!-- resources/views/admin/pemesanan/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Pemesanan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.pemesanan.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pemesanan
    </a>
    <h2 class="text-2xl font-bold text-gray-800 mt-4">Edit Pemesanan</h2>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Informasi Pemesanan</h3>
        </div>
        <div class="px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="menunggu" {{ $pemesanan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ $pemesanan->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="selesai" {{ $pemesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $pemesanan->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Layanan</label>
                    <select name="layanan_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Layanan</option>
                        @foreach($layanan as $item)
                        <option value="{{ $item->id }}" {{ $pemesanan->layanan_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }} - Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection