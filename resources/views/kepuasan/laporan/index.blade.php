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

/* Score Guide Legend Pills */
.score-legend-pill {
    display: inline-flex;
    align-items: center;
    background: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 20px;
    padding: 4px 12px;
    font-size: 0.8rem;
    margin: 2px 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
}
.score-badge {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.78rem;
    min-width: 38px;
    text-align: center;
    margin-right: 6px;
}

/* DataTables Controls & Flex Toolbar */
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

/* Table Grid & Typography Styling */
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
    padding: 9px 10px !important;
    color: #333333;
}
.table-modern.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fafbfc;
}
.table-modern.table-hover tbody tr:hover {
    background-color: #f0f4f9;
}

/* Nav Tabs Modern */
.nav-tabs-modern {
    border-bottom: 2px solid #e9ecef;
    gap: 6px;
}
.nav-tabs-modern .nav-link {
    border: 1px solid transparent;
    border-radius: 8px 8px 0 0;
    font-weight: 600;
    font-size: 0.88rem;
    color: #6c757d;
    padding: 10px 18px;
    transition: all 0.2s ease;
}
.nav-tabs-modern .nav-link:hover {
    color: #007bff;
    background-color: #f8f9fa;
}
.nav-tabs-modern .nav-link.active {
    color: #007bff;
    background-color: #ffffff;
    border-color: #dee2e6 #dee2e6 #ffffff;
    border-top: 3px solid #007bff;
}

