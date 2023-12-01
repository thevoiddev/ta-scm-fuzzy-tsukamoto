<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-3" href="index.html">
        <div class="sidebar-brand-icon" >
            <img style="width: 80%" src="{{ asset('images/logo/'.$web_information->logo_secondary) }}" alt="">
        </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ $sidebar_menu !== 'dashboard' ?: 'active' }}">
        <a class="nav-link py-2" href="{{ route('dashboard.index') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboardee</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        MASTER DATA
    </div>
    <li class="nav-item {{ $sidebar_menu !== 'web_information' ?: 'active' }}">
        <a class="nav-link py-2" href="{{ route('web_information.index') }}">
            <i class="fas fa-info-circle"></i>
            <span>Web Information</span></a>
    </li>
</ul>