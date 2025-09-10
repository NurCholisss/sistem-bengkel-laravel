@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Pemesanan</h1>
    <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Informasi Pemesanan</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">ID Pemesanan</th>
                        <td>{{ $pemesanan->id }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pemesanan</th>
                        <td>{{ $pemesanan->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Jadwal</th>
                        <td>{{ $pemesanan->tanggal_jadwal->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Jadwal</th>
                        <td>{{ $pemesanan->waktu_jadwal }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $pemesanan->status == 'menunggu' ? 'warning' : ($pemesanan->status == 'disetujui' ? 'success' : ($pemesanan->status == 'selesai' ? 'info' : 'danger')) }}">
                                {{ ucfirst($pemesanan->status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Informasi Pelanggan</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Nama</th>
                        <td>{{ $pemesanan->pengguna->nama }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $pemesanan->pengguna->email }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $pemesanan->pengguna->telepon ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $pemesanan->pengguna->alamat ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Informasi Kendaraan</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Merk</th>
                        <td>{{ $pemesanan->kendaraan->merk }}</td>
                    </tr>
                    <tr>
                        <th>Model</th>
                        <td>{{ $pemesanan->kendaraan->model }}</td>
                    </tr>
                    <tr>
                        <th>Tahun</th>
                        <td>{{ $pemesanan->kendaraan->tahun }}</td>
                    </tr>
                    <tr>
                        <th>Plat Nomor</th>
                        <td>{{ $pemesanan->kendaraan->plat_nomor }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Informasi Layanan</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Layanan Dipilih</th>
                        <td>{{ $pemesanan->layanan->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>{{ $pemesanan->layanan ? 'Rp ' . number_format($pemesanan->layanan->harga, 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Rekomendasi Sistem</th>
                        <td>{{ $pemesanan->rekomendasi_sistem ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Keluhan Pelanggan</h5>
    </div>
    <div class="card-body">
        <p>{{ $pemesanan->keluhan_pelanggan }}</p>
    </div>
</div>
@endsection