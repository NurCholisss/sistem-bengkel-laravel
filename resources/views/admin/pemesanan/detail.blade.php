@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Pemesanan</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dasbor') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pemesanan.index') }}">Pemesanan</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Informasi Pemesanan</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Pelanggan:</div>
                    <div class="col-md-8">{{ $pemesanan->pengguna->nama }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Email:</div>
                    <div class="col-md-8">{{ $pemesanan->pengguna->email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Telepon:</div>
                    <div class="col-md-8">{{ $pemesanan->pengguna->telepon ?? '-' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Kendaraan:</div>
                    <div class="col-md-8">{{ $pemesanan->kendaraan->merk }} {{ $pemesanan->kendaraan->model }} ({{ $pemesanan->kendaraan->tahun }}) - {{ $pemesanan->kendaraan->plat_nomor }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Tanggal:</div>
                    <div class="col-md-8">{{ $pemesanan->tanggal_jadwal->format('d F Y') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Waktu:</div>
                    <div class="col-md-8">{{ $pemesanan->waktu_jadwal }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Status:</div>
                    <div class="col-md-8">
                        <span class="badge bg-{{ $pemesanan->status == 'menunggu' ? 'warning' : ($pemesanan->status == 'disetujui' ? 'primary' : ($pemesanan->status == 'selesai' ? 'success' : 'danger')) }}">
                            {{ ucfirst($pemesanan->status) }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Layanan:</div>
                    <div class="col-md-8">{{ $pemesanan->layanan ? $pemesanan->layanan->nama : 'Belum dipilih' }}</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Keluhan & Rekomendasi</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="fw-bold">Keluhan Pelanggan:</label>
                    <p class="text-muted">{{ $pemesanan->keluhan_pelanggan }}</p>
                </div>
                <div>
                    <label class="fw-bold">Rekomendasi Sistem:</label>
                    <p class="text-muted">{{ $pemesanan->rekomendasi_sistem ?? 'Tidak ada rekomendasi' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Aksi</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.pemesanan.edit', $pemesanan->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Pemesanan
                    </a>
                    <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection