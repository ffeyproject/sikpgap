@extends('layouts.app')

@push('page_css')
<style>
.stat-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    cursor: pointer;
    border-radius: 12px;
    border: none;
}
.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12) !important;
}
.stat-card.active-filter {
    outline: 3px solid #007bff;
}
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

/* Table Grid & Border Alignment Styling */
.table-responsive {
    overflow-x: auto !important;
    -webkit-overflow-scrolling: touch;
    margin-bottom: 10px;
}
#t_barang {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #dcdfe4 !important;
    margin: 0 !important;
}
#t_barang th,
#t_barang td {
    border: 1px solid #dcdfe4 !important;
    vertical-align: middle !important;
}
#t_barang thead th {
    background-color: #f4f6f9 !important;
    color: #333333 !important;
    font-weight: 700 !important;
    font-size: 0.84rem !important;
    text-align: center !important;
    vertical-align: middle !important;
    white-space: nowrap !important;
    padding: 11px 8px !important;
    border-bottom: 2px solid #b8bfc7 !important;
}
#t_barang tbody td {
    font-size: 0.84rem !important;
    padding: 8px 10px !important;
    white-space: nowrap;
}
#t_barang.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fafbfc;
}
#t_barang.table-hover tbody tr:hover {
    background-color: #f0f4f9;
}

