<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-3" href="index.html">
        <div class="sidebar-brand-icon">
            <img style="width: 80%" src="{{ asset('images/logo/' . $web_information->logo_secondary) }}" alt="">
        </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ $sidebar_menu !== 'dashboard' ?: 'active' }}">
        <a class="nav-link py-2" href="{{ route('dashboard.index') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        PRODUK
    </div>
    <li class="nav-item {{ $sidebar_menu !== 'product_category' ?: 'active' }}">
        <a class="nav-link py-2" href="{{ route('product_category.index') }}">
            <i class="fas fa-tag"></i>
            <span>Kategori Produk</span></a>
    </li>
    <li class="nav-item {{ $sidebar_menu !== 'product' ?: 'active' }}">
        <a class="nav-link py-2" href="{{ route('product.index') }}">
            <i class="fas fa-boxes"></i>
            <span>Produk</span></a>
    </li>
    <li class="nav-item {{ $sidebar_menu !== 'product_log' ?: 'active' }}">
        <a class="nav-link py-2" href="{{ route('product_log.index') }}">
            <i class="fas fa-truck"></i>
            <span>Pengiriman Produk</span></a>
    </li>
</ul>
