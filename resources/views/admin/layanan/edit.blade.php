@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Layanan</h1>
    <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Layanan</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $layanan->nama) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="harga" class="form-label">Harga (Rp)</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $layanan->harga) }}" min="0" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Perbarui Layanan</button>
        </form>
    </div>
</div>
@endsection