.badge-status {
    padding: 5px 10px;
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
.modal-choice-card {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none !important;
    color: #333;
    display: block;
}
.modal-choice-card:hover {
    border-color: #007bff;
    background-color: #f8fbff;
    transform: translateY(-2px);
    color: #007bff;
}
.modal-choice-icon {
    font-size: 2.5rem;
    margin-bottom: 12px;
    display: block;
}
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="mb-3 row align-items-center">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold text-dark">
                    <i class="fas fa-clipboard-list text-primary mr-2"></i>Data Keluhan
                </h1>
                <p class="text-muted small mb-0 mt-1">Kelola dan pantau seluruh keluhan pelanggan dan internal secara real-time</p>
            </div>
            <div class="col-sm-6">
                <div class="float-sm-right mt-2 mt-sm-0">
                    <ol class="breadcrumb bg-transparent p-0 mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                        <li class="breadcrumb-item active">Keluhan</li>
                    </ol>
                    <button type="button" class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#keluhanModal">
                        <i class="fas fa-plus-circle mr-1"></i> Tambah Keluhan
                    </button>
                </div>
            </div>
        </div>

        <!-- Stat Cards / Overview -->
        <div class="row mb-2">
            <div class="col-6 col-lg-3">
                <div class="card stat-card shadow-sm active-filter" id="card-all" onclick="applyStatusFilter('')">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small font-weight-bold text-uppercase">Semua Keluhan</span>
                                <h3 class="mb-0 font-weight-bold text-dark">{{ $totalComplaint }}</h3>
                                <small class="text-primary font-weight-bold"><i class="fas fa-list mr-1"></i>Tampilkan Semua</small>
                            </div>
                            <div class="rounded-circle p-3 bg-light text-primary">
                                <i class="fas fa-boxes fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="card stat-card shadow-sm" id="card-open" onclick="applyStatusFilter('open')">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small font-weight-bold text-uppercase">Belum Diproses</span>
                                <h3 class="mb-0 font-weight-bold text-warning">{{ $totalOpen }}</h3>
                                <small class="text-warning font-weight-bold"><i class="fas fa-hourglass-start mr-1"></i>Status Open</small>
                            </div>
                            <div class="rounded-circle p-3 bg-light text-warning">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="card stat-card shadow-sm" id="card-proses" onclick="applyStatusFilter('proses')">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small font-weight-bold text-uppercase">Sedang Proses</span>
                                <h3 class="mb-0 font-weight-bold text-info">{{ $totalProses }}</h3>
                                <small class="text-info font-weight-bold"><i class="fas fa-sync-alt mr-1"></i>Dalam Penanganan</small>
                            </div>
                            <div class="rounded-circle p-3 bg-light text-info">
                                <i class="fas fa-spinner fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="card stat-card shadow-sm" id="card-selesai" onclick="applyStatusFilter('selesai')">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small font-weight-bold text-uppercase">Selesai / VA</span>
                                <h3 class="mb-0 font-weight-bold text-success">{{ $totalSelesai }}</h3>
                                <small class="text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i>Tuntas</small>
                            </div>
                            <div class="rounded-circle p-3 bg-light text-success">
                                <i class="fas fa-check-double fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Pilih Jenis Keluhan -->
<div class="modal fade" id="keluhanModal" tabindex="-1" aria-labelledby="keluhanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0" style="border-radius: 16px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title font-weight-bold" id="keluhanModalLabel">
                    <i class="fas fa-folder-plus text-primary mr-2"></i>Pilih Sumber Keluhan
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-3 pb-4">
                <p class="text-muted small mb-3">Tentukan sumber keluhan yang akan Anda daftarkan ke dalam sistem:</p>
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('keluhan.create') }}" class="modal-choice-card">
                            <i class="fas fa-user-tie modal-choice-icon text-primary"></i>
                            <h6 class="font-weight-bold mb-1">Eksternal</h6>
                            <small class="text-muted">Dari Buyer / Pelanggan</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('keluhan.internal') }}" class="modal-choice-card">
                            <i class="fas fa-industry modal-choice-icon text-success"></i>
                            <h6 class="font-weight-bold mb-1">Internal</h6>
                            <small class="text-muted">Dari Departemen Pabrik</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-bottom">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="filter-btn-group mb-2 mb-md-0">
                                <span class="mr-2 text-muted small font-weight-bold">Filter Cepat:</span>
                                <button type="button" class="btn btn-outline-secondary btn-sm active" id="btn-filter-all" onclick="applyStatusFilter('')">Semua ({{ $totalComplaint }})</button>
                                <button type="button" class="btn btn-outline-warning btn-sm" id="btn-filter-open" onclick="applyStatusFilter('open')">Open ({{ $totalOpen }})</button>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="btn-filter-proses" onclick="applyStatusFilter('proses')">Proses ({{ $totalProses }})</button>
                                <button type="button" class="btn btn-outline-success btn-sm" id="btn-filter-selesai" onclick="applyStatusFilter('selesai')">Selesai ({{ $totalSelesai }})</button>
                            </div>
                            <div class="text-muted small">
                                <i class="fas fa-info-circle text-primary mr-1"></i> Data diperbarui otomatis
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-3">
                        @include('sweetalert::alert')

                        <table id="t_barang" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 40px;" class="text-center">No</th>
                                        <th style="width: 50px;" class="text-center">Aksi</th>
                                        <th style="min-width: 120px;">Nomer Keluhan</th>
                                        <th style="min-width: 90px;" class="text-center">Tanggal</th>
                                        <th style="min-width: 80px;" class="text-center">Jenis</th>
                                        <th style="min-width: 90px;" class="text-center">Kategori</th>
                                        <th style="min-width: 160px;">Nama Buyer</th>
                                        <th style="min-width: 100px;">Marketing</th>
                                        <th style="min-width: 95px;" class="text-center">Tgl Proses</th>
                                        <th style="min-width: 100px;" class="text-center">Status Internal</th>
                                        <th style="min-width: 75px;" class="text-center">Close Mkt</th>
                                        <th style="min-width: 140px;">Pesan Terakhir</th>
                                        @if (Auth::user()->posisi == 'qa' || Auth::user()->posisi == 'Admin')
                                        <th style="min-width: 110px;" class="text-center">Tindakan QA</th>
                                        <th style="min-width: 100px;" class="text-center">Hasil Scan</th>
                                        <th style="min-width: 65px;" class="text-center">CT/SP</th>
                                        <th style="min-width: 160px;">Verifikasi Akhir</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
@php $no = 1; @endphp
@foreach ($complaint as $item)
<tr>
    <td class="text-center font-weight-bold text-muted">{{ $no++ }}</td>
    <td class="text-center">
        <a href="{{ route('proses.detail', $item->id) }}" target="_blank" class="btn btn-sm btn-info btn-action-icon" title="Lihat Detail Proses">
            <i class="fas fa-eye"></i>
        </a>
    </td>
    <td>
        <a href="{{ route('keluhan.show', $item->id) }}" target="_blank" class="nomer-link text-nowrap" title="Buka Detail Keluhan">
            <i class="far fa-file-alt mr-1 text-primary"></i>{{ $item->nomer_keluhan }}
        </a>
    </td>
    <td class="text-center text-nowrap">{{ $item->tgl_keluhan ? \Carbon\Carbon::parse($item->tgl_keluhan)->format('d/m/Y') : '-' }}</td>
    <td class="text-center"><span class="badge badge-light border text-dark">{{ $item->jenis ?? '-' }}</span></td>
    <td class="text-center">
        @if ($item->kategori_keluhan == 'eksternal')
        <span class="badge badge-pill badge-primary"><i class="fas fa-external-link-alt mr-1"></i>Eksternal</span>
        @else
        <span class="badge badge-pill badge-secondary"><i class="fas fa-building mr-1"></i>Internal</span>
        @endif
    </td>
    <td class="font-weight-bold">{{ $item->buyer->nama_buyer ?? '-' }}</td>
    <td>{{ $item->nama_marketing ?? '-' }}</td>
    <td class="text-center text-nowrap">
        @if($item->status == 'open')
        <span class="text-muted font-italic small"><i class="fas fa-clock mr-1"></i>Belum Diproses</span>
        @else
        {{ $item->tgl_proses ? \Carbon\Carbon::parse($item->tgl_proses)->format('d/m/Y') : '-' }}
        @endif
    </td>
    <td class="text-center">
        @if($item->status == 'open')
        <span class="badge badge-status badge-warning text-dark"><i class="fas fa-hourglass-start"></i> Open</span>
        @elseif($item->status == 'proses')
        <span class="badge badge-status badge-primary"><i class="fas fa-sync-alt"></i> Proses</span>
        @elseif($item->status == 'selesai')
        <span class="badge badge-status badge-success"><i class="fas fa-check-circle"></i> Selesai</span>
        @elseif($item->status == 'va')
        <span class="badge badge-status badge-info"><i class="fas fa-shield-alt"></i> VA</span>
        @else
        <span class="badge badge-status badge-danger">{{ strtoupper($item->status) }}</span>
        @endif
    </td>
    <td class="text-center">
        @if($item->status_marketing == '0' || empty($item->status_marketing))
        <span class="badge badge-light border text-muted" title="Belum di-close Marketing">Tidak</span>
        @else
        <span class="badge badge-danger" title="Sudah di-close Marketing"><i class="fas fa-check mr-1"></i>Ya</span>
        @endif
    </td>
    <td>
        @if ($item->latestChatPersonal)
        <div style="line-height: 1.25;">
            <span class="font-weight-bold text-dark"><i class="fas fa-user-circle text-muted mr-1"></i>{{ $item->latestChatPersonal->users->name ?? 'User' }}</span>
            <br>
            <small class="text-muted"><i class="far fa-clock mr-1"></i>{{ $item->latestChatPersonal->created_at ? $item->latestChatPersonal->created_at->format('d/m/Y H:i') : '-' }}</small>
        </div>
        @else
        <span class="text-muted small">- Belum Ada -</span>
        @endif
    </td>
    @if (Auth::user()->posisi == 'qa' || Auth::user()->posisi == 'Admin')
    <td class="text-center">
        <div class="btn-group btn-group-sm">
            @if($item->status == 'open')
                <a href="{{ route('proses.index', $item->id) }}" class="btn btn-primary" title="Proses Keluhan"><i class="fas fa-play mr-1"></i> Proses</a>
                <a href="{{ route('keluhan.print', $item->id) }}" target="_blank" class="btn btn-outline-secondary" title="Cetak Keluhan"><i class="fas fa-print"></i></a>
            @elseif($item->status == 'proses')
                <a href="{{ route('proses.index', $item->id) }}" class="btn btn-warning font-weight-bold" title="Lanjutkan Proses"><i class="fas fa-arrow-right mr-1"></i> Lanjutkan</a>
            @elseif($item->status == 'selesai' || $item->status == 'va')
                <a href="{{ route('proses.index', $item->id) }}" class="btn btn-success" title="Lihat Solusi & Hasil"><i class="fas fa-check mr-1"></i> Lihat</a>
            @endif
        </div>
    </td>
    <td class="text-center">
        @if (!empty($item->hasil_scan))
        <button type="button" class="btn btn-sm btn-outline-info shadow-sm" onclick="showScanModal('{{ asset('image/scan/'.$item->hasil_scan) }}', '{{ $item->nomer_keluhan }}')">
            <i class="fas fa-file-image mr-1"></i> Lihat Scan
        </button>
        @else
        <span class="text-muted small">- Belum ada -</span>
        @endif
    </td>
    <td class="text-center"><span class="small font-weight-bold">{{ $item->cutting_point ?? '-' }}</span></td>
    <td>
        <div style="max-height: 70px; overflow-y: auto; font-size: 0.82rem; min-width: 150px; white-space: normal;">
            {!! $item->verifikasi_akhir ?? '<span class="text-muted">-</span>' !!}
        </div>
    </td>
    @endif
</tr>
@endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Single Global Modal for Preview Hasil Scan -->
<div class="modal fade" id="modalPreviewScan" tabindex="-1" role="dialog" aria-labelledby="modalPreviewScanTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0" style="border-radius: 14px;">
            <div class="modal-header bg-light py-2 px-3 border-bottom">
                <h6 class="modal-title font-weight-bold text-dark" id="modalPreviewScanTitle">
                    <i class="fas fa-file-image text-info mr-2"></i>Hasil Scan Penyelesaian
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center p-3" style="background-color: #1e1e1e;">
                <img id="previewScanImg" src="" alt="Hasil Scan" class="img-fluid rounded shadow" style="max-height: 75vh; object-fit: contain;">
            </div>
            <div class="modal-footer py-2 px-3 bg-light border-top d-flex justify-content-between">
                <a id="btnDownloadScan" href="" download target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-download mr-1"></i> Unduh Gambar
                </a>
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('tablejs')
<script>
    var dataTableInstance = null;

    function applyStatusFilter(status) {
        if (!dataTableInstance) return;

        // Status Internal column is index 9
        if (status === '') {
            dataTableInstance.column(9).search('').draw();
        } else {
            dataTableInstance.column(9).search(status, true, false).draw();
        }

        $('.stat-card').removeClass('active-filter');
        $('.filter-btn-group .btn').removeClass('active');

        if (status === '') {
            $('#card-all').addClass('active-filter');
            $('#btn-filter-all').addClass('active');
        } else if (status === 'open') {
            $('#card-open').addClass('active-filter');
            $('#btn-filter-open').addClass('active');
        } else if (status === 'proses') {
            $('#card-proses').addClass('active-filter');
            $('#btn-filter-proses').addClass('active');
        } else if (status === 'selesai') {
            $('#card-selesai').addClass('active-filter');
            $('#btn-filter-selesai').addClass('active');
        }
    }

    function showScanModal(imgUrl, nomerKeluhan) {
        $('#modalPreviewScanTitle').html('<i class="fas fa-file-image text-info mr-2"></i>Hasil Scan: <strong>' + nomerKeluhan + '</strong>');
        $('#previewScanImg').attr('src', imgUrl);
        $('#btnDownloadScan').attr('href', imgUrl);
        $('#modalPreviewScan').modal('show');
    }

    $(document).ready(function () {
        dataTableInstance = $("#t_barang").DataTable({
            "dom": "<'d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom dt-toolbar-custom'<'mb-2 mb-md-0 d-flex align-items-center'l><'mb-2 mb-md-0 d-flex justify-content-center'B><'mb-2 mb-md-0 d-flex align-items-center'f>>" +
                   "<'row'<'col-12 table-responsive'tr>>" +
                   "<'row mt-3 align-items-center'<'col-12 col-md-5 text-muted small'i><'col-12 col-md-7 d-flex justify-content-md-end'p>>",
            "deferRender": true,
            "autoWidth": false,
            "pageLength": 25,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
            "order": [[0, "asc"]],
            "columnDefs": [
                { "orderable": false, "targets": [1, 12, 13] }
            ],
            "language": {
                "search": "Cari Cepat:",
                "searchPlaceholder": "Ketik nomor, buyer, dll...",
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
    });
</script>
@endsection
