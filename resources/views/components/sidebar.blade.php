<!-- resources/views/components/sidebar.blade.php -->
<aside id="sidebar" class="w-64 bg-blue-800 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out fixed md:relative h-screen z-50">
    <div class="p-4">
        <h2 class="text-2xl font-bold">Bengkel Upin Ipin</h2>
        <p class="text-blue-200 text-sm">Panel Admin</p>
    </div>
    
    <nav class="mt-6">
        <div class="px-4">
            <p class="text-blue-300 text-xs uppercase font-semibold">Menu Utama</p>
        </div>
        
        <ul class="mt-3">
            <li class="px-4 py-2 hover:bg-blue-700 {{ Request::is('admin/dasbor') ? 'bg-blue-700' : '' }}">
                <a href="{{ route('admin.dasbor') }}" class="flex items-center space-x-2">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="px-4 py-2 hover:bg-blue-700 {{ Request::is('admin/pemesanan*') ? 'bg-blue-700' : '' }}">
                <a href="{{ route('admin.pemesanan.index') }}" class="flex items-center space-x-2">
                    <i class="fas fa-calendar-check w-5"></i>
                    <span>Pemesanan</span>
                </a>
            </li>
            
            <li class="px-4 py-2 hover:bg-blue-700 {{ Request::is('admin/layanan*') ? 'bg-blue-700' : '' }}">
                <a href="{{ route('admin.layanan.index') }}" class="flex items-center space-x-2">
                    <i class="fas fa-tools w-5"></i>
                    <span>Layanan</span>
                </a>
            </li>
            
            <li class="px-4 py-2 hover:bg-blue-700 {{ Request::is('admin/aturan*') ? 'bg-blue-700' : '' }}">
                <a href="{{ route('admin.aturan.index') }}" class="flex items-center space-x-2">
                    <i class="fas fa-cogs w-5"></i>
                    <span>Aturan</span>
                </a>
            </li>
            
            <li class="px-4 py-2 hover:bg-blue-700 {{ Request::is('admin/pengguna*') ? 'bg-blue-700' : '' }}">
                <a href="{{ route('admin.pengguna.index') }}" class="flex items-center space-x-2">
                    <i class="fas fa-users w-5"></i>
                    <span>Pengguna</span>
                </a>
            </li>
        </ul>
        
        <div class="absolute bottom-0 w-full p-4 border-t border-blue-700">
            <form method="POST" action="{{ route('keluar') }}">
                @csrf
                <button type="submit" class="flex items-center space-x-2 text-blue-200 hover:text-white w-full">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </nav>
    
    <!-- Mobile menu button -->
    <button class="md:hidden absolute top-4 right-4 text-white" onclick="toggleSidebar()">
        <i class="fas fa-times"></i>
    </button>
</aside>

<!-- Overlay for mobile -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden" onclick="toggleSidebar()"></div>

<!-- Mobile menu toggle button -->
<button class="md:hidden fixed bottom-4 right-4 bg-blue-800 text-white p-3 rounded-full shadow-lg z-30" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
</script>