.badge-status {
    padding: 4px 10px;
    font-size: 0.78rem;
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
.btn-action-icon {
    width: 30px;
    height: 30px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
}
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-7">
                <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.55rem;">
                    <i class="fas fa-chart-line text-primary mr-2"></i>Laporan Kepuasan Pelanggan
                </h1>
                <p class="text-muted small mb-0 mt-1">
                    Rekapitulasi lengkap hasil survei evaluasi mutu produk dan tingkat kepuasan pelanggan PT. Gajah Angkasa Perkasa
                </p>
            </div>
            <div class="col-12 col-md-5 text-md-right mt-3 mt-md-0">
                <ol class="breadcrumb bg-transparent p-0 mb-2 justify-content-md-end small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kepuasan.index') }}">Kepuasan Pelanggan</a></li>
                    <li class="breadcrumb-item active text-primary">Laporan</li>
                </ol>
                <div class="d-flex justify-content-md-end gap-2">
                    <a href="{{ route('kepuasan.index') }}" class="btn btn-outline-secondary btn-sm mr-2 shadow-sm" style="border-radius: 6px;">
                        <i class="fas fa-list mr-1"></i> Data Kepuasan
                    </a>
                    <a href="{{ route('kepuasan.create') }}" class="btn btn-primary btn-sm shadow-sm" style="border-radius: 6px;">
                        <i class="fas fa-plus mr-1"></i> Survei Baru
                    </a>
                </div>
            </div>
        </div>
        @include('components.alert')

        <!-- Stat KPI Cards -->
        <div class="row mb-3">
            <!-- Total Dokumen -->
            <div class="col-12 col-sm-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card stat-card shadow-sm h-100" style="border-left: 4px solid #007bff !important;">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.72rem; letter-spacing: 0.5px;">Total Lembar Survei</span>
                            <h3 class="mb-0 font-weight-bold text-dark mt-1">{{ number_format($totalSatisfaction ?? 0, 0, ',', '.') }}</h3>
                            <small class="text-muted"><i class="fas fa-file-alt text-primary mr-1"></i>Dokumen terdaftar</small>
                        </div>
                        <div class="stat-icon-wrapper bg-light text-primary">
                            <i class="fas fa-poll-h"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rata-rata Skor CSAT -->
            <div class="col-12 col-sm-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card stat-card shadow-sm h-100" style="border-left: 4px solid #28a745 !important;">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.72rem; letter-spacing: 0.5px;">Indeks Kepuasan (CSAT)</span>
                            <h3 class="mb-0 font-weight-bold text-success mt-1">{{ number_format($avgScore ?? 0, 2) }} <span style="font-size: 0.95rem; font-weight: normal;" class="text-muted">/ 100</span></h3>
                            <small class="font-weight-bold">
                                @if(($avgScore ?? 0) >= 80)
                                    <span class="text-success"><i class="fas fa-check-circle mr-1"></i>Kategori: Sangat Baik</span>
                                @elseif(($avgScore ?? 0) >= 60)
                                    <span class="text-primary"><i class="fas fa-info-circle mr-1"></i>Kategori: Baik</span>
                                @elseif(($avgScore ?? 0) >= 40)
                                    <span class="text-warning"><i class="fas fa-exclamation-triangle mr-1"></i>Kategori: Cukup</span>
                                @else
                                    <span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Kategori: Perlu Evaluasi</span>
                                @endif
                            </small>
                        </div>
                        <div class="stat-icon-wrapper bg-light text-success">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Closed / Terkunci -->
            <div class="col-12 col-sm-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card stat-card shadow-sm h-100" style="border-left: 4px solid #6c757d !important;">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.72rem; letter-spacing: 0.5px;">Survei Terkunci (Closed)</span>
                            <h3 class="mb-0 font-weight-bold text-secondary mt-1">{{ number_format($totalClosed ?? 0, 0, ',', '.') }}</h3>
                            <small class="text-muted"><i class="fas fa-lock text-muted mr-1"></i>Arsip resmi final</small>
                        </div>
                        <div class="stat-icon-wrapper bg-light text-secondary">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Aspek Ternilai -->
            <div class="col-12 col-sm-6 col-lg-3 mb-2 mb-lg-0">
                <div class="card stat-card shadow-sm h-100" style="border-left: 4px solid #17a2b8 !important;">
                    <div class="card-body p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.72rem; letter-spacing: 0.5px;">Total Item Aspek Ternilai</span>
                            <h3 class="mb-0 font-weight-bold text-info mt-1">{{ number_format($totalItems ?? 0, 0, ',', '.') }}</h3>
                            <small class="text-muted"><i class="fas fa-check-double text-info mr-1"></i>Data poin evaluasi</small>
                        </div>
                        <div class="stat-icon-wrapper bg-light text-info">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panduan Skor & Skala Evaluasi -->
        <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px; background: #fdfdfd;">
            <div class="card-body py-2 px-3 d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center mr-3 my-1">
                    <span class="small font-weight-bold text-muted mr-2"><i class="fas fa-info-circle text-primary mr-1"></i>Skala Penilaian:</span>
                </div>
                <div class="d-flex flex-wrap align-items-center my-1">
                    <div class="score-legend-pill">
                        <span class="score-badge bg-secondary text-white">0</span>
                        <span>N/A (Tidak Dinilai)</span>
                    </div>
                    <div class="score-legend-pill">
                        <span class="score-badge bg-danger text-white">20</span>
                        <span>Tidak Baik</span>
                    </div>
                    <div class="score-legend-pill">
                        <span class="score-badge bg-warning text-dark">40</span>
                        <span>Kurang Baik</span>
                    </div>
                    <div class="score-legend-pill">
                        <span class="score-badge bg-info text-white">60</span>
                        <span>Cukup Baik</span>
                    </div>
                    <div class="score-legend-pill">
                        <span class="score-badge bg-primary text-white">80</span>
                        <span>Baik</span>
                    </div>
                    <div class="score-legend-pill">
                        <span class="score-badge bg-success text-white">100</span>
                        <span>Baik Sekali</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Main Table Card with Tabs -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
                    
                    <!-- Card Header with Nav Tabs -->
                    <div class="card-header bg-white p-3 border-bottom">
                        <ul class="nav nav-tabs nav-tabs-modern card-header-tabs" id="laporanTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-aspek-link" data-toggle="tab" href="#tab-aspek" role="tab" aria-controls="tab-aspek" aria-selected="true">
                                    <i class="fas fa-th-list mr-1 text-primary"></i> Rincian per Aspek Penilaian ({{ number_format(count($coba), 0, ',', '.') }})
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-dokumen-link" data-toggle="tab" href="#tab-dokumen" role="tab" aria-controls="tab-dokumen" aria-selected="false">
                                    <i class="fas fa-file-invoice mr-1 text-success"></i> Ringkasan per Dokumen Buyer ({{ number_format(count($index), 0, ',', '.') }})
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body p-3">
                        <div class="tab-content" id="laporanTabsContent">
                            
                            <!-- TAB 1: Rincian per Aspek Penilaian -->
                            <div class="tab-pane fade show active" id="tab-aspek" role="tabpanel" aria-labelledby="tab-aspek-link">
                                <table id="t_laporan_aspek" class="table table-bordered table-striped table-hover table-modern w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 40px;">No</th>
                                            <th style="width: 70px;">Aksi</th>
                                            <th style="width: 130px;">Kode Penilaian</th>
                                            <th>Nama Buyer / Pelanggan</th>
                                            <th style="width: 100px;">Tanggal</th>
                                            <th>Aspek Evaluasi Penilaian</th>
                                            <th style="width: 90px;">Skor Nilai</th>
                                            <th style="width: 100px;">Rata-Rata Lembar</th>
                                            <th style="width: 95px;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $noAspek = 1; @endphp
                                        @forelse ($coba as $item)
                                        @php
                                            $sat = $item->satisfaction;
                                            $scoreVal = $item->score ?? 0;
                                        @endphp
                                        <tr>
                                            <td class="text-center font-weight-bold text-muted">{{ $noAspek++ }}</td>
                                            <td class="text-center">
                                                @if($sat)
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('kepuasan.vpenilaian', $sat->id) }}" target="_blank" class="btn btn-outline-info btn-action-icon" title="Buka Detail Lembar">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('kepuasan.cetak', $sat->id) }}" target="_blank" class="btn btn-outline-secondary btn-action-icon" title="Cetak Laporan">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                </div>
                                                @else
                                                <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($sat)
                                                <a href="{{ route('kepuasan.vpenilaian', $sat->id) }}" target="_blank" class="nomer-link text-nowrap">
                                                    <i class="far fa-file-alt mr-1 text-primary"></i>{{ $sat->kode_penilaian }}
                                                </a>
                                                @else
                                                <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="font-weight-bold text-dark">
                                                    <i class="fas fa-building text-muted mr-1"></i>{{ $sat?->buyer?->nama_buyer ?? ($sat?->nama_pelanggan ?? '-') }}
                                                </div>
                                                @if($sat?->nama_kontak)
                                                <small class="text-muted"><i class="fas fa-user-circle mr-1"></i>{{ $sat->nama_kontak }}</small>
                                                @endif
                                            </td>
                                            <td class="text-center text-nowrap">
                                                @if($sat?->tgl_penilaian)
                                                    <span class="font-weight-500 text-dark"><i class="far fa-calendar-alt text-muted mr-1"></i>{{ \Carbon\Carbon::parse($sat->tgl_penilaian)->format('d/m/Y') }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="font-weight-600 text-dark">
                                                    {{ $item->itemevaluation?->nama_penilaian ?? '-' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if($scoreVal == 100)
                                                    <span class="score-badge bg-success text-white shadow-sm" title="Baik Sekali (100)">100</span>
                                                @elseif($scoreVal == 80)
                                                    <span class="score-badge bg-primary text-white shadow-sm" title="Baik (80)">80</span>
                                                @elseif($scoreVal == 60)
                                                    <span class="score-badge bg-info text-white shadow-sm" title="Cukup Baik (60)">60</span>
                                                @elseif($scoreVal == 40)
                                                    <span class="score-badge bg-warning text-dark shadow-sm" title="Kurang Baik (40)">40</span>
                                                @elseif($scoreVal == 20)
                                                    <span class="score-badge bg-danger text-white shadow-sm" title="Tidak Baik (20)">20</span>
                                                @else
                                                    <span class="score-badge bg-secondary text-white" title="Tidak Dinilai (0)">0</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($sat?->r_nilai !== null && $sat?->r_nilai > 0)
                                                    <span class="badge badge-light border font-weight-bold text-dark" style="font-size: 0.82rem;">
                                                        <i class="fas fa-chart-bar text-primary mr-1"></i>{{ number_format($sat->r_nilai, 2) }}
                                                    </span>
                                                @else
                                                    <span class="text-muted small">0.00</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($sat?->status == 'closed')
                                                    <span class="badge-status badge-secondary text-white"><i class="fas fa-lock"></i> Closed</span>
                                                @elseif($sat?->status == 'Tersimpan')
                                                    <span class="badge-status badge-primary text-white"><i class="fas fa-save"></i> Tersimpan</span>
                                                @elseif($sat?->status == 'open')
                                                    <span class="badge-status badge-warning text-dark"><i class="fas fa-hourglass-start"></i> Open</span>
                                                @else
                                                    <span class="badge-status badge-light border">{{ ucfirst($sat?->status ?? '-') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4 text-muted">
                                                <i class="fas fa-inbox fa-3x text-muted mb-2 d-block"></i>
                                                Belum ada data evaluasi kepuasan pelanggan yang tersimpan.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- TAB 2: Ringkasan per Dokumen Buyer -->
                            <div class="tab-pane fade" id="tab-dokumen" role="tabpanel" aria-labelledby="tab-dokumen-link">
                                <table id="t_laporan_dokumen" class="table table-bordered table-striped table-hover table-modern w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 40px;">No</th>
                                            <th style="width: 80px;">Aksi</th>
                                            <th style="width: 140px;">Kode Penilaian</th>
                                            <th style="width: 110px;">Tanggal</th>
                                            <th>Nama Buyer / Pelanggan</th>
                                            <th style="width: 130px;">Kontak Person</th>
                                            <th style="width: 110px;">Skor Akhir (CSAT)</th>
                                            <th>Catatan Kesesuaian SNI</th>
                                            <th>Kritik & Saran</th>
                                            <th style="width: 95px;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $noDok = 1; @endphp
                                        @forelse ($index as $doc)
                                        <tr>
                                            <td class="text-center font-weight-bold text-muted">{{ $noDok++ }}</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('kepuasan.vpenilaian', $doc->id) }}" target="_blank" class="btn btn-outline-info btn-action-icon" title="Buka Detail Lembar">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('kepuasan.cetak', $doc->id) }}" target="_blank" class="btn btn-outline-secondary btn-action-icon" title="Cetak Laporan">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('kepuasan.vpenilaian', $doc->id) }}" target="_blank" class="nomer-link text-nowrap">
                                                    <i class="far fa-file-alt mr-1 text-primary"></i>{{ $doc->kode_penilaian }}
                                                </a>
                                            </td>
                                            <td class="text-center text-nowrap">
                                                @if($doc->tgl_penilaian)
                                                    <span class="font-weight-500 text-dark"><i class="far fa-calendar-alt text-muted mr-1"></i>{{ \Carbon\Carbon::parse($doc->tgl_penilaian)->format('d/m/Y') }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="font-weight-bold text-dark">
                                                    <i class="fas fa-building text-muted mr-1"></i>{{ $doc->buyer?->nama_buyer ?? ($doc->nama_pelanggan ?? '-') }}
                                                </div>
                                                @if($doc->alamat)
                                                <small class="text-muted text-truncate d-block" style="max-width: 220px;" title="{{ $doc->alamat }}">{{ $doc->alamat }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-dark small"><i class="fas fa-user-circle text-muted mr-1"></i>{{ $doc->nama_kontak ?? '-' }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($doc->r_nilai !== null && $doc->r_nilai > 0)
                                                    @if($doc->r_nilai >= 80)
                                                        <span class="badge badge-success px-2 py-1 font-weight-bold" style="font-size: 0.85rem;">
                                                            <i class="fas fa-star mr-1"></i>{{ number_format($doc->r_nilai, 2) }}
                                                        </span>
                                                    @elseif($doc->r_nilai >= 60)
                                                        <span class="badge badge-primary px-2 py-1 font-weight-bold" style="font-size: 0.85rem;">
                                                            <i class="fas fa-check mr-1"></i>{{ number_format($doc->r_nilai, 2) }}
                                                        </span>
                                                    @elseif($doc->r_nilai >= 40)
                                                        <span class="badge badge-warning text-dark px-2 py-1 font-weight-bold" style="font-size: 0.85rem;">
                                                            {{ number_format($doc->r_nilai, 2) }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger px-2 py-1 font-weight-bold" style="font-size: 0.85rem;">
                                                            {{ number_format($doc->r_nilai, 2) }}
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="text-muted small">0.00</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="small text-muted" style="max-height: 60px; overflow-y: auto; max-width: 250px;">
                                                    {!! $doc->desc_kesesuaian ?: '<span class="text-muted font-italic">- Belum diisi -</span>' !!}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="small text-muted" style="max-height: 60px; overflow-y: auto; max-width: 250px;">
                                                    {!! $doc->kritik_saran ?: '<span class="text-muted font-italic">- Belum ada saran -</span>' !!}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if($doc->status == 'closed')
                                                    <span class="badge-status badge-secondary text-white"><i class="fas fa-lock"></i> Closed</span>
                                                @elseif($doc->status == 'Tersimpan')
                                                    <span class="badge-status badge-primary text-white"><i class="fas fa-save"></i> Tersimpan</span>
                                                @elseif($doc->status == 'open')
                                                    <span class="badge-status badge-warning text-dark"><i class="fas fa-hourglass-start"></i> Open</span>
                                                @else
                                                    <span class="badge-status badge-light border">{{ ucfirst($doc->status ?? '-') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4 text-muted">
                                                <i class="fas fa-inbox fa-3x text-muted mb-2 d-block"></i>
                                                Belum ada lembar evaluasi kepuasan pelanggan.
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
        </div>
    </div>
</section>
@endsection

@section('tablejs')
<script>
    $(document).ready(function () {
        var commonLanguage = {
            "search": "Cari Cepat:",
            "searchPlaceholder": "Ketik nomor, buyer, aspek...",
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
        };

        var commonButtons = [
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
        ];

        var tableDom = "<'d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom dt-toolbar-custom'<'mb-2 mb-md-0 d-flex align-items-center'l><'mb-2 mb-md-0 d-flex justify-content-center'B><'mb-2 mb-md-0 d-flex align-items-center'f>>" +
                       "<'row'<'col-12 table-responsive'tr>>" +
                       "<'row mt-3 align-items-center'<'col-12 col-md-5 text-muted small'i><'col-12 col-md-7 d-flex justify-content-md-end'p>>";

        // DataTable Tab 1: Rincian Aspek
        var tableAspek = $("#t_laporan_aspek").DataTable({
            "dom": tableDom,
            "deferRender": true,
            "autoWidth": false,
            "pageLength": 25,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
            "order": [[0, "asc"]],
            "columnDefs": [
                { "orderable": false, "targets": [1] }
            ],
            "language": commonLanguage,
            "buttons": commonButtons
        });

        // DataTable Tab 2: Ringkasan Dokumen
        var tableDokumen = null;
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href");
            if (target === '#tab-dokumen' && !tableDokumen) {
                tableDokumen = $("#t_laporan_dokumen").DataTable({
                    "dom": tableDom,
                    "deferRender": true,
                    "autoWidth": false,
                    "pageLength": 25,
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
                    "order": [[0, "asc"]],
                    "columnDefs": [
                        { "orderable": false, "targets": [1, 7, 8] }
                    ],
                    "language": commonLanguage,
                    "buttons": commonButtons
                });
            } else if (tableDokumen) {
                tableDokumen.columns.adjust().draw();
            }
            if (target === '#tab-aspek' && tableAspek) {
                tableAspek.columns.adjust().draw();
            }
        });
    });
</script>
@endsection
