@extends('layouts.admin')

@section('title', 'Tambah Aturan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.aturan.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Aturan
    </a>
    <h2 class="text-2xl font-bold text-gray-800 mt-4">Tambah Aturan Baru</h2>
    <p class="text-gray-600 mt-2">Aturan digunakan oleh sistem untuk memberikan rekomendasi layanan berdasarkan keluhan pelanggan</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <form action="{{ route('admin.aturan.store') }}" method="POST">
        @csrf
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Informasi Aturan</h3>
        </div>
        
        <div class="px-6 py-6">
            <div class="grid grid-cols-1 gap-6">
                <!-- Kata Kunci -->
                <div>
                    <label for="kata_kunci" class="block text-sm font-medium text-gray-700 mb-2">
                        Kata Kunci *
                    </label>
                    <input type="text" name="kata_kunci" id="kata_kunci" value="{{ old('kata_kunci') }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: oli,mesin,berisik"
                        required>
                    <p class="mt-1 text-sm text-gray-500">
                        Pisahkan setiap kata kunci dengan koma. Sistem akan mencocokkan kata kunci ini dengan keluhan pelanggan.
                    </p>
                    @error('kata_kunci')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Rekomendasi -->
                <div>
                    <label for="rekomendasi" class="block text-sm font-medium text-gray-700 mb-2">
                        Rekomendasi *
                    </label>
                    <textarea name="rekomendasi" id="rekomendasi" rows="6" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Disarankan untuk melakukan ganti oli dan pengecekan mesin. Kemungkinan mesin berisik karena oli yang sudah kotor atau kurang."
                        required>{{ old('rekomendasi') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">
                        Tulis rekomendasi yang akan diberikan sistem ketika kata kunci terdeteksi dalam keluhan pelanggan.
                    </p>
                    @error('rekomendasi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Preview Section -->
            <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                <h4 class="text-sm font-medium text-blue-800 mb-3">Preview Aturan</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-blue-700 font-medium">Kata Kunci:</p>
                        <p id="preview-kata-kunci" class="text-sm text-gray-600 bg-white p-2 rounded mt-1 min-h-10">
                            <span class="text-gray-400">Akan muncul di sini...</span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-700 font-medium">Rekomendasi:</p>
                        <p id="preview-rekomendasi" class="text-sm text-gray-600 bg-white p-2 rounded mt-1 min-h-20">
                            <span class="text-gray-400">Akan muncul di sini...</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="px-6 py-4 bg-gray-50 text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                <i class="fas fa-save mr-2"></i> Simpan Aturan
            </button>
        </div>
    </form>
</div>

<script>
    // Real-time preview
    document.getElementById('kata_kunci').addEventListener('input', function(e) {
        const preview = document.getElementById('preview-kata-kunci');
        if (e.target.value.trim()) {
            const keywords = e.target.value.split(',').map(k => k.trim()).filter(k => k);
            preview.innerHTML = keywords.map(k => 
                `<span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs mr-1 mb-1">${k}</span>`
            ).join('');
        } else {
            preview.innerHTML = '<span class="text-gray-400">Akan muncul di sini...</span>';
        }
    });
    
    document.getElementById('rekomendasi').addEventListener('input', function(e) {
        const preview = document.getElementById('preview-rekomendasi');
        preview.textContent = e.target.value || 'Akan muncul di sini...';
    });
    
    // Initialize preview on page load
    document.addEventListener('DOMContentLoaded', function() {
        const kataKunciInput = document.getElementById('kata_kunci');
        const rekomendasiInput = document.getElementById('rekomendasi');
        
        if (kataKunciInput.value) {
            kataKunciInput.dispatchEvent(new Event('input'));
        }
        if (rekomendasiInput.value) {
            rekomendasiInput.dispatchEvent(new Event('input'));
        }
    });
</script>
@endsection