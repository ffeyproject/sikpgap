<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}"
        class="nav-link {{ (request()->is('home')) || (request()->is('home')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

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

<li class="nav-header">MASTER</li>
<li
    class="nav-item {{ (request()->is('buyer')) ||  (request()->is('buyer/create')) || (request()->is('buyer/*')) || (request()->is('defect')) || (request()->is('defect/*')) || (request()->routeIs('defect.update}'))  ? 'active menu-open' : '' }}">
    <a href="#"
        class="nav-link nav-item {{ (request()->is('buyer')) || (request()->is('buyer/create')) || (request()->is('buyer/*')) ||  (request()->is('barang')) || (request()->is('supplier'))  ? 'active menu-open' : '' }}">
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
    </ul>
</li>

<li class="nav-header">MENU</li>
<li class="nav-item">
    <a href="{{ route('kepuasan.index') }}" class="nav-link {{ (request()->is('categori')) ? 'active' : '' }} ">
        <i class="fas fa-tasks"></i>
        <p>Kepuasan Pelanggan</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('keluhan.index') }}"
        class="nav-link {{ (request()->is('keluhan')) || (request()->is('keluhan/create')) || (request()->is('keluhan/*')) ? 'active' : '' }} ">
        <i class="fas fa-tasks"></i>
        <p>Keluhan Pelanggan</p>
    </a>
</li>
