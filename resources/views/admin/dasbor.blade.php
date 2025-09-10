@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dasbor Admin</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active">Dasbor</li>
        </ol>
    </nav>
</div>

<!-- Statistik -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title">{{ $totalPelanggan }}</h5>
                        <p class="card-text mb-0">Total Pelanggan</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-people fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title">{{ $totalKendaraan }}</h5>
                        <p class="card-text mb-0">Total Kendaraan</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-car-front fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title">{{ $totalLayanan }}</h5>
                        <p class="card-text mb-0">Total Layanan</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-tools fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title">{{ array_sum($statistikPemesanan) }}</h5>
                        <p class="card-text mb-0">Total Pemesanan</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-calendar-check fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Pemesanan -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Statistik Pemesanan</h5>
            </div>
            <div class="card-body">
                <canvas id="statistikPemesananChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Pemesanan Terbaru</h5>
            </div>
            <div class="card-body">
                @if($pemesananTerbaru->count() > 0)
                    <div class="list-group">
                        @foreach($pemesananTerbaru as $pemesanan)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $pemesanan->pengguna->nama }}</h6>
                                        <small class="text-muted">{{ $pemesanan->kendaraan->merk }} {{ $pemesanan->kendaraan->model }}</small>
                                    </div>
                                    <span class="badge bg-{{ $pemesanan->status == 'menunggu' ? 'warning' : ($pemesanan->status == 'disetujui' ? 'primary' : ($pemesanan->status == 'selesai' ? 'success' : 'danger')) }}">
                                        {{ ucfirst($pemesanan->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Belum ada pemesanan</p>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statistikPemesananChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Menunggu', 'Disetujui', 'Selesai', 'Dibatalkan'],
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: [
                    {{ $statistikPemesanan['menunggu'] }},
                    {{ $statistikPemesanan['disetujui'] }},
                    {{ $statistikPemesanan['selesai'] }},
                    {{ $statistikPemesanan['dibatalkan'] }}
                ],
                backgroundColor: [
                    '#ffc107',
                    '#0d6efd',
                    '#198754',
                    '#dc3545'
                ]
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
@endsection