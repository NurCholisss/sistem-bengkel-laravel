<!-- resources/views/admin/pemesanan/detail.blade.php -->
@extends('layouts.admin')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.pemesanan.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pemesanan
    </a>
    <h2 class="text-2xl font-bold text-gray-800 mt-4">Detail Pemesanan</h2>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-800">Informasi Pemesanan</h3>
    </div>
    <div class="px-6 py-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="text-sm font-medium text-gray-500">Pelanggan</h4>
                <p class="mt-1 text-sm text-gray-900">{{ $pemesanan->pengguna->nama }}</p>
                <p class="text-sm text-gray-600">{{ $pemesanan->pengguna->telepon }}</p>
                <p class="text-sm text-gray-600">{{ $pemesanan->pengguna->alamat }}</p>
            </div>
            
            <div>
                <h4 class="text-sm font-medium text-gray-500">Kendaraan</h4>
                <p class="mt-1 text-sm text-gray-900">{{ $pemesanan->kendaraan->merk }} {{ $pemesanan->kendaraan->model }}</p>
                <p class="text-sm text-gray-600">Tahun: {{ $pemesanan->kendaraan->tahun }}</p>
                <p class="text-sm text-gray-600">Plat: {{ $pemesanan->kendaraan->plat_nomor }}</p>
            </div>
            
            <div>
                <h4 class="text-sm font-medium text-gray-500">Jadwal</h4>
                <p class="mt-1 text-sm text-gray-900">{{ $pemesanan->tanggal_jadwal->format('d M Y') }}</p>
                <p class="text-sm text-gray-600">Pukul: {{ $pemesanan->waktu_jadwal }}</p>
            </div>
            
            <div>
                <h4 class="text-sm font-medium text-gray-500">Status</h4>
                <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                    {{ $pemesanan->status == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $pemesanan->status == 'disetujui' ? 'bg-blue-100 text-blue-800' : '' }}
                    {{ $pemesanan->status == 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $pemesanan->status == 'dibatalkan' ? 'bg-red-100 text-red-800' : '' }}
                    capitalize">
                    {{ $pemesanan->status }}
                </span>
            </div>
            
            <div class="md:col-span-2">
                <h4 class="text-sm font-medium text-gray-500">Keluhan Pelanggan</h4>
                <p class="mt-1 text-sm text-gray-900">{{ $pemesanan->keluhan_pelanggan }}</p>
            </div>
            
            <div class="md:col-span-2">
                <h4 class="text-sm font-medium text-gray-500">Rekomendasi Sistem</h4>
                <p class="mt-1 text-sm text-gray-900">{{ $pemesanan->rekomendasi_sistem ?? 'Tidak ada rekomendasi' }}</p>
            </div>
            
            @if($pemesanan->layanan)
            <div>
                <h4 class="text-sm font-medium text-gray-500">Layanan Dipilih</h4>
                <p class="mt-1 text-sm text-gray-900">{{ $pemesanan->layanan->nama }}</p>
                <p class="text-sm text-gray-600">Rp {{ number_format($pemesanan->layanan->harga, 0, ',', '.') }}</p>
            </div>
            @endif
        </div>
    </div>
    <div class="px-6 py-4 bg-gray-50 text-right">
        <a href="{{ route('admin.pemesanan.edit', $pemesanan->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
            <i class="fas fa-edit mr-2"></i> Edit Pemesanan
        </a>
    </div>
</div>
@endsection