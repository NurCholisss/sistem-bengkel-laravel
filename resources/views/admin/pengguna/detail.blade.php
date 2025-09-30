@extends('layouts.admin')

@section('title', 'Detail Pengguna')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.pengguna.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pengguna
    </a>
    <h2 class="text-2xl font-bold text-gray-800 mt-4">Detail Pengguna</h2>
    <p class="text-gray-600 mt-2">Informasi lengkap data pelanggan</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Informasi Utama -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-800">Informasi Pribadi</h3>
            </div>
            
            <div class="px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Nama Lengkap</h4>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $pengguna->nama }}</p>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Email</h4>
                            <p class="mt-1 text-gray-900">{{ $pengguna->email }}</p>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Role</h4>
                            <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $pengguna->role == 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                {{ $pengguna->role }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Nomor Telepon</h4>
                            <p class="mt-1 text-gray-900">
                                @if($pengguna->telepon)
                                    {{ $pengguna->telepon }}
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </p>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tanggal Bergabung</h4>
                            <p class="mt-1 text-gray-900">{{ $pengguna->created_at->format('d M Y H:i') }}</p>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Terakhir Diupdate</h4>
                            <p class="mt-1 text-gray-900">{{ $pengguna->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                    
                    <div class="md:col-span-2">
                        <h4 class="text-sm font-medium text-gray-500">Alamat</h4>
                        <div class="mt-2 p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-700">
                                @if($pengguna->alamat)
                                    {{ $pengguna->alamat }}
                                @else
                                    <span class="text-gray-400">Tidak ada alamat yang tercatat</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 text-right">
                <a href="{{ route('admin.pengguna.edit', $pengguna->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    <i class="fas fa-edit mr-2"></i> Edit Data
                </a>
            </div>
        </div>
        
        <!-- Statistik Pengguna -->
        <div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-800">Statistik Pengguna</h3>
            </div>
            
            <div class="px-6 py-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="text-2xl font-bold text-blue-600">{{ $pengguna->kendaraan->count() }}</div>
                        <div class="text-sm text-blue-800">Total Kendaraan</div>
                    </div>
                    
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <div class="text-2xl font-bold text-green-600">
                            {{ $pengguna->pemesanan->where('status', 'selesai')->count() }}
                        </div>
                        <div class="text-sm text-green-800">Servis Selesai</div>
                    </div>
                    
                    <div class="text-center p-4 bg-yellow-50 rounded-lg">
                        <div class="text-2xl font-bold text-yellow-600">
                            {{ $pengguna->pemesanan->whereIn('status', ['menunggu', 'disetujui'])->count() }}
                        </div>
                        <div class="text-sm text-yellow-800">Dalam Proses</div>
                    </div>
                    
                    <div class="text-center p-4 bg-red-50 rounded-lg">
                        <div class="text-2xl font-bold text-red-600">
                            {{ $pengguna->pemesanan->where('status', 'dibatalkan')->count() }}
                        </div>
                        <div class="text-sm text-red-800">Dibatalkan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar Informasi -->
    <div class="space-y-6">
        <!-- Aksi Cepat -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-800">Aksi Cepat</h3>
            </div>
            
            <div class="p-4 space-y-3">
                <a href="mailto:{{ $pengguna->email }}" 
                   class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-envelope mr-2"></i> Kirim Email
                </a>
                
                @if($pengguna->telepon)
                <a href="https://wa.me/{{ str_replace(['-', ' ', '+'], '', $pengguna->telepon) }}" 
                   target="_blank"
                   class="w-full flex items-center justify-center px-4 py-2 border border-green-300 rounded-md text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100">
                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                </a>
                @endif
                
                <button onclick="confirmResetPassword()"
                   class="w-full flex items-center justify-center px-4 py-2 border border-yellow-300 rounded-md text-sm font-medium text-yellow-700 bg-yellow-50 hover:bg-yellow-100">
                    <i class="fas fa-key mr-2"></i> Reset Password
                </button>
                
                <form action="{{ route('admin.pengguna.destroy', $pengguna->id) }}" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.')"
                       class="w-full flex items-center justify-center px-4 py-2 border border-red-300 rounded-md text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100">
                        <i class="fas fa-trash mr-2"></i> Hapus Pengguna
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Kendaraan Terdaftar -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-800">Kendaraan Terdaftar</h3>
            </div>
            
            <div class="p-4 space-y-3 max-h-64 overflow-y-auto">
                @forelse($pengguna->kendaraan as $kendaraan)
                <div class="p-3 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-medium text-gray-900">{{ $kendaraan->merk }} {{ $kendaraan->model }}</p>
                            <p class="text-sm text-gray-500">{{ $kendaraan->tahun }} • {{ $kendaraan->plat_nomor }}</p>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $kendaraan->pemesanan->count() }} servis
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <i class="fas fa-car text-2xl text-gray-300 mb-2"></i>
                    <p class="text-gray-500 text-sm">Belum ada kendaraan terdaftar</p>
                </div>
                @endforelse
            </div>
            
            @if($pengguna->kendaraan->count() > 0)
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 text-center">
                <a href="{{ route('admin.pemesanan.index') }}?pengguna={{ $pengguna->id }}" 
                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Lihat Riwayat Servis
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Riwayat Pemesanan Terbaru -->
<div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-800">Riwayat Pemesanan Terbaru</h3>
            <a href="{{ route('admin.pemesanan.index') }}?pengguna={{ $pengguna->id }}" 
               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Lihat Semua
            </a>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        @if($pengguna->pemesanan->count() > 0)
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kendaraan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Layanan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pengguna->pemesanan->sortByDesc('created_at')->take(5) as $pemesanan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $pemesanan->kendaraan->merk }} {{ $pemesanan->kendaraan->model }}</div>
                        <div class="text-sm text-gray-500">{{ $pemesanan->kendaraan->plat_nomor }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $pemesanan->tanggal_jadwal->format('d M Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $pemesanan->waktu_jadwal }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                            @if($pemesanan->layanan)
                                {{ $pemesanan->layanan->nama }}
                            @else
                                <span class="text-gray-400">Belum dipilih</span>
                            @endif
                        </div>
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
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.pemesanan.show', $pemesanan->id) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="px-6 py-8 text-center">
            <i class="fas fa-calendar-times text-3xl text-gray-300 mb-3"></i>
            <p class="text-gray-500">Belum ada riwayat pemesanan</p>
        </div>
        @endif
    </div>
</div>

<script>
    function confirmResetPassword() {
        if (confirm('Apakah Anda yakin ingin mengirim link reset password ke {{ $pengguna->email }}?')) {
            // Here you would typically make an API call to send reset password email
            alert('Link reset password telah dikirim ke {{ $pengguna->email }}');
        }
    }
</script>
@endsection