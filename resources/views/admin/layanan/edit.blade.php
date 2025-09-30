@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.layanan.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Layanan
    </a>
    <h2 class="text-2xl font-bold text-gray-800 mt-4">Edit Layanan</h2>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Informasi Layanan</h3>
        </div>
        <div class="px-6 py-4">
            <div class="grid grid-cols-1 gap-6">
                <!-- Nama Layanan -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Layanan *</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $layanan->nama) }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Harga -->
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp) *</label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga', $layanan->harga) }}" min="0" step="1000"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    @error('harga')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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

<script>
    // Format harga input
    document.getElementById('harga').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\./g, '');
        if (!isNaN(value)) {
            e.target.value = new Intl.NumberFormat('id-ID').format(value);
        }
    });
</script>
@endsection