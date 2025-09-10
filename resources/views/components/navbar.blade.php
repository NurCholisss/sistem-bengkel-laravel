<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <span class="navbar-text text-white">
                        <i class="bi bi-person-circle me-2"></i>
                        {{ Auth::user()->nama }} (Admin)
                    </span>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('pelanggan.beranda') }}">
                        <i class="bi bi-eye me-1"></i>Lihat Situs
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('keluar') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link text-white btn btn-link">
                            <i class="bi bi-box-arrow-right me-1"></i>Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>