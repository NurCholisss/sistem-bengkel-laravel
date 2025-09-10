@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Layanan</h1>
    <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="20%">ID Layanan</th>
                <td>{{ $layanan->id }}</td>
            </tr>
            <tr>
                <th>Nama Layanan</th>
                <td>{{ $layanan->nama }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $layanan->deskripsi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Dibuat Pada</th>
                <td>{{ $layanan->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th>Diperbarui Pada</th>
                <td>{{ $layanan->updated_at->format('d/m/Y H:i') }}</td>
            </tr>
        </table>
        
        <div class="mt-4">
            <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit Layanan
            </a>
        </div>
    </div>
</div>
@endsection