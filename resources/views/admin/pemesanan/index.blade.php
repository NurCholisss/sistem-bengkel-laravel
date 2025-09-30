<!-- resources/views/admin/pemesanan/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Manajemen Pemesanan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Manajemen Pemesanan</h2>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kendaraan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($pemesanan as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $item->pengguna->nama }}</div>
                        <div class="text-sm text-gray-500">{{ $item->pengguna->telepon }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $item->kendaraan->merk }} {{ $item->kendaraan->model }}</div>
                        <div class="text-sm text-gray-500">{{ $item->kendaraan->plat_nomor }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $item->tanggal_jadwal->format('d M Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $item->waktu_jadwal }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $item->status == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $item->status == 'disetujui' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $item->status == 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $item->status == 'dibatalkan' ? 'bg-red-100 text-red-800' : '' }}
                            capitalize">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.pemesanan.show', $item->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.pemesanan.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.pemesanan.destroy', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus pemesanan ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada data pemesanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection