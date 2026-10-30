<style>
    /* ========================================================
       MODERN NAVBAR STYLING
       ======================================================== */
    .modern-navbar {
        background: #ffffff !important;
        border-bottom: 1px solid #e2e8f0 !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04), 0 1px 2px 0 rgba(0, 0, 0, 0.02);
        padding: 0.45rem 1rem !important;
        transition: all 0.25s ease;
    }

    /* Action Buttons (Pushmenu & Fullscreen) */
    .modern-navbar .nav-link-btn {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #475569 !important;
        background: #f1f5f9;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0 !important;
        margin: 0 2px;
    }

    .modern-navbar .nav-link-btn:hover {
        background: #e2e8f0;
        color: #1e293b !important;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
    }

    /* Date & Live Clock Widget */
    .nav-date-widget {
        display: flex;
        align-items: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 0.3rem 0.85rem;
        font-size: 0.82rem;
        font-weight: 500;
        color: #334155;
        gap: 0.5rem;
        margin-left: 0.5rem;
    }

    .nav-date-widget .badge-live {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.68rem;
        font-weight: 600;
        color: #16a34a;
        background: #dcfce7;
        padding: 1px 7px;
        border-radius: 10px;
    }

    .nav-date-widget .badge-live::before {
        content: "";
        width: 6px;
        height: 6px;
        background: #22c55e;
        border-radius: 50%;
        display: inline-block;
        animation: pulse-live 1.8s infinite;
    }

    @keyframes pulse-live {
        0% { transform: scale(0.9); opacity: 1; }
        50% { transform: scale(1.35); opacity: 0.4; }
        100% { transform: scale(0.9); opacity: 1; }
    }

    /* User Toggle Button */
    .modern-navbar .user-menu .nav-link {
        display: flex;
        align-items: center;
        gap: 0.55rem;
        padding: 0.25rem 0.75rem !important;
        border-radius: 20px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .modern-navbar .user-menu .nav-link:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    }

    .modern-navbar .user-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .modern-navbar .user-name {
        font-weight: 600;
        font-size: 0.85rem;
        color: #1e293b;
    }

    /* Modern Dropdown Menu */
    .modern-user-dropdown {
        border-radius: 14px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05) !important;
        padding: 0 !important;
        min-width: 270px !important;
        overflow: hidden;
        margin-top: 8px !important;
    }

    .modern-user-dropdown .user-header {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
        padding: 1.4rem 1rem !important;
        height: auto !important;
        text-align: center;
        color: #ffffff;
    }

    .modern-user-dropdown .user-header img {
        width: 60px;
        height: 60px;
        border: 3px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.15);
    }

    .modern-user-dropdown .user-header .user-title {
        font-size: 0.98rem;
        font-weight: 600;
        margin-top: 0.6rem;
        margin-bottom: 0.2rem;
        color: #ffffff;
    }

    .modern-user-dropdown .user-header .user-role-badge {
        display: inline-block;
        font-size: 0.7rem;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.2);
        color: #e0e7ff;
        padding: 2px 9px;
        border-radius: 12px;
        letter-spacing: 0.02em;
        margin-bottom: 0.35rem;
    }

    .modern-user-dropdown .user-header .user-joined {
        font-size: 0.74rem;
        color: rgba(255, 255, 255, 0.85);
        margin: 0;
    }

    .modern-user-dropdown .user-body {
        padding: 0.5rem;
        background: #ffffff;
    }

    .modern-user-dropdown .dropdown-action-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.6rem 0.85rem;
        border-radius: 8px;
        color: #334155;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.15s ease;
        text-decoration: none;
        cursor: pointer;
        border: none;
        background: transparent;
        width: 100%;
        text-align: left;
    }

    .modern-user-dropdown .dropdown-action-item:hover {
        background: #f1f5f9;
        color: #0f172a;
    }

    .modern-user-dropdown .dropdown-action-item.text-danger:hover {
        background: #fef2f2;
        color: #dc2626 !important;
    }
</style>

<nav class="main-header navbar navbar-expand navbar-white navbar-light modern-navbar">
    <!-- Left navbar links -->
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link nav-link-btn" data-widget="pushmenu" href="#" role="button" title="Toggle Sidebar">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Modern Date & Live Time Widget -->
    <div class="d-none d-sm-flex align-items-center nav-date-widget">
        <i class="far fa-calendar-alt text-primary"></i>
        <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
        <span class="text-muted">•</span>
        <i class="far fa-clock text-secondary"></i>
        <span id="navbar-live-clock" class="font-weight-bold">--:--:--</span>
        <span class="badge-live">Live</span>
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto align-items-center">
        <!-- Fullscreen Button -->
        <li class="nav-item d-none d-md-block mr-1">
            <a class="nav-link nav-link-btn" data-widget="fullscreen" href="#" role="button" title="Layar Penuh">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- User Profile Dropdown -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=2563eb&color=fff&bold=true"
                    class="user-avatar" alt="{{ Auth::user()->name ?? 'User' }}">
                <span class="d-none d-md-inline user-name">{{ Auth::user()->name ?? 'User' }}</span>
                <i class="fas fa-chevron-down fa-xs text-muted ml-1"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right modern-user-dropdown">
                <!-- User Profile Header -->
                <li class="user-header">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=2563eb&color=fff&bold=true"
                        class="img-circle" alt="{{ Auth::user()->name ?? 'User' }}">
                    <h6 class="user-title">{{ Auth::user()->name ?? 'User' }}</h6>
                    <div>
                        <span class="user-role-badge">
                            {{ Auth::user()->roles->pluck('name')->first() ?? (Auth::user()->posisi ?? 'Staff') }}
                        </span>
                    </div>
                    <p class="user-joined">
                        <i class="far fa-calendar-check mr-1"></i>
                        Bergabung sejak {{ Auth::user()->created_at ? Auth::user()->created_at->format('M Y') : date('M Y') }}
                    </p>
                </li>

                <!-- User Dropdown Actions -->
                <li class="user-body">
                    @can('users.index')
                        <a href="{{ route('users.index') }}" class="dropdown-action-item">
                            <i class="fas fa-users-cog text-primary"></i>
                            <span>Manajemen Akun</span>
                        </a>
                    @endcan

                    <button type="button" class="dropdown-action-item text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Keluar / Sign Out</span>
                    </button>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function updateLiveClock() {
            var clockEl = document.getElementById('navbar-live-clock');
            if (clockEl) {
                var now = new Date();
                var hours = String(now.getHours()).padStart(2, '0');
                var minutes = String(now.getMinutes()).padStart(2, '0');
                var seconds = String(now.getSeconds()).padStart(2, '0');
                clockEl.textContent = hours + ':' + minutes + ':' + seconds;
            }
        }
        setInterval(updateLiveClock, 1000);
        updateLiveClock();
    });
</script>
