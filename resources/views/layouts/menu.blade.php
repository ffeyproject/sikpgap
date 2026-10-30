<style>
    /* ========================================================
       MODERN & SMOOTH SIDEBAR MENU STYLING
       ======================================================== */
    .sidebar-dark-primary .nav-sidebar {
        padding: 0.25rem 0.5rem 2rem 0.5rem;
    }

    /* Section Headers */
    .sidebar-dark-primary .nav-sidebar .nav-header {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #8a99b5;
        padding: 1.1rem 0.6rem 0.4rem 0.6rem;
        display: flex;
        align-items: center;
        user-select: none;
    }

    .sidebar-dark-primary .nav-sidebar .nav-header::after {
        content: "";
        flex: 1;
        margin-left: 0.75rem;
        height: 1px;
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0));
    }

    /* Nav Item Base */
    .sidebar-dark-primary .nav-sidebar > .nav-item {
        margin-bottom: 3px;
    }

    /* Nav Links */
    .sidebar-dark-primary .nav-sidebar .nav-link {
        border-radius: 8px;
        padding: 0.55rem 0.85rem;
        color: #b8c1cc;
        font-size: 0.88rem;
        font-weight: 450;
        display: flex;
        align-items: center;
        transition: all 0.22s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        overflow: hidden;
    }

    /* Hover effect */
    .sidebar-dark-primary .nav-sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.08);
        color: #ffffff;
        transform: translateX(4px);
    }

    /* Active State */
    .sidebar-dark-primary .nav-sidebar .nav-link.active {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.38);
    }

    /* Active left accent bar */
    .sidebar-dark-primary .nav-sidebar .nav-link.active::before {
        content: "";
        position: absolute;
        left: 0;
        top: 18%;
        bottom: 18%;
        width: 3.5px;
        background: #93c5fd;
        border-radius: 0 4px 4px 0;
    }

    /* Nav Icons */
    .sidebar-dark-primary .nav-sidebar .nav-link .nav-icon {
        width: 1.5rem;
        margin-right: 0.65rem;
        text-align: center;
        font-size: 0.95rem;
        opacity: 0.85;
        transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1), color 0.2s ease, opacity 0.2s ease;
    }

    .sidebar-dark-primary .nav-sidebar .nav-link:hover .nav-icon {
        opacity: 1;
        transform: scale(1.15);
        color: #60a5fa;
    }

    .sidebar-dark-primary .nav-sidebar .nav-link.active .nav-icon {
        opacity: 1;
        color: #ffffff !important;
        transform: scale(1.05);
    }

    /* Text & Dropdown Right Arrow */
    .sidebar-dark-primary .nav-sidebar .nav-link p {
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        line-height: 1.3;
    }

    .sidebar-dark-primary .nav-sidebar .nav-link p .right {
        transition: transform 0.25s ease;
        font-size: 0.72rem;
        opacity: 0.75;
    }

    .sidebar-dark-primary .nav-sidebar .nav-item.menu-open > .nav-link p .right {
        transform: rotate(-90deg);
        opacity: 1;
    }

    /* Parent item active when expanded */
    .sidebar-dark-primary .nav-sidebar .nav-item.menu-open > .nav-link:not(.active) {
        background: rgba(255, 255, 255, 0.04);
        color: #f1f5f9;
    }

    /* Submenu Treeview Container */
    .sidebar-dark-primary .nav-sidebar .nav-treeview {
        position: relative;
        padding-left: 0.5rem;
        margin-left: 1rem;
        margin-top: 3px;
        margin-bottom: 5px;
        border-left: 1.5px solid rgba(255, 255, 255, 0.1);
        list-style: none;
    }

    /* Submenu items */
    .sidebar-dark-primary .nav-sidebar .nav-treeview .nav-link {
        font-size: 0.84rem;
        padding: 0.45rem 0.75rem;
        margin-bottom: 2px;
        border-radius: 6px;
        color: #94a3b8;
    }

    .sidebar-dark-primary .nav-sidebar .nav-treeview .nav-link:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.07);
        transform: translateX(3px);
    }

    .sidebar-dark-primary .nav-sidebar .nav-treeview .nav-link.active {
        background: rgba(37, 99, 235, 0.25) !important;
        color: #93c5fd !important;
        font-weight: 600;
        border-left: 2px solid #3b82f6;
        box-shadow: none;
    }

    .sidebar-dark-primary .nav-sidebar .nav-treeview .nav-link .nav-icon {
        font-size: 0.78rem;
        width: 1.3rem;
        margin-right: 0.5rem;
        opacity: 0.7;
    }

    .sidebar-dark-primary .nav-sidebar .nav-treeview .nav-link.active .nav-icon {
        color: #60a5fa !important;
        opacity: 1;
    }

    /* External Link Badge */
    .nav-badge-ext {
        font-size: 0.65rem;
        padding: 0.15rem 0.45rem;
        border-radius: 4px;
        background: rgba(255, 255, 255, 0.08);
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        margin-left: auto;
        transition: all 0.2s ease;
    }

    .nav-link:hover .nav-badge-ext {
        background: rgba(59, 130, 246, 0.25);
        color: #bfdbfe;
    }
