<!-- resources/views/admin/dasbor.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin</h2>
    <p class="text-gray-600">Ringkasan data dan statistik sistem</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600">Total Pelanggan</p>
                <h3 class="text-2xl font-bold">{{ $totalPelanggan }}</h3>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-car text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600">Total Kendaraan</p>
                <h3 class="text-2xl font-bold">{{ $totalKendaraan }}</h3>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-tools text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600">Total Layanan</p>
                <h3 class="text-2xl font-bold">{{ $totalLayanan }}</h3>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-calendar-check text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600">Total Pemesanan</p>
                <h3 class="text-2xl font-bold">{{ array_sum($statistikPemesanan) }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Two Column Layout -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Pemesanan Status Chart -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Statistik Pemesanan</h3>
        <div class="space-y-4">
            @foreach($statistikPemesanan as $status => $jumlah)
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-sm font-medium capitalize">{{ $status }}</span>
                    <span class="text-sm font-medium">{{ $jumlah }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    @php
                    $total = array_sum($statistikPemesanan);
                    $width = $total > 0 ? ($jumlah / $total) * 100 : 0;
                    $color = [
                        'menunggu' => 'bg-yellow-500',
                        'disetujui' => 'bg-blue-500',
                        'selesai' => 'bg-green-500',
                        'dibatalkan' => 'bg-red-500'
                    ][$status];
                    @endphp
                    <div class="h-2 rounded-full {{ $color }}" style="width: {{ $width }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- Recent Bookings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Pemesanan Terbaru</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="text-left border-b">
                        <th class="py-2">Pelanggan</th>
                        <th class="py-2">Kendaraan</th>
                        <th class="py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemesananTerbaru as $pemesanan)
                    <tr class="border-b">
                        <td class="py-2">{{ $pemesanan->pengguna->nama }}</td>
                        <td class="py-2">{{ $pemesanan->kendaraan->merk }} {{ $pemesanan->kendaraan->model }}</td>
                        <td class="py-2">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $pemesanan->status == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $pemesanan->status == 'disetujui' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $pemesanan->status == 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $pemesanan->status == 'dibatalkan' ? 'bg-red-100 text-red-800' : '' }}
                                capitalize">
                                {{ $pemesanan->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-gray-500">Tidak ada pemesanan terbaru</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 text-right">
            <a href="{{ route('admin.pemesanan.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                Lihat semua pemesanan →
            </a>
        </div>
    </div>
</div>
@endsection