@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Aturan</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dasbor') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.aturan.index') }}">Aturan</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Informasi Aturan</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Kata Kunci:</div>
                    <div class="col-md-9">
                        @foreach(explode(',', $aturan->kata_kunci) as $kata)
                            <span class="badge bg-primary me-1">{{ trim($kata) }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Rekomendasi:</div>
                    <div class="col-md-9">{{ $aturan->rekomendasi }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Dibuat pada:</div>
                    <div class="col-md-9">{{ $aturan->created_at->format('d F Y H:i') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Diperbarui pada:</div>
                    <div class="col-md-9">{{ $aturan->updated_at->format('d F Y H:i') }}</div>
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
                    <a href="{{ route('admin.aturan.edit', $aturan->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Aturan
                    </a>
                    <a href="{{ route('admin.aturan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection