<div class="sidebar-sticky pt-3">
    <div class="text-center mb-4">
        <h5 class="text-white">
            @if($role === 'admin')
            <i class="bi bi-gear-fill me-2"></i>Panel Admin
            @else
            <i class="bi bi-person-circle me-2"></i>Area Pelanggan
            @endif
        </h5>
    </div>
    
    <ul class="nav flex-column">
        @if($role === 'admin')
        <li class="nav-item">
            <a class="nav-link text-white {{ Request::is('admin/dasbor*') ? 'active' : '' }}" href="{{ route('admin.dasbor') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dasbor
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ Request::is('admin/pemesanan*') ? 'active' : '' }}" href="{{ route('admin.pemesanan.index') }}">
                <i class="bi bi-calendar-check me-2"></i> Pemesanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ Request::is('admin/layanan*') ? 'active' : '' }}" href="{{ route('admin.layanan.index') }}">
                <i class="bi bi-tools me-2"></i> Layanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ Request::is('admin/aturan*') ? 'active' : '' }}" href="{{ route('admin.aturan.index') }}">
                <i class="bi bi-diagram-3 me-2"></i> Aturan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ Request::is('admin/pengguna*') ? 'active' : '' }}" href="{{ route('admin.pengguna.index') }}">
                <i class="bi bi-people me-2"></i> Pengguna
            </a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link text-white {{ Request::is('pelanggan/beranda*') ? 'active' : '' }}" href="{{ route('pelanggan.beranda') }}">
                <i class="bi bi-speedometer2 me-2"></i> Beranda
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ Request::is('pelanggan/pemesanan*') ? 'active' : '' }}" href="{{ route('pelanggan.pemesanan.index') }}">
                <i class="bi bi-calendar-check me-2"></i> Pemesanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ Request::is('pelanggan/kendaraan*') ? 'active' : '' }}" href="{{ route('pelanggan.kendaraan.index') }}">
                <i class="bi bi-car-front me-2"></i> Kendaraan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ Request::is('pelanggan/layanan*') ? 'active' : '' }}" href="{{ route('pelanggan.layanan.index') }}">
                <i class="bi bi-tools me-2"></i> Layanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ Request::is('pelanggan/rekomendasi*') ? 'active' : '' }}" href="{{ route('pelanggan.rekomendasi') }}">
                <i class="bi bi-lightbulb me-2"></i> Rekomendasi
            </a>
        </li>
        @endif
    </ul>
</div>