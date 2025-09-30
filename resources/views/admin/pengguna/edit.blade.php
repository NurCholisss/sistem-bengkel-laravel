@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.pengguna.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pengguna
    </a>
    <h2 class="text-2xl font-bold text-gray-800 mt-4">Edit Data Pengguna</h2>
    <p class="text-gray-600 mt-2">Ubah informasi data pelanggan</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <form action="{{ route('admin.pengguna.update', $pengguna->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Informasi Pribadi</h3>
        </div>
        
        <div class="px-6 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $pengguna->nama) }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $pengguna->email) }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Telepon -->
                <div>
                    <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="tel" name="telepon" id="telepon" value="{{ old('telepon', $pengguna->telepon) }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: 081234567890">
                    @error('telepon')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" id="role" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        disabled>
                        <option value="pelanggan" {{ $pengguna->role == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                        <option value="admin" {{ $pengguna->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Role tidak dapat diubah</p>
                </div>
                
                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Alamat lengkap pengguna">{{ old('alamat', $pengguna->alamat) }}</textarea>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Informasi Tambahan -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h4 class="text-lg font-medium text-gray-800 mb-4">Informasi Sistem</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <div>
                        <p class="text-gray-600">Tanggal Bergabung:</p>
                        <p class="font-medium text-gray-900">{{ $pengguna->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Terakhir Diupdate:</p>
                        <p class="font-medium text-gray-900">{{ $pengguna->updated_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Total Kendaraan:</p>
                        <p class="font-medium text-gray-900">{{ $pengguna->kendaraan->count() }} kendaraan</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Total Pemesanan:</p>
                        <p class="font-medium text-gray-900">{{ $pengguna->pemesanan->count() }} pemesanan</p>
                    </div>
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

<!-- Reset Password Section -->
<div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-800">Reset Password</h3>
    </div>
    
    <div class="px-6 py-6">
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Perhatian</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>Fitur reset password akan mengirimkan email berisi link untuk reset password ke pengguna. Pastikan email pengguna valid.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-4 text-right">
            <button type="button" 
                onclick="confirmResetPassword()"
                class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-md">
                <i class="fas fa-key mr-2"></i> Kirim Link Reset Password
            </button>
        </div>
    </div>
</div>

<script>
    function confirmResetPassword() {
        if (confirm('Apakah Anda yakin ingin mengirim link reset password ke {{ $pengguna->email }}?')) {
            // Here you would typically make an API call to send reset password email
            alert('Link reset password telah dikirim ke {{ $pengguna->email }}');
        }
    }
    
    // Format phone number
    document.getElementById('telepon').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 0) {
            if (value.length <= 4) {
                value = value;
            } else if (value.length <= 8) {
                value = value.replace(/(\d{4})(\d+)/, '$1-$2');
            } else {
                value = value.replace(/(\d{4})(\d{4})(\d+)/, '$1-$2-$3');
            }
        }
        e.target.value = value;
    });
</script>
@endsection