</style>

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
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Data Detail</p>
        </a>
    </li>
@endcan

@can('data.grafik')
    <li class="nav-item">
        <a href="{{ route('data.grafik') }}"
            class="nav-link {{ request()->is('home/grafik') || request()->is('home/grafik/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
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
    <li class="nav-header">Manage</li>

    @can('users.index')
        <li class="nav-item">
            <a href="{{ route('users.index') }}"
                class="nav-link {{ request()->is('users') || request()->is('users/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>Manage User</p>
            </a>
        </li>
    @endcan

    @can('roles.index')
        <li class="nav-item">
            <a href="{{ route('roles.index') }}"
                class="nav-link {{ request()->is('roles') || request()->is('roles/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>Manage Roles</p>
            </a>
        </li>
    @endcan

    @can('permissions.index')
        <li class="nav-item">
            <a href="{{ route('permissions.index') }}"
                class="nav-link {{ request()->is('permissions') || request()->is('permissions/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-shield-alt"></i>
                <p>Manage Permission</p>
            </a>
        </li>
    @endcan

    @can('pesan.index')
        <li class="nav-item">
            <a href="{{ route('pesan.index') }}"
                class="nav-link {{ request()->is('pesan') || request()->is('pesan/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-envelope"></i>
                <p>Manage Pesan</p>
            </a>
        </li>
    @endcan
@endcanany

{{-- ==================== MANAGE IMAGE ==================== --}}
@can('client.index')
    <li class="nav-header">Manage Image</li>
    <li class="nav-item has-treeview {{ request()->is('client') || request()->is('client/*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->is('client') || request()->is('client/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-images"></i>
            <p>
                <span>Menu Client</span>
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('client.index') }}"
                    class="nav-link {{ request()->is('client') || request()->is('client/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-id-card"></i>
                    <p>Client</p>
                </a>
            </li>
        </ul>
    </li>
@endcan

{{-- ==================== RAW DATA ==================== --}}
@canany(['raw-data.kepuasan', 'raw-data.keluhan'])
    <li class="nav-header">Raw Data</li>
    <li class="nav-item has-treeview {{ request()->is('raw-data/*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->is('raw-data/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-database"></i>
            <p>
                <span>Menu Raw</span>
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('raw-data.kepuasan')
                <li class="nav-item">
                    <a href="{{ route('raw-data.kepuasan') }}"
                        class="nav-link {{ request()->is('raw-data/kepuasan') || request()->is('raw-data/kepuasan/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-smile"></i>
                        <p>Kepuasan Pelanggan</p>
                    </a>
                </li>
            @endcan

            @can('raw-data.keluhan')
                <li class="nav-item">
                    <a href="{{ route('raw-data.keluhan') }}"
                        class="nav-link {{ request()->is('raw-data/keluhan') || request()->is('raw-data/keluhan/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exclamation-circle"></i>
                        <p>Keluhan Pelanggan</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany

{{-- ==================== FITUR CHAT ==================== --}}
@can('fitur-chat')
    <li class="nav-header">Fitur Chat</li>
    <li class="nav-item">
        <a href="{{ route('fitur-chat') }}" class="nav-link {{ request()->is('fitur-chat') ? 'active' : '' }}">
            <i class="nav-icon fas fa-comments"></i>
            <p>Fitur Chat</p>
        </a>
    </li>
@endcan

