<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}"
        class="nav-link {{ (request()->is('home')) || (request()->is('home')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
@auth
@role('admin')
<li class="nav-header">MANAGE</li>
<li class="nav-item">
    <a href="{{ route('users.index') }}"
        class="nav-link {{ (request()->is('users')) || (request()->is('users/create')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-plus"></i>
        <p>Manage User</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('roles.index') }}" class="nav-link {{ (request()->is('roles')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-tag"></i>
        <p>Manage Roles</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('permissions.index') }}" class="nav-link {{ (request()->is('permissions')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-lock"></i>
        <p>Manage Permission</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('pesan.index') }}"
        class="nav-link {{ (request()->is('pesan')) || (request()->is('pesan/create')) ? 'active' : '' }} ">
        <i class="fas fa-inbox"></i>
        <p>Manage Pesan</p>
    </a>
</li>
<li class="nav-header">MANAGE IMAGE</li>
<li
    class="nav-item {{ (request()->is('client')) ||  (request()->is('client/create')) || (request()->is('client/*')) || (request()->is('defect')) || (request()->is('defect/*')) || (request()->routeIs('defect.update}')) || (request()->is('asal-masalah')) || (request()->is('asal-masalah/*')) || (request()->is('item-penilaian')) || (request()->is('item-penilaian/*')) ? 'active menu-open' : '' }}">
    <a href="#"
        class="nav-link nav-item {{ (request()->is('client')) || (request()->is('client/create')) || (request()->is('buyer/*')) ||  (request()->is('defect')) || (request()->is('asal-masalah'))  ? 'active menu-open' : '' }}">
        <i class="fas fa-caret-square-down"></i>
        <p>
            Menu
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('client.index') }}"
                class="nav-link {{ (request()->is('client')) || (request()->is('client/create')) || (request()->is('buyer/*')) ||  (request()->is('defect')) || (request()->is('asal-masalah'))  ? 'active menu-open' : '' }}">
                <i class="fas fa-bars"></i>
                <p>Client</p>
                </p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-header">RAW DATA</li>
<li
    class="nav-item {{ (request()->is('raw-data/kepuasan')) ||  (request()->is('raw-data/keluhan')) || (request()->is('raw-data/kepuasan/*')) || (request()->is('defect')) || (request()->is('defect/*')) || (request()->routeIs('defect.update}')) || (request()->is('asal-masalah')) || (request()->is('asal-masalah/*')) || (request()->is('item-penilaian')) || (request()->is('item-penilaian/*')) ? 'active menu-open' : '' }}">
    <a href="#"
        class="nav-link nav-item {{ (request()->is('raw-data/kepuasan')) || (request()->is('raw-data/keluhan')) || (request()->is('raw-data/kepuasan/*')) ||  (request()->is('defect')) || (request()->is('asal-masalah'))  ? 'active menu-open' : '' }}">
        <i class="fas fa-caret-square-down"></i>
        <p>
            Menu Raw
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('raw-data.kepuasan') }}"
                class="nav-link {{ (request()->is('raw-data/kepuasan')) || (request()->is('client/create')) || (request()->is('raw-data/kepuasan/*')) ||  (request()->is('defect')) || (request()->is('asal-masalah'))  ? 'active menu-open' : '' }}">
                <i class="fas fa-bars"></i>
                <p>Kepuasan Pelanggan</p>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('raw-data.keluhan') }}"
                class="nav-link {{ (request()->is('raw-data/keluhan')) || (request()->is('raw-data/create')) || (request()->is('buyer/*')) ||  (request()->is('defect')) || (request()->is('asal-masalah'))  ? 'active menu-open' : '' }}">
                <i class="fas fa-bars"></i>
                <p>Keluhan Pelanggan</p>
                </p>
            </a>
        </li>
    </ul>
</li>
@endrole
@endauth
<li class="nav-header">MANAGE MENU</li>
<li class="nav-item">
    <a href="#" class="nav-link nav-item">
        <i class="fas fa-caret-square-down"></i>
        <p>
            Menu
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('menu.index') }}" class="nav-link">
                <i class="fas fa-bars"></i>
                <p>Kelola</p>
                </p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-header">MASTER</li>
<li
    class="nav-item {{ (request()->is('buyer')) ||  (request()->is('buyer/create')) || (request()->is('buyer/*')) || (request()->is('defect')) || (request()->is('defect/*')) || (request()->routeIs('defect.update}')) || (request()->is('asal-masalah')) || (request()->is('asal-masalah/*')) || (request()->is('item-penilaian')) || (request()->is('item-penilaian/*')) ? 'active menu-open' : '' }}">
    <a href="#"
        class="nav-link nav-item {{ (request()->is('buyer')) || (request()->is('buyer/create')) || (request()->is('buyer/*')) ||  (request()->is('defect')) || (request()->is('asal-masalah'))  ? 'active menu-open' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Master
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('buyer.index') }}"
                class="nav-link {{ (request()->is('buyer')) || (request()->is('buyer/create')) || (request()->is('buyer/*')) ? 'active' : '' }} ">
                <i class="fas fa-address-card"></i>
                <p>Pelanggan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('defect.index') }}"
                class="nav-link {{ (request()->is('defect')) || (request()->is('defect/create')) || (request()->is('defect/*'))  ? 'active' : '' }} ">
                <i class="fas fa-exclamation-circle"></i>
                <p>Penyebab Komplaint</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('asal_masalah.index') }}"
                class="nav-link {{ (request()->is('asal-masalah')) || (request()->is('asal-masalah/create')) || (request()->is('asal-masalah/*'))  ? 'active' : '' }} ">
                <i class="fas fa-exclamation-triangle"></i>
                <p>Asal Masalah</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('item.index') }}"
                class="nav-link {{ (request()->is('item-penilaian')) || (request()->is('item-penilaian/create')) || (request()->is('item-penilaian/*'))  ? 'active' : '' }} ">
                <i class="fas fa-indent"></i>
                <p>Index Penilaian</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-header">MENU PELANGGAN</li>
<li
    class="nav-item {{ (request()->is('kepuasan')) || (request()->is('kepuasan/create')) || (request()->is('kepuasan/*')) || (request()->is('kepuasan-penilaian/*'))  ? 'active menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ (request()->is('kepuasan')) || (request()->is('kepuasan/create')) || (request()->is('kepuasan/*')) || (request()->is('kepuasan-penilaian/*'))  ? 'active' : '' }} ">
        <i class="fas fa-tasks"></i>
        <p>Kepuasan Pelanggan
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('kepuasan.index') }}"
                class="nav-link {{ (request()->is('kepuasan')) || (request()->is('kepuasan/create')) || (request()->is('kepuasan-penilaian/*'))  ? 'active' : '' }} ">
                <i class="fas fa-file-alt"></i>
                <p>Penilaian</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('kepuasan.laporan') }}"
                class="nav-link {{ (request()->is('kepuasan/laporan')) ? 'active' : '' }} ">
                <i class="fas fa-sticky-note"></i>
                <p>Laporan Penilaian</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('keluhan.index') }}"
        class="nav-link {{ (request()->is('keluhan')) || (request()->is('keluhan/create')) || (request()->is('keluhan/*')) ? 'active' : '' }} ">
        <i class="fas fa-tasks"></i>
        <p>Keluhan Pelanggan</p>
    </a>
</li>