<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('dist/img/logo_gajah.png') }}">
    <title>SIKP GAP</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/mapp.css') }}" rel="stylesheet">

    <!-- Modern Global UI Theme -->
    <style>
        body {
            background-color: #f4f6f9;
            color: #334155;
        }

        .content-wrapper {
            background-color: #f8fafc;
        }

        /* Modern Page Header */
        .content-header {
            padding: 1.25rem 0.75rem 1rem 0.75rem;
        }

        .page-header-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .page-title-box {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .page-title-box .page-title-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.15);
        }

        .page-title-box h1 {
            font-size: 1.45rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            line-height: 1.2;
        }

        .page-title-box .page-subtitle {
            font-size: 0.82rem;
            color: #64748b;
            margin: 0.2rem 0 0 0;
        }

        /* Modern Breadcrumbs */
        .breadcrumb-modern {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 0.4rem 0.85rem;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-bottom: 0;
        }

        .breadcrumb-modern .breadcrumb-item a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .breadcrumb-modern .breadcrumb-item a:hover {
            color: #2563eb;
        }

        .breadcrumb-modern .breadcrumb-item.active {
            color: #1e293b;
            font-weight: 600;
        }

        /* Modern Card */
        .card.card-modern {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04), 0 2px 4px -2px rgba(0, 0, 0, 0.02);
            background: #ffffff;
            overflow: hidden;
            transition: box-shadow 0.25s ease;
            margin-bottom: 1.5rem;
        }

        .card.card-modern:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.06), 0 4px 6px -4px rgba(0, 0, 0, 0.03);
        }

        .card.card-modern .card-header {
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.1rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card.card-modern .card-title {
            font-size: 1.05rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card.card-modern .card-body {
            padding: 1.4rem;
        }

        .card.card-modern .card-footer {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 1rem 1.4rem;
        }

        /* Modern Buttons */
        .btn-modern-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff !important;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.1rem;
            font-weight: 500;
            font-size: 0.88rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none !important;
        }

        .btn-modern-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
        }

        .btn-modern-secondary {
            background: #f1f5f9;
            color: #475569 !important;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0.5rem 1.1rem;
            font-weight: 500;
            font-size: 0.88rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            text-decoration: none !important;
        }

        .btn-modern-secondary:hover {
            background: #e2e8f0;
            color: #1e293b !important;
        }

        /* Modern Action Buttons */
        .action-btn-group {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-action-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.82rem;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            padding: 0;
            text-decoration: none !important;
        }

        .btn-action-edit {
            background: #fef3c7;
            color: #b45309 !important;
            border-color: #fde68a;
        }

        .btn-action-edit:hover {
            background: #d97706;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(217, 119, 6, 0.25);
        }

        .btn-action-delete {
            background: #fee2e2;
            color: #dc2626 !important;
            border-color: #fecaca;
        }

        .btn-action-delete:hover {
            background: #dc2626;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(220, 38, 38, 0.25);
        }

        /* Modern Table */
        .table-modern {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            overflow: hidden !important;
        }

        .table-modern thead th {
            background: #f8fafc !important;
            color: #475569 !important;
            font-weight: 600 !important;
            font-size: 0.78rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            border-top: none !important;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 0.75rem 1rem !important;
            vertical-align: middle !important;
        }

        .table-modern tbody tr {
            transition: background-color 0.15s ease;
        }

        .table-modern tbody tr:hover {
            background-color: #f8fafc !important;
        }

        .table-modern tbody td {
            padding: 0.8rem 1rem !important;
            vertical-align: middle !important;
            border-top: 1px solid #f1f5f9 !important;
            font-size: 0.88rem !important;
            color: #334155 !important;
        }

        /* Chips & Badges */
        .badge-code {
            font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.25rem 0.55rem;
            border-radius: 6px;
            background: #f1f5f9;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            display: inline-block;
        }

        .badge-kategori-ext {
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            padding: 0.25rem 0.65rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-kategori-int {
            background: #f5f3ff;
            color: #6d28d9;
            border: 1px solid #ddd6fe;
            padding: 0.25rem 0.65rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-kategori-general {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
            padding: 0.25rem 0.65rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Modern Form Styling */
        .form-modern .form-group {
            margin-bottom: 1.25rem;
        }

        .form-modern label {
            font-weight: 600;
            font-size: 0.88rem;
            color: #334155;
            margin-bottom: 0.45rem;
        }

        .form-modern .form-control {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 0.55rem 0.85rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .form-modern .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        /* Modern Radio Card Choice */
        .radio-card-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .radio-card-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.1rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #ffffff;
            font-weight: 500;
            font-size: 0.88rem;
            color: #475569;
            margin-bottom: 0;
            user-select: none;
        }

        .radio-card-label:hover {
            border-color: #93c5fd;
            background: #f8fafc;
        }

        .radio-card-input:checked + .radio-card-label {
            border-color: #2563eb;
            background: #eff6ff;
            color: #1d4ed8;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.15);
        }

        .radio-card-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
    </style>
    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Header -->
        @include('layouts.navigation')

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                @yield('content')
            </section>
        </div>

        <!-- Main Footer -->
        @include('layouts.footer')
    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- Moment & Daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- DataTables & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>

    @yield('tablejs')
    @stack('scripts')
</body>

</html>
