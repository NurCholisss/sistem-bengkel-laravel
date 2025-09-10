<div class="position-sticky pt-3">
    <div class="text-center mb-4">
        <h5 class="text-primary">Sistem Bengkel Upin Ipin</h5>
        <p class="text-muted small">Panel Admin</p>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/dasbor') ? 'active' : '' }}" href="{{ route('admin.dasbor') }}">
                <i class="bi bi-speedometer2 me-2"></i>Dasbor
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/pemesanan*') ? 'active' : '' }}" href="{{ route('admin.pemesanan.index') }}">
                <i class="bi bi-calendar-check me-2"></i>Pemesanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/layanan*') ? 'active' : '' }}" href="{{ route('admin.layanan.index') }}">
                <i class="bi bi-tools me-2"></i>Layanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/aturan*') ? 'active' : '' }}" href="{{ route('admin.aturan.index') }}">
                <i class="bi bi-diagram-3 me-2"></i>Aturan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/pengguna*') ? 'active' : '' }}" href="{{ route('admin.pengguna.index') }}">
                <i class="bi bi-people me-2"></i>Pengguna
            </a>
        </li>
    </ul>
</div>