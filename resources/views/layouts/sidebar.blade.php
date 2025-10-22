<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo.png') }}" alt="navbar brand" class="navbar-brand"
                    height="60" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                {{-- Dashboard --}}
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>

                {{-- ADMINISTRATOR MENU --}}
                @if (Auth::user()->role === 'administrator')
                    <li class="nav-item {{ request()->routeIs('kriteria.index') ? 'active' : '' }}">
                        <a href="{{ route('kriteria.index') }}">
                            <i class="fas fa-file"></i>
                            <p>Kriteria</p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('alternatif.index') ? 'active' : '' }}">
                        <a href="{{ route('alternatif.index') }}">
                            <i class="fas fa-file"></i>
                            <p>Alternatif</p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('riwayat.index') ? 'active' : '' }}">
                        <a href="{{ route('riwayat.index') }}">
                            <i class="fas fa-clock"></i>
                            <p>Riwayat</p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('kelas.index') ? 'active' : '' }}">
                        <a href="{{ route('kelas.index') }}">
                            <i class="fas fa-school"></i>
                            <p>Kelas</p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fas fa-users"></i>
                            <p>Data User</p>
                        </a>
                    </li>
                @endif

                {{-- ADMIN MENU --}}
                @if (Auth::user()->role === 'admin')
                    <li class="nav-item {{ request()->routeIs('nilai_alternatif.index') ? 'active' : '' }}">
                        <a href="{{ route('nilai_alternatif.index') }}">
                            <i class="fas fa-edit"></i>
                            <p>Penilaian</p>
                        </a>
                    </li>

                    
                @endif
                <li class="nav-item {{ request()->routeIs('alternatif.index') ? 'active' : '' }}">
                        <a href="{{ route('alternatif.index') }}">
                            <i class="fas fa-user"></i>
                            <p>Alternatif</p>
                        </a>
                    </li>
                {{-- Menu Umum (Bisa diakses semua role) --}}
                <li class="nav-item {{ request()->routeIs('perhitungan.index') ? 'active' : '' }}">
                    <a href="{{ route('perhitungan.index') }}">
                        <i class="fas fa-calculator"></i>
                        <p>Perhitungan</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('hasil.index') ? 'active' : '' }}">
                    <a href="{{ route('hasil.index') }}">
                        <i class="fas fa-chart-line"></i>
                        <p>Hasil</p>
                    </a>
                </li>

                {{-- Setting Section --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Settings</h4>
                </li>

                <li class="nav-item">
                    <a href="{{ route('profile') }}">
                        <i class="fas fa-user-cog"></i>
                        <p>Profil</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
