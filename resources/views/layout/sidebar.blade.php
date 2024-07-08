<aside class="main-sidebar sidebar-dark bg-dark elevation-4" style="position: fixed;">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <h5 id="date" class="d-block text-dark text-center text-bold"></h5>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @if(Auth::user()->base64Image)
                    <img src="{{ Auth::user()->base64Image }}" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                    @else
                    <img src="{{ asset('AdminLTE/dist/img/default-profile.png') }}" alt="Default Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                    @endif
                </div>
                <div class="info">
                    <a href="{{ route('admin.profile') }}" class="d-block text-white">{{ Auth::user()->name }}</a>
                </div>
            </div>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header mt-1">Menu Utama</li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p><strong>Dashboard</strong></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.kriteria') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.kriteria') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p><strong>List Kriteria</strong></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.alternatif') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.alternatif') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-stream"></i>
                        <p><strong>List Alternatif</strong></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pembobotan') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.pembobotan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p><strong>Pembobotan</strong></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.penilaian') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.penilaian') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p><strong>Penilaian</strong></p>
                    </a>
                </li>
                <li class="nav-header mt-3">Pengaturan</li>
                <li class="nav-item {{ Request::routeIs('admin.akun', 'admin.akunUser') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link sidebar-side {{ Request::routeIs('admin.akun') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Akun
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.akun') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.akun') ? 'active' : '' }}">
                                <i class="far fa-user nav-icon"></i>
                                <p>List Akun</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>