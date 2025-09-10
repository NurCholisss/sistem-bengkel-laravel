@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Pemesanan</h1>
    <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="status" class="form-label">Status Pemesanan</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="menunggu" {{ $pemesanan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ $pemesanan->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="selesai" {{ $pemesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $pemesanan->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label for="layanan_id" class="form-label">Layanan</label>
                    <select class="form-select" id="layanan_id" name="layanan_id">
                        <option value="">Pilih Layanan</option>
                        @foreach($layanan as $item)
                        <option value="{{ $item->id }}" {{ $pemesanan->layanan_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }} - Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Informasi Pelanggan</label>
                <div class="form-control bg-light">
                    <strong>{{ $pemesanan->pengguna->nama }}</strong> - {{ $pemesanan->pengguna->email }}
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Informasi Kendaraan</label>
                <div class="form-control bg-light">
                    {{ $pemesanan->kendaraan->merk }} {{ $pemesanan->kendaraan->model }} ({{ $pemesanan->kendaraan->tahun }}) - {{ $pemesanan->kendaraan->plat_nomor }}
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Jadwal</label>
                <div class="form-control bg-light">
                    {{ $pemesanan->tanggal_jadwal->format('d/m/Y') }} - {{ $pemesanan->waktu_jadwal }}
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Keluhan Pelanggan</label>
                <div class="form-control bg-light" style="min-height: 100px;">
                    {{ $pemesanan->keluhan_pelanggan }}
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Rekomendasi Sistem</label>
                <div class="form-control bg-light" style="min-height: 100px;">
                    {{ $pemesanan->rekomendasi_sistem ?? 'Tidak ada rekomendasi' }}
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection