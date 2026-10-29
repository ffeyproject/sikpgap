{{-- ==================== DASHBOARD / HOME ==================== --}}
@can('home')
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Home</p>
        </a>
    </li>
@endcan

@can('data.detail')
    <li class="nav-item">
        <a href="{{ route('data.detail') }}" class="nav-link {{ request()->is('data-detail') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file"></i>
            <p>Data Detail</p>
        </a>
    </li>
@endcan

@can('data.grafik')
    <li class="nav-item">
        <a href="{{ route('data.grafik') }}"
            class="nav-link {{ request()->is('home/grafik') || request()->is('home/grafik/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>Data Grafik</p>
        </a>
    </li>
@endcan

@can('data.grafik.buyer')
    <li class="nav-item">
        <a href="{{ route('data.grafik.buyer') }}"
            class="nav-link {{ request()->is('home/grafik/buyer') || request()->is('home/grafik/buyer/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>Grafik External / Internal</p>
        </a>
    </li>
@endcan

{{-- ==================== MANAGE ==================== --}}
@canany(['users.index', 'roles.index', 'permissions.index', 'pesan.index'])
    <li class="nav-header">MANAGE</li>

    @can('users.index')
        <li class="nav-item">
            <a href="{{ route('users.index') }}"
                class="nav-link {{ request()->is('users') || request()->is('users/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>Manage User</p>
            </a>
        </li>
    @endcan

    @can('roles.index')
        <li class="nav-item">
            <a href="{{ route('roles.index') }}"
                class="nav-link {{ request()->is('roles') || request()->is('roles/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-tag"></i>
                <p>Manage Roles</p>
            </a>
        </li>
    @endcan

    @can('permissions.index')
        <li class="nav-item">
            <a href="{{ route('permissions.index') }}"
                class="nav-link {{ request()->is('permissions') || request()->is('permissions/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-lock"></i>
                <p>Manage Permission</p>
            </a>
        </li>
    @endcan

    @can('pesan.index')
        <li class="nav-item">
            <a href="{{ route('pesan.index') }}"
                class="nav-link {{ request()->is('pesan') || request()->is('pesan/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-inbox"></i>
                <p>Manage Pesan</p>
            </a>
        </li>
    @endcan
@endcanany

{{-- ==================== MANAGE IMAGE ==================== --}}
@can('client.index')
    <li class="nav-header">MANAGE IMAGE</li>
    <li class="nav-item {{ request()->is('client') || request()->is('client/*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->is('client') || request()->is('client/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-images"></i>
            <p>
                Menu
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('client.index') }}"
                    class="nav-link {{ request()->is('client') || request()->is('client/*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Client</p>
                </a>
            </li>
        </ul>
    </li>
@endcan

{{-- ==================== RAW DATA ==================== --}}
@canany(['raw-data.kepuasan', 'raw-data.keluhan'])
    <li class="nav-header">RAW DATA</li>
    <li class="nav-item {{ request()->is('raw-data/*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->is('raw-data/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-database"></i>
            <p>
                Menu Raw
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('raw-data.kepuasan')
                <li class="nav-item">
                    <a href="{{ route('raw-data.kepuasan') }}"
                        class="nav-link {{ request()->is('raw-data/kepuasan') || request()->is('raw-data/kepuasan/*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kepuasan Pelanggan</p>
                    </a>
                </li>
            @endcan

            @can('raw-data.keluhan')
                <li class="nav-item">
                    <a href="{{ route('raw-data.keluhan') }}"
                        class="nav-link {{ request()->is('raw-data/keluhan') || request()->is('raw-data/keluhan/*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Keluhan Pelanggan</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany

{{-- ==================== FITUR CHAT ==================== --}}
@can('fitur-chat')
    <li class="nav-header">FITUR CHAT</li>
    <li class="nav-item">
        <a href="{{ route('fitur-chat') }}" class="nav-link {{ request()->is('fitur-chat') ? 'active' : '' }}">
            <i class="nav-icon fas fa-comments"></i>
            <p>Fitur Chat</p>
        </a>
    </li>
@endcan

{{-- ==================== MANAGE MENU ==================== --}}
@can('menu.index')
    <li class="nav-header">MANAGE MENU</li>
    <li class="nav-item {{ request()->is('menu') || request()->is('menu/*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->is('menu') || request()->is('menu/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-bars"></i>
            <p>
                Menu
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('menu.index') }}" class="nav-link {{ request()->is('menu') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kelola</p>
                </a>
            </li>
        </ul>
    </li>
@endcan

{{-- ==================== MASTER ==================== --}}
@canany(['buyer.index', 'defect.index', 'asal_masalah.index', 'item.index'])
    <li class="nav-header">MASTER</li>
    <li
        class="nav-item {{ request()->is('buyer*') || request()->is('defect*') || request()->is('asal-masalah*') || request()->is('item-penilaian*') ? 'menu-open' : '' }}">
        <a href="#"
            class="nav-link {{ request()->is('buyer*') || request()->is('defect*') || request()->is('asal-masalah*') || request()->is('item-penilaian*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Master
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('buyer.index')
                <li class="nav-item">
                    <a href="{{ route('buyer.index') }}" class="nav-link {{ request()->is('buyer*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pelanggan</p>
                    </a>
                </li>
            @endcan

            @can('defect.index')
                <li class="nav-item">
                    <a href="{{ route('defect.index') }}" class="nav-link {{ request()->is('defect*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Penyebab Komplaint</p>
                    </a>
                </li>
            @endcan

            @can('asal_masalah.index')
                <li class="nav-item">
                    <a href="{{ route('asal_masalah.index') }}"
                        class="nav-link {{ request()->is('asal-masalah*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Asal Masalah</p>
                    </a>
                </li>
            @endcan

            @can('item.index')
                <li class="nav-item">
                    <a href="{{ route('item.index') }}"
                        class="nav-link {{ request()->is('item-penilaian*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Index Penilaian</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany

{{-- ==================== MENU PELANGGAN ==================== --}}
@canany(['kepuasan.index', 'kepuasan.laporan', 'keluhan.index', 'data.verifikasi', 'keluhan.rverifikasi',
    'keluhan.data.open', 'keluhan.data.cetak'])
    <li class="nav-header">MENU PELANGGAN</li>

    {{-- Sub-Group: Kepuasan Pelanggan --}}
    @canany(['kepuasan.index', 'kepuasan.laporan'])
        <li class="nav-item {{ request()->is('kepuasan*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('kepuasan*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tasks"></i>
                <p>
                    Kepuasan Pelanggan
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('kepuasan.index')
                    <li class="nav-item">
                        <a href="{{ route('kepuasan.index') }}"
                            class="nav-link {{ request()->is('kepuasan') || request()->is('kepuasan/create') || request()->is('kepuasan-penilaian/*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Penilaian</p>
                        </a>
                    </li>
                @endcan

                @can('kepuasan.laporan')
                    <li class="nav-item">
                        <a href="{{ route('kepuasan.laporan') }}"
                            class="nav-link {{ request()->is('kepuasan/laporan*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan Penilaian</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcanany

    {{-- Sub-Group: Keluhan Pelanggan --}}
    @canany(['keluhan.index', 'data.verifikasi', 'keluhan.rverifikasi', 'keluhan.data.open', 'keluhan.data.cetak'])
        <li class="nav-item {{ request()->is('keluhan*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('keluhan*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                    Keluhan Pelanggan
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('keluhan.index')
                    <li class="nav-item">
                        <a href="{{ route('keluhan.index') }}"
                            class="nav-link {{ request()->is('keluhan') || request()->is('keluhan/create*') || request()->is('keluhan/proses*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Keluhan</p>
                        </a>
                    </li>
                @endcan

                @can('data.verifikasi')
                    <li class="nav-item">
                        <a href="{{ route('data.verifikasi') }}" target="_blank"
                            class="nav-link {{ request()->is('keluhan/rekap/verifikasi/get') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Rekap Verifikasi</p>
                        </a>
                    </li>
                @endcan

                @can('keluhan.rverifikasi')
                    <li class="nav-item">
                        <a href="{{ route('keluhan.rverifikasi') }}" target="_blank"
                            class="nav-link {{ request()->is('keluhan/rekap-verifikasi') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Rekap Verifikasi</p>
                        </a>
                    </li>
                @endcan

                @can('keluhan.data.open')
                    <li class="nav-item">
                        <a href="{{ route('keluhan.data.open') }}" target="_blank"
                            class="nav-link {{ request()->is('keluhan/rekap/open/get') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Rekap Data Open dan Proses</p>
                        </a>
                    </li>
                @endcan

                @can('keluhan.data.cetak')
                    <li class="nav-item">
                        <a href="{{ route('keluhan.data.cetak') }}" target="_blank"
                            class="nav-link {{ request()->is('keluhan/rekap/get') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Rekap</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcanany
@endcanany
