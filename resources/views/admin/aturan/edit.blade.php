@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Aturan</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dasbor') }}">Dasbor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.aturan.index') }}">Aturan</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Form Edit Aturan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.aturan.update', $aturan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="kata_kunci" class="form-label">Kata Kunci</label>
                <input type="text" class="form-control" id="kata_kunci" name="kata_kunci" value="{{ old('kata_kunci', $aturan->kata_kunci) }}" required>
                <div class="form-text">Pisahkan kata kunci dengan koma (contoh: oli,mesin,berisik)</div>
            </div>

            <div class="mb-3">
                <label for="rekomendasi" class="form-label">Rekomendasi</label>
                <textarea class="form-control" id="rekomendasi" name="rekomendasi" rows="4" required>{{ old('rekomendasi', $aturan->rekomendasi) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.aturan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection