@extends('layouts.app')

@push('page_css')
<style>
/* Stat Cards Styling */
.stat-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border-radius: 12px;
    border: none;
    overflow: hidden;
}
.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1) !important;
}
.stat-icon-wrapper {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
}

/* Filter Card Styling */
.filter-card {
    border-radius: 12px;
    border: 1px solid #e3e6f0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.filter-card .form-control {
    border-radius: 6px;
    font-size: 0.88rem;
    height: calc(1.5em + 0.9rem + 2px);
    border: 1px solid #ced4da;
}
.filter-card .form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.15);
}

/* DataTables Controls & Toolbar Styling */
.dt-toolbar-custom {
    gap: 12px;
}
div.dt-buttons.btn-group {
    display: inline-flex !important;
    gap: 6px !important;
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}
div.dt-buttons.btn-group > .btn,
div.dt-buttons.btn-group > .btn-secondary,
div.dt-buttons .btn,
div.dt-buttons .btn-secondary,
div.dt-buttons .dt-button,
div.dt-buttons > button.btn {
    border-radius: 6px !important;
    font-size: 0.82rem !important;
    padding: 6px 13px !important;
    font-weight: 600 !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06) !important;
    background-color: #ffffff !important;
    background: #ffffff !important;
    border: 1px solid #ced4da !important;
    color: #495057 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    margin: 0 !important;
    transition: all 0.15s ease-in-out;
}
div.dt-buttons.btn-group > .btn:hover,
div.dt-buttons.btn-group > .btn-secondary:hover,
div.dt-buttons .btn:hover,
div.dt-buttons .btn-secondary:hover,
div.dt-buttons .dt-button:hover,
div.dt-buttons > button.btn:hover {
    background-color: #f1f3f5 !important;
    background: #f1f3f5 !important;
    border-color: #adb5bd !important;
    color: #007bff !important;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08) !important;
    transform: translateY(-1px);
}
div.dataTables_wrapper div.dataTables_length label {
    margin-bottom: 0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    font-weight: 500 !important;
    color: #495057 !important;
    font-size: 0.88rem !important;
}
div.dataTables_wrapper div.dataTables_length select {
    border-radius: 6px !important;
    padding: 4px 10px !important;
    border: 1px solid #ced4da !important;
    font-size: 0.88rem !important;
    height: auto !important;
    min-width: 65px;
}
div.dataTables_wrapper div.dataTables_filter label {
    margin-bottom: 0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    font-weight: 500 !important;
    color: #495057 !important;
    font-size: 0.88rem !important;
}
div.dataTables_wrapper div.dataTables_filter input {
    border-radius: 6px !important;
    padding: 5px 12px !important;
    border: 1px solid #ced4da !important;
    font-size: 0.88rem !important;
    height: auto !important;
    margin-left: 0 !important;
    min-width: 200px;
}

/* Modern Table Grid & Perfect Border Alignment */
.table-responsive {
    overflow-x: auto !important;
    -webkit-overflow-scrolling: touch;
    margin-bottom: 10px;
}
#mytable {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #dcdfe4 !important;
    margin: 0 !important;
}
#mytable th,
#mytable td {
    border: 1px solid #dcdfe4 !important;
    vertical-align: middle !important;
}
#mytable thead th {
    background-color: #f4f6f9 !important;
    color: #343a40 !important;
    font-weight: 700 !important;
    font-size: 0.83rem !important;
    text-align: center !important;
    vertical-align: middle !important;
    white-space: nowrap !important;
    padding: 11px 10px !important;
    border-bottom: 2px solid #b8bfc7 !important;
}
#mytable tbody td {
    font-size: 0.84rem !important;
    padding: 8px 10px !important;
    white-space: nowrap;
}
#mytable.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fafbfc;
}
#mytable.table-hover tbody tr:hover {
    background-color: #f0f4f9;
}

/* Status Badges */
.badge-status {
    padding: 5px 10px;
    font-size: 0.8rem;
    font-weight: 600;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.nomer-link {
    font-weight: 600;
    color: #0066cc;
    text-decoration: none;
}
.nomer-link:hover {
    color: #004499;
    text-decoration: underline;
}
.masalah-cell {
    max-width: 300px;
    white-space: normal !important;
    word-break: break-word;
    font-size: 0.82rem;
    line-height: 1.4;
}
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="content-header pt-3 pb-2">
    <div class="container-fluid">
        <div class="mb-3 row align-items-center">
            <div class="col-sm-7">
                <h1 class="m-0 font-weight-bold text-dark">
                    <i class="fas fa-hourglass-half text-warning mr-2"></i>Rekap Keluhan Open & Proses
                </h1>
                <p class="text-muted small mb-0 mt-1">
                    Daftar rekap keluhan pelanggan eksternal yang masih berstatus Open dan dalam proses penyelesaian
                </p>
            </div>
            <div class="col-sm-5 text-right">
                <ol class="breadcrumb float-sm-right bg-transparent p-0 mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('keluhan.index') }}">Keluhan</a></li>
                    <li class="breadcrumb-item active">Open & Proses</li>
                </ol>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('keluhan.index') }}" class="btn btn-sm btn-outline-secondary mr-2">
                        <i class="fas fa-arrow-left mr-1"></i> Daftar Keluhan
                    </a>
                    <a href="{{ route('data.verifikasi') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-tasks mr-1"></i> Rekap Verifikasi
                    </a>
                </div>
            </div>
        </div>

        @include('components.alert')
        @include('sweetalert::alert')
    </div>
</section>

<!-- Main content -->
<section class="content pb-4">
    <div class="container-fluid">

        <!-- Stat Cards Row -->
        <div class="row mb-3">
            <div class="col-12 col-sm-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card stat-card shadow-sm h-100" style="border-left: 4px solid #ffc107 !important;">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Open & Proses</span>
                            <h3 class="mb-0 font-weight-bold text-dark mt-1">{{ number_format($totalData, 0, ',', '.') }}</h3>
                            <small class="text-muted">Keluhan aktif belum selesai</small>
                        </div>
                        <div class="stat-icon-wrapper bg-light text-warning">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card stat-card shadow-sm h-100" style="border-left: 4px solid #fd7e14 !important;">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Status Open</span>
                            <h3 class="mb-0 font-weight-bold text-warning mt-1">{{ number_format($totalOpen, 0, ',', '.') }}</h3>
                            <small class="text-warning font-weight-bold">
                                {{ $totalData > 0 ? round(($totalOpen / $totalData) * 100) : 0 }}% belum diproses
                            </small>
                        </div>
                        <div class="stat-icon-wrapper bg-light text-warning">
                            <i class="fas fa-hourglass-start"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card stat-card shadow-sm h-100" style="border-left: 4px solid #007bff !important;">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Status Proses</span>
                            <h3 class="mb-0 font-weight-bold text-primary mt-1">{{ number_format($totalProses, 0, ',', '.') }}</h3>
                            <small class="text-primary font-weight-bold">Dalam tahap investigasi</small>
                        </div>
                        <div class="stat-icon-wrapper bg-light text-primary">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card stat-card shadow-sm h-100" style="border-left: 4px solid #6f42c1 !important;">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Buyer Terdampak</span>
                            <h3 class="mb-0 font-weight-bold mt-1" style="color: #6f42c1;">{{ number_format($totalBuyer, 0, ',', '.') }}</h3>
                            <small class="text-muted">Total entitas buyer unik</small>
                        </div>
                        <div class="stat-icon-wrapper bg-light" style="color: #6f42c1;">
                            <i class="fas fa-building"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="card filter-card mb-3">
            <div class="card-header bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">
                    <i class="fas fa-filter text-primary mr-2"></i>Filter Rentang Tanggal & Status
                </h6>
                <span class="badge badge-light border text-muted">
                    Periode: {{ $currentTime->format('d/m/Y') }} &mdash; {{ $currentTime2->format('d/m/Y') }}
                </span>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('keluhan.data.open') }}" method="GET" class="row align-items-end">
                    <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-0">
                        <label class="small font-weight-bold text-muted mb-1">
                            <i class="far fa-calendar-alt mr-1"></i>Tanggal Mulai:
                        </label>
                        <input type="date" class="form-control" name="start_date"
                            value="{{ $currentTime->format('Y-m-d') }}">
                    </div>

                    <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-0">
                        <label class="small font-weight-bold text-muted mb-1">
                            <i class="far fa-calendar-alt mr-1"></i>Tanggal Sampai:
                        </label>
                        <input type="date" class="form-control" name="end_date"
                            value="{{ $currentTime2->format('Y-m-d') }}">
                    </div>

                    <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-0">
                        <label class="small font-weight-bold text-muted mb-1">
                            <i class="fas fa-info-circle mr-1"></i>Status:
                        </label>
                        <select class="form-control" name="status" id="status">
                            <option value="" {{ empty($status) ? 'selected' : '' }}>Semua (Open & Proses)</option>
                            <option value="open" {{ $status == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="proses" {{ $status == 'proses' ? 'selected' : '' }}>Proses</option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-block mr-2" style="border-radius: 6px;">
                            <i class="fas fa-search mr-1"></i> Terapkan Filter
                        </button>
                        <a href="{{ route('keluhan.data.open') }}" class="btn btn-outline-secondary" style="border-radius: 6px;" title="Reset Filter">
                            <i class="fas fa-undo"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Main Table Card -->
        <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="card-header bg-white py-3 px-3 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-table mr-2 text-primary"></i>Register Keluhan Status Open & Proses
                    </h5>
                    <small class="text-muted">Daftar keluhan yang membutuhkan penanganan lebih lanjut</small>
                </div>
                <span class="badge badge-warning px-3 py-2 text-dark font-weight-bold" style="font-size: 0.85rem; border-radius: 20px;">
                    {{ number_format($totalData, 0, ',', '.') }} Baris
                </span>
            </div>

            <div class="card-body p-3">
                <table id="mytable" class="table table-bordered table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 40px;">No</th>
                                <th style="width: 70px;">Aksi</th>
                                <th style="width: 140px;">No FKP</th>
                                <th style="width: 95px;">Tanggal FKP</th>
                                <th style="width: 90px;">Status</th>
                                <th>Marketing</th>
                                <th>Buyer</th>
                                <th style="width: 150px;">No. WO / No. SC</th>
                                <th style="width: 160px;">Motif / Quantity</th>
                                <th>Masalah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($complaints as $index => $item)
                            <tr>
                                <td class="text-center font-weight-bold text-muted">{{ $index + 1 }}</td>
                                <td class="text-center">
                                    <a href="{{ route('proses.detail', $item->id) }}" target="_blank" class="btn btn-xs btn-outline-primary" title="Buka Detail Keluhan" style="border-radius: 4px; padding: 3px 8px;">
                                        <i class="fas fa-external-link-alt mr-1"></i> Detail
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('proses.detail', $item->id) }}" target="_blank" class="nomer-link">
                                        <i class="far fa-file-alt mr-1 text-primary"></i>{{ $item->nomer_keluhan }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <span class="text-dark font-weight-500">
                                        {{ \Carbon\Carbon::parse($item->tgl_keluhan)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($item->status == 'open')
                                        <span class="badge-status badge-warning text-dark"><i class="fas fa-hourglass-start"></i> Open</span>
                                    @elseif ($item->status == 'proses')
                                        <span class="badge-status badge-primary"><i class="fas fa-spinner fa-spin"></i> Proses</span>
                                    @else
                                        <span class="badge-status badge-light border">{{ ucfirst($item->status ?? '-') }}</span>
                                    @endif
                                </td>
                                <td>{{ $item->nama_marketing ?? '-' }}</td>
                                <td>
                                    <strong class="text-dark">{{ $item->buyer ? $item->buyer->nama_buyer : ($item->nama_buyer ?? '-') }}</strong>
                                </td>
                                <td>
                                    <div class="small">
                                        <strong>WO:</strong> {{ $item->no_wo ?? '-' }}<br>
                                        <strong>SC:</strong> {{ $item->no_sc ?? '-' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <strong>Motif:</strong> {{ $item->nama_motif ?? '-' }}<br>
                                        <strong>Qty:</strong> {{ $item->cw_qty ?? '-' }}
                                    </div>
                                </td>
                                <td class="masalah-cell">
                                    <div class="text-muted">{!! $item->masalah ?? '-' !!}</div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-3x text-muted mb-2 d-block"></i>
                                    Tidak ada data keluhan berstatus Open atau Proses pada periode ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
            </div>
        </div>

    </div>
</section>
@endsection

@section('tablejs')
<script>
    $(document).ready(function () {
        $("#mytable").DataTable({
            "dom": "<'d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom dt-toolbar-custom'<'mb-2 mb-md-0 d-flex align-items-center'l><'mb-2 mb-md-0 d-flex justify-content-center'B><'mb-2 mb-md-0 d-flex align-items-center'f>>" +
                   "<'row'<'col-12 table-responsive'tr>>" +
                   "<'row mt-3 align-items-center'<'col-12 col-md-5 text-muted small'i><'col-12 col-md-7 d-flex justify-content-md-end'p>>",
            "deferRender": true,
            "autoWidth": false,
            "pageLength": 25,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
            "order": [[0, "asc"]],
            "columnDefs": [
                { "orderable": false, "targets": [1, 9] }
            ],
            "language": {
                "search": "Cari Cepat:",
                "searchPlaceholder": "Ketik nomor, buyer, dll...",
                "lengthMenu": "Tampilkan _MENU_ baris",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 data",
                "infoFiltered": "(disaring dari _MAX_ total data)",
                "zeroRecords": "Tidak ada data yang sesuai dengan pencarian",
                "paginate": {
                    "first": '<i class="fas fa-angle-double-left"></i>',
                    "last": '<i class="fas fa-angle-double-right"></i>',
                    "next": '<i class="fas fa-angle-right"></i>',
                    "previous": '<i class="fas fa-angle-left"></i>'
                }
            },
            "buttons": [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel text-success mr-1"></i> Excel',
                    className: 'btn'
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv text-primary mr-1"></i> CSV',
                    className: 'btn'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf text-danger mr-1"></i> PDF',
                    className: 'btn',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print text-dark mr-1"></i> Cetak',
                    className: 'btn'
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-columns text-info mr-1"></i> Kolom',
                    className: 'btn'
                }
            ]
        });
    });
</script>
@endsection
