@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Layanan</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dasbor') }}">Dasbor</a></li>
            <li class="breadcrumb-item active">Layanan</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Layanan</h5>
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Layanan
        </a>
    </div>
    <div class="card-body">
        @if($layanan->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Layanan</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($layanan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.layanan.show', $item->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.layanan.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.layanan.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="bi bi-tools fs-1 text-muted"></i>
                <p class="text-muted mt-2">Belum ada layanan</p>
                <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Layanan Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection