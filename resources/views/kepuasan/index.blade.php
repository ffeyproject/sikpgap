@extends('layouts.app')

@push('page_css')
<style>
/* Stat KPI Cards Styling */
.stat-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    cursor: pointer;
    border-radius: 12px;
    border: none;
    overflow: hidden;
}
.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
}
.stat-card.active-filter {
    outline: 3px solid #007bff;
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

/* Quick Filter Button Group */
.filter-btn-group .btn {
    border-radius: 20px;
    margin-right: 6px;
    margin-bottom: 6px;
    font-size: 0.85rem;
    padding: 5px 14px;
    font-weight: 500;
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

/* Modern Table Grid & Typography Styling */
.table-modern {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #dcdfe4 !important;
    margin: 0 !important;
}
.table-modern th,
.table-modern td {
    border: 1px solid #dcdfe4 !important;
    vertical-align: middle !important;
}
.table-modern thead th {
    background-color: #f4f6f9 !important;
    color: #333333 !important;
    font-weight: 700 !important;
    font-size: 0.84rem !important;
    text-align: center !important;
    vertical-align: middle !important;
    white-space: nowrap !important;
    padding: 11px 10px !important;
    border-bottom: 2px solid #b8bfc7 !important;
}
.table-modern tbody td {
    font-size: 0.84rem !important;
    padding: 8px 10px !important;
    color: #333333;
}
.table-modern.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fafbfc;
}
.table-modern.table-hover tbody tr:hover {
    background-color: #f0f4f9;
}

.badge-status {
    padding: 5px 11px;
    font-size: 0.8rem;
    font-weight: 600;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.btn-action-icon {
    width: 32px;
    height: 32px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
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
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-7">
                <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.55rem;">
                    <i class="fas fa-smile text-primary mr-2"></i>Evaluasi Kepuasan Pelanggan
                </h1>
                <p class="text-muted small mb-0 mt-1">
                    Kelola dan pantau seluruh survei kepuasan pelanggan terhadap mutu produk dan pelayanan PT. Gajah Angkasa Perkasa
                </p>
            </div>
            <div class="col-12 col-md-5 text-md-right mt-3 mt-md-0">
                <ol class="breadcrumb bg-transparent p-0 mb-2 justify-content-md-end small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                    <li class="breadcrumb-item active text-primary">Kepuasan Pelanggan</li>
                </ol>
                <div class="d-flex justify-content-md-end gap-2">
                    <a href="{{ route('kepuasan.laporan') }}" class="btn btn-outline-info btn-sm mr-2 shadow-sm" style="border-radius: 6px;">
                        <i class="fas fa-chart-line mr-1"></i> Laporan Kepuasan
                    </a>
                    <a href="{{ route('kepuasan.create') }}" class="btn btn-primary btn-sm shadow-sm" style="border-radius: 6px;">
                        <i class="fas fa-plus mr-1"></i> Buat Penilaian Baru
                    </a>
                </div>
            </div>
        </div>
        @include('components.alert')

        <!-- KPI Stat Cards (Filterable) -->
        <div class="row mb-3">
            <!-- Total Survei -->
            <div class="col-12 col-sm-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card stat-card shadow-sm h-100 active-filter" id="card-all" onclick="applyStatusFilter('')" style="border-left: 4px solid #007bff !important;">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.72rem; letter-spacing: 0.5px;">Total Lembar Survei</span>
                            <h3 class="mb-0 font-weight-bold text-dark mt-1">{{ number_format($total ?? 0, 0, ',', '.') }}</h3>
                            <small class="text-primary font-weight-bold"><i class="fas fa-layer-group mr-1"></i>Semua Status</small>
                        </div>
                        <div class="stat-icon-wrapper bg-light text-primary">
                            <i class="fas fa-poll-h"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Open -->
            <div class="col-12 col-sm-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card stat-card shadow-sm h-100" id="card-open" onclick="applyStatusFilter('open')" style="border-left: 4px solid #ffc107 !important;">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.72rem; letter-spacing: 0.5px;">Status Open</span>
                            <h3 class="mb-0 font-weight-bold text-dark mt-1">{{ number_format($totalOpen ?? 0, 0, ',', '.') }}</h3>
                            <small class="text-warning font-weight-bold"><i class="fas fa-hourglass-start mr-1"></i>Belum Diisi Lengkap</small>
                        </div>
                        <div class="stat-icon-wrapper bg-light text-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Tersimpan -->
            <div class="col-12 col-sm-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card stat-card shadow-sm h-100" id="card-tersimpan" onclick="applyStatusFilter('tersimpan')" style="border-left: 4px solid #17a2b8 !important;">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.72rem; letter-spacing: 0.5px;">Status Tersimpan</span>
                            <h3 class="mb-0 font-weight-bold text-dark mt-1">{{ number_format($totalTersimpan ?? 0, 0, ',', '.') }}</h3>
                            <small class="text-info font-weight-bold"><i class="fas fa-save mr-1"></i>Dapat Diubah Nilainya</small>
                        </div>
                        <div class="stat-icon-wrapper bg-light text-info">
                            <i class="fas fa-save"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Closed -->
            <div class="col-12 col-sm-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card stat-card shadow-sm h-100" id="card-closed" onclick="applyStatusFilter('closed')" style="border-left: 4px solid #28a745 !important;">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.72rem; letter-spacing: 0.5px;">Status Closed</span>
                            <h3 class="mb-0 font-weight-bold text-dark mt-1">{{ number_format($totalClosed ?? 0, 0, ',', '.') }}</h3>
                            <small class="text-success font-weight-bold"><i class="fas fa-lock mr-1"></i>Terkunci Permanen</small>
                        </div>
                        <div class="stat-icon-wrapper bg-light text-success">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Main Table Content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
                    
                    <!-- Card Header Filter -->
                    <div class="card-header bg-white py-3 border-bottom">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="filter-btn-group mb-2 mb-md-0">
                                <span class="mr-2 text-muted small font-weight-bold">Filter Cepat:</span>
                                <button type="button" class="btn btn-outline-secondary btn-sm active" id="btn-filter-all" onclick="applyStatusFilter('')">
                                    Semua ({{ $total }})
                                </button>
                                <button type="button" class="btn btn-outline-warning btn-sm" id="btn-filter-open" onclick="applyStatusFilter('open')">
                                    Open ({{ $totalOpen }})
                                </button>
                                <button type="button" class="btn btn-outline-info btn-sm" id="btn-filter-tersimpan" onclick="applyStatusFilter('tersimpan')">
                                    Tersimpan ({{ $totalTersimpan }})
                                </button>
                                <button type="button" class="btn btn-outline-success btn-sm" id="btn-filter-closed" onclick="applyStatusFilter('closed')">
                                    Closed ({{ $totalClosed }})
                                </button>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-light border text-muted px-3 py-2" style="font-size: 0.85rem; border-radius: 20px;">
                                    <i class="fas fa-star text-warning mr-1"></i> Rata-rata Skor: <strong>{{ number_format($avgScore, 2) }}</strong> / 100
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body Table -->
                    <div class="card-body p-3">
                        <table id="t_kepuasan" class="table table-bordered table-striped table-hover table-modern w-100">
                            <thead>
                                <tr>
                                    <th style="width: 45px;">No</th>
                                    <th style="width: 100px;">Aksi</th>
                                    <th style="width: 140px;">Kode Penilaian</th>
                                    <th style="width: 110px;">Tanggal</th>
                                    <th>Nama Buyer / Pelanggan</th>
                                    <th style="width: 140px;">Nama Kontak</th>
                                    <th>Alamat Perusahaan</th>
                                    <th style="width: 110px;">Rata-Rata Nilai</th>
                                    <th style="width: 95px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($kepuasan as $item)
                                <tr>
                                    <td class="text-center font-weight-bold text-muted">{{ $no++ }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('kepuasan.vpenilaian', $item->id) }}" target="_blank" class="btn btn-info btn-action-icon" title="Buka Detail Lembar Penilaian">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('kepuasan.cetak', $item->id) }}" target="_blank" class="btn btn-outline-secondary btn-action-icon" title="Cetak Laporan">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            @if($item->status == 'open')
                                            <form action="{{ route('kepuasan.destroy', $item->id) }}" method="POST" class="d-inline form-delete-survei">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-action-icon btn-delete-confirm" title="Hapus Data (Hanya Status Open)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('kepuasan.vpenilaian', $item->id) }}" target="_blank" class="nomer-link text-nowrap" title="Buka Detail Penilaian">
                                            <i class="far fa-file-alt mr-1 text-primary"></i>{{ $item->kode_penilaian }}
                                        </a>
                                    </td>
                                    <td class="text-center text-nowrap">
                                        @if($item->tgl_penilaian)
                                            <span class="font-weight-500 text-dark"><i class="far fa-calendar-alt text-muted mr-1"></i>{{ \Carbon\Carbon::parse($item->tgl_penilaian)->format('d/m/Y') }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="font-weight-bold text-dark">
                                            <i class="fas fa-building text-muted mr-1"></i>{{ $item->buyer?->nama_buyer ?? ($item->nama_pelanggan ?? '-') }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->nama_kontak)
                                            <span class="text-dark small"><i class="fas fa-user-circle text-muted mr-1"></i>{{ $item->nama_kontak }}</span>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="small text-muted text-truncate" style="max-width: 260px;" title="{{ $item->alamat }}">
                                            <i class="fas fa-map-marker-alt text-danger mr-1"></i>{{ $item->alamat ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($item->r_nilai !== null && $item->r_nilai > 0)
                                            @if($item->r_nilai >= 80)
                                                <span class="badge badge-success px-2 py-1 font-weight-bold" style="font-size: 0.85rem;">
                                                    <i class="fas fa-star mr-1"></i>{{ number_format($item->r_nilai, 2) }}
                                                </span>
                                            @elseif($item->r_nilai >= 60)
                                                <span class="badge badge-primary px-2 py-1 font-weight-bold" style="font-size: 0.85rem;">
                                                    <i class="fas fa-check mr-1"></i>{{ number_format($item->r_nilai, 2) }}
                                                </span>
                                            @elseif($item->r_nilai >= 40)
                                                <span class="badge badge-warning text-dark px-2 py-1 font-weight-bold" style="font-size: 0.85rem;">
                                                    {{ number_format($item->r_nilai, 2) }}
                                                </span>
                                            @else
                                                <span class="badge badge-danger px-2 py-1 font-weight-bold" style="font-size: 0.85rem;">
                                                    {{ number_format($item->r_nilai, 2) }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-muted small">0.00</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->status == 'closed')
                                            <span class="badge-status badge-secondary text-white"><i class="fas fa-lock"></i> Closed</span>
                                        @elseif($item->status == 'Tersimpan')
                                            <span class="badge-status badge-primary text-white"><i class="fas fa-save"></i> Tersimpan</span>
                                        @elseif($item->status == 'open')
                                            <span class="badge-status badge-warning text-dark"><i class="fas fa-hourglass-start"></i> Open</span>
                                        @else
                                            <span class="badge-status badge-light border">{{ ucfirst($item->status ?? '-') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">
                                        <i class="fas fa-inbox fa-3x text-muted mb-2 d-block"></i>
                                        Belum ada data lembar evaluasi kepuasan pelanggan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('tablejs')
<script>
    var dataTableInstance = null;

    function applyStatusFilter(status) {
        if (!dataTableInstance) return;

        // Status column is index 8
        if (status === '') {
            dataTableInstance.column(8).search('').draw();
        } else {
            dataTableInstance.column(8).search(status, true, false).draw();
        }

        $('.stat-card').removeClass('active-filter');
        $('.filter-btn-group .btn').removeClass('active');

        if (status === '') {
            $('#card-all').addClass('active-filter');
            $('#btn-filter-all').addClass('active');
        } else if (status === 'open') {
            $('#card-open').addClass('active-filter');
            $('#btn-filter-open').addClass('active');
        } else if (status === 'tersimpan') {
            $('#card-tersimpan').addClass('active-filter');
            $('#btn-filter-tersimpan').addClass('active');
        } else if (status === 'closed') {
            $('#card-closed').addClass('active-filter');
            $('#btn-filter-closed').addClass('active');
        }
    }

    $(document).ready(function () {
        dataTableInstance = $("#t_kepuasan").DataTable({
            "dom": "<'d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom dt-toolbar-custom'<'mb-2 mb-md-0 d-flex align-items-center'l><'mb-2 mb-md-0 d-flex justify-content-center'B><'mb-2 mb-md-0 d-flex align-items-center'f>>" +
                   "<'row'<'col-12 table-responsive'tr>>" +
                   "<'row mt-3 align-items-center'<'col-12 col-md-5 text-muted small'i><'col-12 col-md-7 d-flex justify-content-md-end'p>>",
            "deferRender": true,
            "autoWidth": false,
            "pageLength": 25,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
            "order": [[0, "asc"]],
            "columnDefs": [
                { "orderable": false, "targets": [1] }
            ],
            "language": {
                "search": "Cari Cepat:",
                "searchPlaceholder": "Ketik nomor, buyer, alamat...",
                "lengthMenu": "Tampilkan _MENU_ baris",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 data",
                "infoFiltered": "(disaring dari _MAX_ total data)",
                "zeroRecords": "Tidak ada data yang sesuai",
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

        // SweetAlert2 confirmation for delete
        $('.btn-delete-confirm').on('click', function (e) {
            e.preventDefault();
            var form = $(this).closest('form');
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Hapus Lembar Penilaian?',
                    text: 'Data penilaian yang berstatus Open ini akan dihapus secara permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> Ya, Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then(function (result) {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            } else {
                if (confirm('Apakah Anda yakin ingin menghapus data lembar penilaian ini?')) {
                    form.submit();
                }
            }
        });
    });
</script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
@endsection