{{-- ==================== MANAGE MENU ==================== --}}
@can('menu.index')
    <li class="nav-header">Manage Menu</li>
    <li class="nav-item has-treeview {{ request()->is('menu') || request()->is('menu/*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->is('menu') || request()->is('menu/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-bars"></i>
            <p>
                <span>Menu</span>
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('menu.index') }}" class="nav-link {{ request()->is('menu') || request()->is('menu/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-sliders-h"></i>
                    <p>Kelola</p>
                </a>
            </li>
        </ul>
    </li>
@endcan

{{-- ==================== MASTER ==================== --}}
@canany(['buyer.index', 'defect.index', 'asal_masalah.index', 'item.index'])
    <li class="nav-header">Master</li>
    <li
        class="nav-item has-treeview {{ request()->is('buyer*') || request()->is('defect*') || request()->is('asal-masalah*') || request()->is('item-penilaian*') ? 'menu-open' : '' }}">
        <a href="#"
            class="nav-link {{ request()->is('buyer*') || request()->is('defect*') || request()->is('asal-masalah*') || request()->is('item-penilaian*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cubes"></i>
            <p>
                <span>Master Data</span>
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('buyer.index')
                <li class="nav-item">
                    <a href="{{ route('buyer.index') }}" class="nav-link {{ request()->is('buyer*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Pelanggan</p>
                    </a>
                </li>
            @endcan

            @can('defect.index')
                <li class="nav-item">
                    <a href="{{ route('defect.index') }}" class="nav-link {{ request()->is('defect*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exclamation-triangle"></i>
                        <p>Penyebab Komplaint</p>
                    </a>
                </li>
            @endcan

            @can('asal_masalah.index')
                <li class="nav-item">
                    <a href="{{ route('asal_masalah.index') }}"
                        class="nav-link {{ request()->is('asal-masalah*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>Asal Masalah</p>
                    </a>
                </li>
            @endcan

            @can('item.index')
                <li class="nav-item">
                    <a href="{{ route('item.index') }}"
                        class="nav-link {{ request()->is('item-penilaian*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
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
    <li class="nav-header">Menu Pelanggan</li>

    {{-- Sub-Group: Kepuasan Pelanggan --}}
    @canany(['kepuasan.index', 'kepuasan.laporan'])
        <li class="nav-item has-treeview {{ request()->is('kepuasan*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('kepuasan*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-star-half-alt"></i>
                <p>
                    <span>Kepuasan Pelanggan</span>
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('kepuasan.index')
                    <li class="nav-item">
                        <a href="{{ route('kepuasan.index') }}"
                            class="nav-link {{ request()->is('kepuasan') || request()->is('kepuasan/create') || request()->is('kepuasan-penilaian/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Penilaian</p>
                        </a>
                    </li>
                @endcan

                @can('kepuasan.laporan')
                    <li class="nav-item">
                        <a href="{{ route('kepuasan.laporan') }}"
                            class="nav-link {{ request()->is('kepuasan/laporan*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>Laporan Penilaian</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcanany

    {{-- Sub-Group: Keluhan Pelanggan --}}
    @canany(['keluhan.index', 'data.verifikasi', 'keluhan.rverifikasi', 'keluhan.data.open', 'keluhan.data.cetak'])
        <li class="nav-item has-treeview {{ request()->is('keluhan*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('keluhan*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                    <span>Keluhan Pelanggan</span>
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('keluhan.index')
                    <li class="nav-item">
                        <a href="{{ route('keluhan.index') }}"
                            class="nav-link {{ request()->is('keluhan') || request()->is('keluhan/create*') || request()->is('keluhan/proses*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder-open"></i>
                            <p>Data Keluhan</p>
                        </a>
                    </li>
                @endcan

                @can('data.verifikasi')
                    <li class="nav-item">
                        <a href="{{ route('data.verifikasi') }}" target="_blank"
                            class="nav-link {{ request()->is('keluhan/rekap/verifikasi/get') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>
                                <span>Data Rekap Verifikasi</span>
                                <span class="nav-badge-ext"><i class="fas fa-external-link-alt"></i></span>
                            </p>
                        </a>
                    </li>
                @endcan

                @can('keluhan.rverifikasi')
                    <li class="nav-item">
                        <a href="{{ route('keluhan.rverifikasi') }}" target="_blank"
                            class="nav-link {{ request()->is('keluhan/rekap-verifikasi') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-check-double"></i>
                            <p>
                                <span>Rekap Verifikasi</span>
                                <span class="nav-badge-ext"><i class="fas fa-external-link-alt"></i></span>
                            </p>
                        </a>
                    </li>
                @endcan

                @can('keluhan.data.open')
                    <li class="nav-item">
                        <a href="{{ route('keluhan.data.open') }}" target="_blank"
                            class="nav-link {{ request()->is('keluhan/rekap/open/get') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-sync-alt"></i>
                            <p>
                                <span>Rekap Data Open & Proses</span>
                                <span class="nav-badge-ext"><i class="fas fa-external-link-alt"></i></span>
                            </p>
                        </a>
                    </li>
                @endcan

                @can('keluhan.data.cetak')
                    <li class="nav-item">
                        <a href="{{ route('keluhan.data.cetak') }}" target="_blank"
                            class="nav-link {{ request()->is('keluhan/rekap/get') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-print"></i>
                            <p>
                                <span>Rekap</span>
                                <span class="nav-badge-ext"><i class="fas fa-external-link-alt"></i></span>
                            </p>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcanany
@endcanany
