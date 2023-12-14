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
    <li class="nav-item {{ $sidebar_menu !== 'product_etalase' ?: 'active' }}">
        <a class="nav-link py-2" href="{{ route('product_etalase.index') }}">
            <i class="fas fa-boxes"></i>
            <span>Produk Etalase</span></a>
    </li>
    <li class="nav-item {{ $sidebar_menu !== 'point_of_sales' ?: 'active' }}">
        <a class="nav-link py-2" href="{{ route('point_of_sales.index') }}">
            <i class="fas fa-store-alt"></i>
            <span>Point Of Sales</span></a>
    </li>
    <li class="nav-item {{ $sidebar_menu !== 'sales_history' ?: 'active' }}">
        <a class="nav-link py-2" href="{{ route('sales_history.index') }}">
            <i class="fas fa-history"></i>
            <span>Riwayat Penjualan</span></a>
    </li>
</ul>
