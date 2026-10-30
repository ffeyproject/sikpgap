<style>
    /* ========================================================
       MODERN FOOTER STYLING
       ======================================================== */
    .modern-footer {
        background: #ffffff !important;
        border-top: 1px solid #e2e8f0 !important;
        padding: 0.85rem 1.25rem !important;
        font-size: 0.84rem !important;
        color: #64748b;
        transition: all 0.25s ease;
    }

    .modern-footer .footer-brand-link {
        color: #2563eb !important;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.15s ease;
    }

    .modern-footer .footer-brand-link:hover {
        color: #1d4ed8 !important;
        text-decoration: underline;
    }

    .modern-footer .footer-badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f0fdf4;
        color: #15803d;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
        border: 1px solid #bbf7d0;
    }

    .modern-footer .status-indicator-dot {
        width: 7px;
        height: 7px;
        background: #22c55e;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.2);
    }

    .modern-footer .footer-badge-version {
        display: inline-flex;
        align-items: center;
        background: #f8fafc;
        color: #475569;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
    }
</style>

<footer class="main-footer modern-footer">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
        <div class="footer-left mb-2 mb-sm-0 text-center text-sm-left">
            <span>Copyright &copy; {{ date('Y') }}</span>
            <a href="http://gajahtex.com/" target="_blank" class="footer-brand-link ml-1 mr-1">
                PT. Gajah Angkasa Perkasa
            </a>
            <span class="d-none d-md-inline text-muted">— Sistem Informasi Keluhan & Kepuasan Pelanggan (SI K2P)</span>
        </div>
        <div class="footer-right d-flex align-items-center">
            <span class="footer-badge-status mr-2">
                <span class="status-indicator-dot"></span>
                <span>System Online</span>
            </span>
            <span class="footer-badge-version">
                <i class="fas fa-code-branch fa-xs mr-1 text-primary"></i>v1.0.2
            </span>
        </div>
    </div>
</footer>

