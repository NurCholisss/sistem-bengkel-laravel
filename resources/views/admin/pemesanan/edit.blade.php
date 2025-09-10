@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Pemesanan</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dasbor') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pemesanan.index') }}">Pemesanan</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Form Edit Pemesanan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
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
                    <strong>{{ $pemesanan->pengguna->nama }}</strong> - 
                    {{ $pemesanan->pengguna->email }} - 
                    {{ $pemesanan->pengguna->telepon ?? '-' }}
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Kendaraan</label>
                <div class="form-control bg-light">
                    {{ $pemesanan->kendaraan->merk }} {{ $pemesanan->kendaraan->model }} 
                    ({{ $pemesanan->kendaraan->tahun }}) - 
                    {{ $pemesanan->kendaraan->plat_nomor }}
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Jadwal</label>
                <div class="form-control bg-light">
                    {{ $pemesanan->tanggal_jadwal->format('d F Y') }} - {{ $pemesanan->waktu_jadwal }}
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Keluhan Pelanggan</label>
                <textarea class="form-control bg-light" rows="3" readonly>{{ $pemesanan->keluhan_pelanggan }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Rekomendasi Sistem</label>
                <textarea class="form-control bg-light" rows="3" readonly>{{ $pemesanan->rekomendasi_sistem }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection