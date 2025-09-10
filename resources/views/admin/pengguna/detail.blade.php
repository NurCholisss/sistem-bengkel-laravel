@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Pengguna</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dasbor') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pengguna.index') }}">Pengguna</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Informasi Pengguna</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Nama:</div>
                    <div class="col-md-9">{{ $pengguna->nama }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Email:</div>
                    <div class="col-md-9">{{ $pengguna->email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Telepon:</div>
                    <div class="col-md-9">{{ $pengguna->telepon ?? '-' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Alamat:</div>
                    <div class="col-md-9">{{ $pengguna->alamat ?? '-' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Terdaftar pada:</div>
                    <div class="col-md-9">{{ $pengguna->created_at->format('d F Y H:i') }}</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Kendaraan Pengguna</h5>
            </div>
            <div class="card-body">
                @if($pengguna->kendaraan->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Merk</th>
                                    <th>Model</th>
                                    <th>Tahun</th>
                                    <th>Plat Nomor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengguna->kendaraan as $kendaraan)
                                    <tr>
                                        <td>{{ $kendaraan->merk }}</td>
                                        <td>{{ $kendaraan->model }}</td>
                                        <td>{{ $kendaraan->tahun }}</td>
                                        <td>{{ $kendaraan->plat_nomor }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">Pengguna belum memiliki kendaraan terdaftar</p>
                @endif
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
                    <a href="{{ route('admin.pengguna.edit', $pengguna->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Pengguna
                    </a>
                    <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection