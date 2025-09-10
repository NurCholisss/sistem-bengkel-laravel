@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Pemesanan Baru</h1>
    <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pemesanan.store') }}" method="POST">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="pengguna_id" class="form-label">Pilih Pelanggan</label>
                    <select class="form-select" id="pengguna_id" name="pengguna_id" required>
                        <option value="">Pilih Pelanggan</option>
                        @foreach($pelanggan as $user)
                        <option value="{{ $user->id }}" {{ old('pengguna_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->nama }} - {{ $user->email }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label for="kendaraan_id" class="form-label">Pilih Kendaraan</label>
                    <select class="form-select" id="kendaraan_id" name="kendaraan_id" required>
                        <option value="">Pilih Kendaraan</option>
                        <!-- Kendaraan akan diisi via JavaScript -->
                    </select>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="layanan_id" class="form-label">Pilih Layanan</label>
                    <select class="form-select" id="layanan_id" name="layanan_id">
                        <option value="">Pilih Layanan</option>
                        @foreach($layanan as $item)
                        <option value="{{ $item->id }}" {{ old('layanan_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }} - Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label for="status" class="form-label">Status Pemesanan</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="menunggu" {{ old('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ old('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tanggal_jadwal" class="form-label">Tanggal Jadwal</label>
                    <input type="date" class="form-control" id="tanggal_jadwal" name="tanggal_jadwal" value="{{ old('tanggal_jadwal') }}" required>
                </div>
                
                <div class="col-md-6">
                    <label for="waktu_jadwal" class="form-label">Waktu Jadwal</label>
                    <input type="time" class="form-control" id="waktu_jadwal" name="waktu_jadwal" value="{{ old('waktu_jadwal') }}" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="keluhan_pelanggan" class="form-label">Keluhan Pelanggan</label>
                <textarea class="form-control" id="keluhan_pelanggan" name="keluhan_pelanggan" rows="4" required>{{ old('keluhan_pelanggan') }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="rekomendasi_sistem" class="form-label">Rekomendasi Sistem</label>
                <textarea class="form-control" id="rekomendasi_sistem" name="rekomendasi_sistem" rows="3">{{ old('rekomendasi_sistem') }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Buat Pemesanan</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const penggunaSelect = document.getElementById('pengguna_id');
        const kendaraanSelect = document.getElementById('kendaraan_id');
        
        penggunaSelect.addEventListener('change', function() {
            const userId = this.value;
            kendaraanSelect.innerHTML = '<option value="">Pilih Kendaraan</option>';
            
            if (userId) {
                // Fetch kendaraan berdasarkan user_id
                fetch(`/admin/kendaraan-by-user/${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(kendaraan => {
                            const option = document.createElement('option');
                            option.value = kendaraan.id;
                            option.textContent = `${kendaraan.merk} ${kendaraan.model} (${kendaraan.plat_nomor})`;
                            kendaraanSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
        
        // Trigger change event jika ada nilai sebelumnya
        if (penggunaSelect.value) {
            penggunaSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush
@endsection