@extends('layouts.admin')

@section('title', 'Detail Layanan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.layanan.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Layanan
    </a>
    <h2 class="text-2xl font-bold text-gray-800 mt-4">Detail Layanan</h2>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-800">Informasi Layanan</h3>
    </div>
    
    <div class="px-6 py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Informasi Utama -->
            <div class="space-y-6">
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Nama Layanan</h4>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $layanan->nama }}</p>
                </div>
                
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Harga</h4>
                    <p class="mt-1 text-2xl font-bold text-blue-600">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</p>
                </div>
                
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Tanggal Dibuat</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $layanan->created_at->format('d M Y H:i') }}</p>
                </div>
                
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Terakhir Diupdate</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $layanan->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
            
            <!-- Deskripsi -->
            <div>
                <h4 class="text-sm font-medium text-gray-500">Deskripsi Layanan</h4>
                <div class="mt-3 p-4 bg-gray-50 rounded-lg">
                    <p class="text-gray-700 leading-relaxed">
                        @if($layanan->deskripsi)
                            {{ $layanan->deskripsi }}
                        @else
                            <span class="text-gray-400">Tidak ada deskripsi</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Statistik Pemesanan -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h4 class="text-lg font-medium text-gray-800 mb-4">Statistik Pemesanan</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-50 p-4 rounded-lg text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ $layanan->pemesanan->count() }}</div>
                    <div class="text-sm text-blue-800">Total Pemesanan</div>
                </div>
                <div class="bg-green-50 p-4 rounded-lg text-center">
                    <div class="text-2xl font-bold text-green-600">
                        {{ $layanan->pemesanan->where('status', 'selesai')->count() }}
                    </div>
                    <div class="text-sm text-green-800">Pemesanan Selesai</div>
                </div>
                <div class="bg-yellow-50 p-4 rounded-lg text-center">
                    <div class="text-2xl font-bold text-yellow-600">
                        {{ $layanan->pemesanan->where('status', 'menunggu')->count() }}
                    </div>
                    <div class="text-sm text-yellow-800">Pemesanan Menunggu</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="px-6 py-4 bg-gray-50 text-right">
        <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md mr-3">
            <i class="fas fa-edit mr-2"></i> Edit Layanan
        </a>
        <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md" 
                onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                <i class="fas fa-trash mr-2"></i> Hapus Layanan
            </button>
        </form>
    </div>
</div>

<!-- Daftar Pemesanan Terkait -->
<div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-800">Pemesanan dengan Layanan Ini</h3>
    </div>
    
    <div class="overflow-x-auto">
        @if($layanan->pemesanan->count() > 0)
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kendaraan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($layanan->pemesanan->take(5) as $pemesanan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $pemesanan->pengguna->nama }}</div>
                        <div class="text-sm text-gray-500">{{ $pemesanan->pengguna->telepon }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $pemesanan->kendaraan->merk }} {{ $pemesanan->kendaraan->model }}</div>
                        <div class="text-sm text-gray-500">{{ $pemesanan->kendaraan->plat_nomor }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $pemesanan->tanggal_jadwal->format('d M Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $pemesanan->waktu_jadwal }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $pemesanan->status == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $pemesanan->status == 'disetujui' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $pemesanan->status == 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $pemesanan->status == 'dibatalkan' ? 'bg-red-100 text-red-800' : '' }}
                            capitalize">
                            {{ $pemesanan->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($layanan->pemesanan->count() > 5)
        <div class="px-6 py-4 text-center border-t border-gray-200">
            <a href="{{ route('admin.pemesanan.index') }}?layanan={{ $layanan->id }}" class="text-blue-600 hover:text-blue-800">
                Lihat semua {{ $layanan->pemesanan->count() }} pemesanan →
            </a>
        </div>
        @endif
        
        @else
        <div class="px-6 py-8 text-center">
            <i class="fas fa-calendar-times text-3xl text-gray-300 mb-3"></i>
            <p class="text-gray-500">Belum ada pemesanan dengan layanan ini</p>
        </div>
        @endif
    </div>
</div>
@endsection