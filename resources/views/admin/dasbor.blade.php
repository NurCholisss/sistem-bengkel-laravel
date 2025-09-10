@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dasbor Admin</h1>
</div>

<div class="row">
    <!-- Statistik Cards -->
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title">Pelanggan</h5>
                        <h2 class="card-text">{{ $totalPelanggan }}</h2>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-people fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title">Kendaraan</h5>
                        <h2 class="card-text">{{ $totalKendaraan }}</h2>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-car-front fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title">Layanan</h5>
                        <h2 class="card-text">{{ $totalLayanan }}</h2>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-tools fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title">Pemesanan</h5>
                        <h2 class="card-text">{{ array_sum($statistikPemesanan) }}</h2>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="bi bi-calendar-check fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Statistik Pemesanan -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Statistik Pemesanan</h5>
            </div>
            <div class="card-body">
                <canvas id="pemesananChart" height="250"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Pemesanan Terbaru -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Pemesanan Terbaru</h5>
                <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Pelanggan</th>
                                <th>Kendaraan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesananTerbaru as $pemesanan)
                            <tr>
                                <td>{{ $pemesanan->pengguna->nama }}</td>
                                <td>{{ $pemesanan->kendaraan->merk }} {{ $pemesanan->kendaraan->model }}</td>
                                <td>{{ $pemesanan->tanggal_jadwal->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $pemesanan->status == 'menunggu' ? 'warning' : ($pemesanan->status == 'disetujui' ? 'success' : ($pemesanan->status == 'selesai' ? 'info' : 'danger')) }}">
                                        {{ ucfirst($pemesanan->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('pemesananChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Menunggu', 'Disetujui', 'Selesai', 'Dibatalkan'],
                datasets: [{
                    data: [
                        {{ $statistikPemesanan['menunggu'] }},
                        {{ $statistikPemesanan['disetujui'] }},
                        {{ $statistikPemesanan['selesai'] }},
                        {{ $statistikPemesanan['dibatalkan'] }}
                    ],
                    backgroundColor: [
                        '#ffc107',
                        '#198754',
                        '#0dcaf0',
                        '#dc3545'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection