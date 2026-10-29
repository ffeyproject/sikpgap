@extends('layouts.app')

@push('page_css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
/* Modern Card & Shadow Styling */
.card-modern {
    border-radius: 12px;
    border: 1px solid #e3e6f0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    background-color: #ffffff;
    transition: all 0.2s ease;
}

/* Button Click & Submit Animations */
@keyframes btnGlow {
    0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
    70% { box-shadow: 0 0 0 12px rgba(40, 167, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
}
.btn-submitting {
    animation: btnGlow 1.4s infinite !important;
    pointer-events: none !important;
    opacity: 0.9 !important;
}
.btn-press-anim {
    transition: transform 0.12s ease, box-shadow 0.15s ease;
}
.btn-press-anim:active {
    transform: scale(0.96);
}

/* Status Badges */
.badge-status-lg {
    padding: 6px 14px;
    font-size: 0.85rem;
    font-weight: 600;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

/* Info Grid */
.info-label {
    font-size: 0.78rem;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: #8898aa;
    margin-bottom: 2px;
}
.info-value {
    font-size: 0.95rem;
    font-weight: 600;
    color: #2d3748;
}

/* Score Guide Legend Pills */
.score-legend-pill {
    display: inline-flex;
    align-items: center;
    background: #f8f9fa;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 4px 12px;
    font-size: 0.8rem;
    margin: 2px 4px;
}
.score-badge {
    display: inline-block;
    width: 26px;
    height: 26px;
    line-height: 26px;
    text-align: center;
    border-radius: 50%;
    font-weight: 700;
    color: #fff;
    margin-right: 6px;
    font-size: 0.75rem;
}

/* Penilaian Table Styling */
.table-penilaian {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #dcdfe4 !important;
}
.table-penilaian th,
.table-penilaian td {
    border: 1px solid #dcdfe4 !important;
}
.table-penilaian thead th {
    background-color: #f4f6f9 !important;
    color: #343a40 !important;
    font-weight: 700 !important;
    font-size: 0.84rem !important;
    border-bottom: 2px solid #b8bfc7 !important;
    vertical-align: middle !important;
}
.table-penilaian tbody td {
    vertical-align: middle !important;
    font-size: 0.88rem;
}
.cell-score {
    text-align: center;
    transition: background-color 0.15s ease;
    user-select: none;
    -webkit-user-select: none;
}
.cell-score:hover {
    background-color: #eaf3ff !important;
}
.cell-score.active-score {
    background-color: #d4edda !important;
    box-shadow: inset 0 0 0 2px #28a745;
}
.score-checkbox {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: #28a745;
    margin: 0 !important;
    vertical-align: middle;
}
.row-scored {
    background-color: #fafffa !important;
}
.row-missing {
    background-color: #fff8e6 !important;
    border-left: 4px solid #ffc107 !important;
}

/* KPI Score Display */
.kpi-score-card {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: #ffffff;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
}
</style>
@endpush

@section('content')
@php
    $detailKeyed = $detail->keyBy('item_evaluations_id');
    $isEditOpen = ($kepuasan->status == 'open') || request('edit') == '1';
@endphp

<!-- Page Header & Breadcrumbs -->
<section class="content-header pt-3 pb-2">
    <div class="container-fluid">
        <div class="mb-3 row align-items-center">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold text-dark">
                    <i class="fas fa-tasks text-primary mr-2"></i>Penilaian Kepuasan Pelanggan
                </h1>
                <p class="text-muted small mb-0 mt-1">
                    Formulir evaluasi kepuasan pembeli terhadap mutu pelayanan dan produk PT. GAP
                </p>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right bg-transparent p-0 mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kepuasan.index') }}">Kepuasan Pelanggan</a></li>
                    <li class="breadcrumb-item active">{{ $kepuasan->kode_penilaian }}</li>
                </ol>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('kepuasan.index') }}" class="btn btn-sm btn-outline-secondary mr-2" style="border-radius: 6px;">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                    </a>
                    @if($kepuasan->status == 'closed')
                    <a href="{{ route('kepuasan.cetak', $kepuasan->id) }}" target="_blank" class="btn btn-sm btn-info" style="border-radius: 6px;">
                        <i class="fas fa-print mr-1"></i> Cetak Dokumen
                    </a>
                    @endif
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

        <!-- Status Action Banner -->
        @if($kepuasan->status == 'Tersimpan')
        <div class="alert alert-warning border-0 shadow-sm mb-3 d-flex align-items-center justify-content-between p-3" style="border-radius: 10px;">
            <div class="d-flex align-items-center">
                <div class="mr-3" style="font-size: 1.8rem; color: #856404;">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div>
                    <h6 class="font-weight-bold mb-1" style="color: #856404;">Data Skor Telah Tersimpan</h6>
                    <p class="small mb-0 text-muted">Anda dapat mengubah nilai penilaian kapan saja dengan menekan tombol <strong>"Ubah Nilai Penilaian"</strong> di bawah, atau klik <strong>"Kunci Nilai (Closed)"</strong> untuk menyelesaikan.</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-dark font-weight-bold px-3 py-2 mr-2 btn-toggle-edit-form" style="border-radius: 6px;">
                    <i class="fas fa-edit mr-1"></i> Ubah Nilai Penilaian
                </button>
                <form method="post" action="{{ route('kepuasan.rnilai', $kepuasan->id) }}" id="formFinalScore" class="m-0 d-inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="r_nilai" value="{{ round($detail->avg('score'), 2) }}">
                    <button type="submit" class="btn btn-success font-weight-bold px-3 py-2 shadow-sm btn-press-anim" id="btnFinalScore" style="border-radius: 6px;">
                        <i class="fas fa-lock mr-1"></i> Kunci Nilai (Closed)
                    </button>
                </form>
            </div>
        </div>
        @elseif($kepuasan->status == 'closed')
        <div class="alert alert-secondary border-0 shadow-sm mb-3 d-flex align-items-center justify-content-between p-3" style="border-radius: 10px; background-color: #f1f3f5;">
            <div class="d-flex align-items-center">
                <div class="mr-3 text-secondary" style="font-size: 1.8rem;">
                    <i class="fas fa-lock text-muted"></i>
                </div>
                <div>
                    <h6 class="font-weight-bold mb-1 text-dark">Data Penilaian Telah Ditutup (Closed)</h6>
                    <p class="small mb-0 text-muted">Penilaian ini telah selesai dievaluasi dan dikunci permanen. Nilai tidak dapat diubah lagi.</p>
                </div>
            </div>
            <a href="{{ route('kepuasan.cetak', $kepuasan->id) }}" target="_blank" class="btn btn-outline-primary font-weight-bold px-3 py-2" style="border-radius: 6px;">
                <i class="fas fa-print mr-1"></i> Cetak Laporan
            </a>
        </div>
        @endif

        <!-- Card Info Pelanggan & QR Code -->
        <div class="card card-modern mb-3">
            <div class="card-header bg-white py-3 px-3 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-id-card text-primary mr-2"></i>Informasi Penilaian & Buyer
                    </h5>
                    <small class="text-muted">Data pembeli dan identitas lembar evaluasi kepuasan</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    @if($kepuasan->status == 'open')
                        <span class="badge-status-lg bg-warning text-dark"><i class="fas fa-hourglass-start"></i> Status: Open</span>
                    @elseif($kepuasan->status == 'Tersimpan')
                        <span class="badge-status-lg bg-primary text-white"><i class="fas fa-save"></i> Status: Tersimpan</span>
                    @elseif($kepuasan->status == 'closed')
                        <span class="badge-status-lg bg-secondary text-white"><i class="fas fa-lock"></i> Status: Closed</span>
                    @else
                        <span class="badge-status-lg bg-light border">{{ ucfirst($kepuasan->status) }}</span>
                    @endif

                    @if($kepuasan->status != 'closed')
                    <button type="button" class="btn btn-sm btn-outline-warning ml-2 font-weight-bold" data-toggle="modal" data-target="#modalEditInfo" style="border-radius: 6px;">
                        <i class="fas fa-user-edit mr-1"></i> Ubah Data Buyer
                    </button>
                    @endif
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-12 col-md-8 col-lg-9">
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="info-label"><i class="fas fa-hashtag mr-1"></i>Nomor Penilaian</div>
                                <div class="info-value text-primary font-weight-bold">{{ $kepuasan->kode_penilaian }}</div>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="info-label"><i class="far fa-calendar-alt mr-1"></i>Tanggal Penilaian</div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($kepuasan->tgl_penilaian)->format('d F Y') }}</div>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="info-label"><i class="far fa-building mr-1"></i>Nama Buyer / Perusahaan</div>
                                <div class="info-value font-weight-bold text-dark">{{ $kepuasan->buyer ? $kepuasan->buyer->nama_buyer : '-' }}</div>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="info-label"><i class="far fa-user mr-1"></i>Nama Kontak (PIC)</div>
                                <div class="info-value">{{ $kepuasan->nama_kontak ?? '-' }}</div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="info-label"><i class="fas fa-map-marker-alt mr-1"></i>Alamat Lengkap Buyer</div>
                                <div class="info-value text-muted font-weight-normal">{{ $kepuasan->alamat ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 text-center border-left border-light py-2">
                        <div class="p-2 d-inline-block bg-white rounded shadow-sm border mb-2">
                            {!! DNS2D::getBarcodeHTML($kepuasan->kode_penilaian . ' ' . ($kepuasan->buyer->nama_buyer ?? ''), 'QRCODE', 4, 4) !!}
                        </div>
                        <div class="small text-muted font-weight-bold">QR Validasi Dokumen</div>
                    </div>
                </div>
            </div>
        </div>

        @if($kepuasan->status != 'open')
        <!-- TAMPILAN RINGKASAN HASIL EVALUASI (Jika sudah disimpan atau closed) -->
        <div id="summaryViewSection" class="row {{ $isEditOpen ? 'd-none' : '' }}">
            <!-- Kolom Tabel Rincian Nilai -->
            <div class="col-12 col-lg-8 mb-4">
                <div class="card card-modern shadow-sm border-0 h-100" style="border-radius: 12px; overflow: hidden;">
                    <div class="card-header bg-white py-3 px-3 border-bottom d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="m-0 font-weight-bold text-dark">
                                <i class="fas fa-poll text-primary mr-2"></i>Rincian Nilai Hasil Evaluasi
                            </h5>
                            <small class="text-muted">Hasil penilaian untuk {{ $detail->count() }} aspek</small>
                        </div>
                        @if($kepuasan->status == 'Tersimpan')
                        <div>
                            <button type="button" class="btn btn-sm btn-warning font-weight-bold btn-toggle-edit-form" style="border-radius: 6px;">
                                <i class="fas fa-edit mr-1"></i> Ubah / Edit Nilai
                            </button>
                        </div>
                        @endif
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover mb-0" style="border-collapse: collapse;">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th style="text-align: left;">Item Penilaian</th>
                                        <th style="width: 100px;">Skor</th>
                                        <th style="width: 130px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail as $index => $row)
                                    <tr>
                                        <td class="text-center font-weight-bold text-muted">{{ $index + 1 }}</td>
                                        <td>{{ $row->itemevaluation->nama_penilaian ?? '-' }}</td>
                                        <td class="text-center font-weight-bold">
                                            @if($row->score >= 80)
                                                <span class="badge badge-success px-2 py-1" style="font-size: 0.85rem;">{{ $row->score }}</span>
                                            @elseif($row->score >= 60)
                                                <span class="badge badge-info px-2 py-1" style="font-size: 0.85rem;">{{ $row->score }}</span>
                                            @elseif($row->score >= 40)
                                                <span class="badge badge-warning text-dark px-2 py-1" style="font-size: 0.85rem;">{{ $row->score }}</span>
                                            @else
                                                <span class="badge badge-danger px-2 py-1" style="font-size: 0.85rem;">{{ $row->score }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center small font-weight-500">
                                            @if($row->score == 100) Baik Sekali
                                            @elseif($row->score == 80) Baik
                                            @elseif($row->score == 60) Cukup Baik
                                            @elseif($row->score == 40) Kurang Baik
                                            @elseif($row->score == 20) Tidak Baik
                                            @else Tidak Ada Penilaian
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Ringkasan Skor & Ulasan -->
            <div class="col-12 col-lg-4 mb-4">
                <!-- KPI Skor Rata-rata -->
                <div class="card card-modern shadow-sm border-0 mb-3" style="border-radius: 12px; overflow: hidden;">
                    <div class="card-body p-4 text-center">
                        <span class="text-uppercase text-muted font-weight-bold small">Indeks Kepuasan Rata-rata</span>
                        <div class="my-3">
                            <span class="display-3 font-weight-bold text-primary">{{ round($detail->avg('score'), 1) }}</span>
                            <span class="text-muted" style="font-size: 1.2rem;">/ 100</span>
                        </div>
                        <div>
                            @php $avgScore = round($detail->avg('score'), 1); @endphp
                            @if($avgScore >= 80)
                                <span class="badge-status-lg bg-success text-white"><i class="fas fa-smile"></i> Sangat Memuaskan</span>
                            @elseif($avgScore >= 60)
                                <span class="badge-status-lg bg-info text-white"><i class="fas fa-meh"></i> Cukup Memuaskan</span>
                            @elseif($avgScore >= 40)
                                <span class="badge-status-lg bg-warning text-dark"><i class="fas fa-frown"></i> Kurang Memuaskan</span>
                            @else
                                <span class="badge-status-lg bg-danger text-white"><i class="fas fa-times-circle"></i> Tidak Memuaskan</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Callout Kesesuaian SNI -->
                <div class="card card-modern shadow-sm border-0 mb-3" style="border-radius: 12px;">
                    <div class="card-header bg-white py-2 px-3 border-bottom font-weight-bold text-dark">
                        <i class="fas fa-certificate text-warning mr-2"></i>Kesesuaian SNI 56-2017
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small">
                            {!! $kepuasan->desc_kesesuaian ?? '<em>Tidak ada catatan kesesuaian.</em>' !!}
                        </div>
                    </div>
                </div>

                <!-- Callout Kritik & Saran -->
                <div class="card card-modern shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-header bg-white py-2 px-3 border-bottom font-weight-bold text-dark">
                        <i class="fas fa-comment-dots text-info mr-2"></i>Kritik & Saran
                    </div>
                    <div class="card-body p-3">
                        <div class="text-muted small">
                            {!! $kepuasan->kritik_saran ?? '<em>Tidak ada kritik dan saran.</em>' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($kepuasan->status != 'closed')
        <!-- FORM INPUT & EDIT NILAI PENILAIAN -->
        <div id="formSectionContainer" class="{{ ($kepuasan->status != 'open' && !$isEditOpen) ? 'd-none' : '' }}">
            <!-- Section Petunjuk Pengisian Skor -->
            <div class="card card-modern mb-3">
                <div class="card-header bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between" style="cursor: pointer;" data-toggle="collapse" data-target="#petunjukCollapse">
                    <h6 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-info-circle text-primary mr-2"></i>Panduan Skala Penilaian Kepuasan
                    </h6>
                    <button type="button" class="btn btn-sm btn-link text-muted p-0">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div id="petunjukCollapse" class="collapse show">
                    <div class="card-body p-3 bg-light">
                        <div class="d-flex flex-wrap align-items-center justify-content-center">
                            <div class="score-legend-pill">
                                <span class="score-badge bg-secondary">0</span>
                                <span>Tidak Ada Penilaian</span>
                            </div>
                            <div class="score-legend-pill">
                                <span class="score-badge bg-danger">20</span>
                                <span>Tidak Baik</span>
                            </div>
                            <div class="score-legend-pill">
                                <span class="score-badge bg-warning text-dark">40</span>
                                <span>Kurang Baik</span>
                            </div>
                            <div class="score-legend-pill">
                                <span class="score-badge bg-info">60</span>
                                <span>Cukup Baik</span>
                            </div>
                            <div class="score-legend-pill">
                                <span class="score-badge bg-primary">80</span>
                                <span>Baik</span>
                            </div>
                            <div class="score-legend-pill">
                                <span class="score-badge bg-success">100</span>
                                <span>Baik Sekali</span>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <small class="text-muted font-italic">
                                <i class="fas fa-hand-pointer mr-1"></i>
                                <strong>Petunjuk:</strong> Klik langsung pada kolom angka untuk memilih skor. <strong>Hanya 1 nilai</strong> yang dapat dipilih untuk setiap item pertanyaan.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Penilaian -->
            <div class="card card-modern shadow-sm border-0 mb-4" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-white py-3 px-3 border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="m-0 font-weight-bold text-dark">
                            <i class="fas fa-edit text-warning mr-2"></i>{{ $kepuasan->status == 'open' ? 'Tabel Kuisioner Evaluasi Kepuasan' : 'Form Ubah / Update Nilai Penilaian' }}
                        </h5>
                        <small class="text-muted">Pilih 1 skor untuk setiap aspek penilaian di bawah</small>
                    </div>
                    @if($kepuasan->status != 'open')
                    <button type="button" class="btn btn-sm btn-outline-secondary font-weight-bold btn-toggle-edit-form" style="border-radius: 6px;">
                        <i class="fas fa-times mr-1"></i> Batal Ubah
                    </button>
                    @endif
                </div>

                <form id="form-penilaian" method="POST" action="{{ route('kepuasan-penilaian.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="satisfactions_id" value="{{ $kepuasan->id }}">

                    <div class="table-responsive">
                        <table id="table-penilaian" class="table table-bordered table-penilaian mb-0">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 45px;">No</th>
                                    <th style="text-align: left;">Item Aspek Penilaian</th>
                                    <th style="width: 80px;" title="Skor 0: Tidak Ada Penilaian">0<br><span class="font-weight-normal text-muted" style="font-size: 0.72rem;">N/A</span></th>
                                    <th style="width: 80px;" title="Skor 20: Tidak Baik">20<br><span class="font-weight-normal text-muted" style="font-size: 0.72rem;">Buruk</span></th>
                                    <th style="width: 80px;" title="Skor 40: Kurang Baik">40<br><span class="font-weight-normal text-muted" style="font-size: 0.72rem;">Kurang</span></th>
                                    <th style="width: 80px;" title="Skor 60: Cukup Baik">60<br><span class="font-weight-normal text-muted" style="font-size: 0.72rem;">Cukup</span></th>
                                    <th style="width: 80px;" title="Skor 80: Baik">80<br><span class="font-weight-normal text-muted" style="font-size: 0.72rem;">Baik</span></th>
                                    <th style="width: 80px;" title="Skor 100: Baik Sekali">100<br><span class="font-weight-normal text-muted" style="font-size: 0.72rem;">Sangat Baik</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item as $index => $row)
                                @php
                                    $savedScore = $detailKeyed->get($row->id)?->score;
                                @endphp
                                <tr class="item-row {{ $savedScore !== null ? 'row-scored' : '' }}" data-index="{{ $index }}" data-row-num="{{ $index + 1 }}">
                                    <td class="text-center font-weight-bold text-muted">{{ $index + 1 }}</td>
                                    <td>
                                        <input type="hidden" name="item_evaluations_id[]" value="{{ $row->id }}">
                                        <span class="font-weight-600 text-dark">{{ $row->nama_penilaian }}</span>
                                    </td>
                                    <td class="cell-score {{ $savedScore !== null && $savedScore == 0 ? 'active-score' : '' }}" style="cursor: pointer;" title="Pilih Skor 0 (Tidak Ada Penilaian)">
                                        <input type="checkbox" name="score[]" class="score-checkbox" value="0" {{ $savedScore !== null && $savedScore == 0 ? 'checked' : '' }}>
                                    </td>
                                    <td class="cell-score {{ $savedScore == 20 ? 'active-score' : '' }}" style="cursor: pointer;" title="Pilih Skor 20 (Tidak Baik)">
                                        <input type="checkbox" name="score[]" class="score-checkbox" value="20" {{ $savedScore == 20 ? 'checked' : '' }}>
                                    </td>
                                    <td class="cell-score {{ $savedScore == 40 ? 'active-score' : '' }}" style="cursor: pointer;" title="Pilih Skor 40 (Kurang Baik)">
                                        <input type="checkbox" name="score[]" class="score-checkbox" value="40" {{ $savedScore == 40 ? 'checked' : '' }}>
                                    </td>
                                    <td class="cell-score {{ $savedScore == 60 ? 'active-score' : '' }}" style="cursor: pointer;" title="Pilih Skor 60 (Cukup Baik)">
                                        <input type="checkbox" name="score[]" class="score-checkbox" value="60" {{ $savedScore == 60 ? 'checked' : '' }}>
                                    </td>
                                    <td class="cell-score {{ $savedScore == 80 ? 'active-score' : '' }}" style="cursor: pointer;" title="Pilih Skor 80 (Baik)">
                                        <input type="checkbox" name="score[]" class="score-checkbox" value="80" {{ $savedScore == 80 ? 'checked' : '' }}>
                                    </td>
                                    <td class="cell-score {{ $savedScore == 100 ? 'active-score' : '' }}" style="cursor: pointer;" title="Pilih Skor 100 (Baik Sekali)">
                                        <input type="checkbox" name="score[]" class="score-checkbox" value="100" {{ $savedScore == 100 ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Bagian Form Kesesuaian & Saran -->
                    <div class="card-body p-4 bg-light border-top">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="summernote" class="font-weight-bold text-dark">
                                    <i class="fas fa-certificate text-warning mr-1"></i>
                                    Kesesuaian Produk Terhadap Persyaratan Sertifikasi SNI 56-2017:
                                </label>
                                <p class="small text-muted mb-2">Kain tenun untuk stelan (Suiting) merek Mafela dan Gaia</p>
                                <textarea class="form-control @error('desc_kesesuaian') is-invalid @enderror"
                                    name="desc_kesesuaian" id="summernote">{{ old('desc_kesesuaian', $kepuasan->desc_kesesuaian) }}</textarea>
                                @error('desc_kesesuaian')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label for="kritiksaran" class="font-weight-bold text-dark">
                                    <i class="fas fa-comment-dots text-info mr-1"></i>
                                    Kritik, Masukan, dan Saran dari Pembeli:
                                </label>
                                <textarea class="form-control @error('kritik_saran') is-invalid @enderror"
                                    name="kritik_saran" id="kritiksaran">{{ old('kritik_saran', $kepuasan->kritik_saran) }}</textarea>
                                @error('kritik_saran')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="alert alert-info border-0 p-3 mt-2 d-flex align-items-center" style="border-radius: 8px;">
                            <i class="fas fa-info-circle fa-2x mr-3 text-info"></i>
                            <div>
                                <strong>Info Update:</strong> Anda dapat mengubah nilai dan catatan kapan saja. Sistem akan secara otomatis mengupdate rincian nilai dan menghitung ulang skor rata-rata pelanggan.
                            </div>
                        </div>

                        <div class="text-right mt-3">
                            @if($kepuasan->status != 'open')
                            <button type="button" class="btn btn-secondary px-4 mr-2 btn-toggle-edit-form" style="border-radius: 6px;">
                                Batal
                            </button>
                            @else
                            <a href="{{ route('kepuasan.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 6px;">
                                Batal
                            </a>
                            @endif
                            <button type="submit" class="btn btn-success btn-lg px-4 font-weight-bold shadow-sm btn-press-anim" id="ajaxSubmit" style="border-radius: 6px;">
                                <i class="fas fa-save mr-1"></i> {{ $kepuasan->status == 'open' ? 'Simpan Penilaian' : 'Update & Simpan Nilai' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif

    </div>
</section>

@if($kepuasan->status != 'closed')
<!-- Modal Ubah Data Buyer -->
<div class="modal fade" id="modalEditInfo" tabindex="-1" role="dialog" aria-labelledby="modalEditInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <form method="POST" action="{{ route('kepuasan.update', $kepuasan->id) }}">
                @csrf
                @method('PATCH')
                <div class="modal-header bg-light py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="modal-title font-weight-bold text-dark" id="modalEditInfoLabel">
                        <i class="fas fa-edit text-warning mr-2"></i>Ubah Informasi Buyer & Penilaian
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="form-group mb-3">
                        <label for="buyers_id" class="font-weight-bold text-dark">Nama Buyer</label>
                        <select name="buyers_id" id="buyers_id" class="form-control select2" style="width: 100%;">
                            <option value="{{ $kepuasan->buyer->id }}">{{ $kepuasan->buyer->nama_buyer }}</option>
                            @foreach($buyer as $ll)
                                @if($ll->id != $kepuasan->buyer->id)
                                    <option value="{{ $ll->id }}">{{ $ll->nama_buyer }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="nama_kontak" class="font-weight-bold text-dark">Nama Kontak PIC</label>
                            <input type="text" name="nama_kontak" class="form-control" id="nama_kontak" value="{{ $kepuasan->nama_kontak }}">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="tgl_penilaian" class="font-weight-bold text-dark">Tanggal Penilaian</label>
                            <input type="date" name="tgl_penilaian" class="form-control" id="tgl_penilaian" value="{{ $kepuasan->tgl_penilaian }}">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat" class="font-weight-bold text-dark">Alamat Buyer</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="2">{{ $kepuasan->alamat }}</textarea>
                    </div>

                    <input type="hidden" name="desc_kesesuaian" value="{{ $kepuasan->desc_kesesuaian }}">
                    <input type="hidden" name="kritik_saran" value="{{ $kepuasan->kritik_saran }}">
                    <input type="hidden" name="status" value="{{ $kepuasan->status }}">
                </div>
                <div class="modal-footer bg-light py-2 px-3 border-top d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                    <button type="submit" class="btn btn-warning font-weight-bold" style="border-radius: 6px;">
                        <i class="fas fa-check mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('tablejs')
<script>
    $(document).ready(function(){
        // Initialize Select2 in modal
        $('#buyers_id').select2({
            dropdownParent: $('#modalEditInfo'),
            placeholder: 'Pilih Buyer',
            width: '100%'
        });

        // Toggle edit form vs summary view
        $('.btn-toggle-edit-form').on('click', function () {
            var $summary = $('#summaryViewSection');
            var $form = $('#formSectionContainer');

            if ($form.hasClass('d-none')) {
                $summary.addClass('d-none');
                $form.removeClass('d-none');
                $('html, body').animate({
                    scrollTop: $form.offset().top - 90
                }, 400);
            } else {
                $form.addClass('d-none');
                $summary.removeClass('d-none');
                $('html, body').animate({
                    scrollTop: $summary.offset().top - 90
                }, 400);
            }
        });

        // 1. Single selection per row: When any score-checkbox changes
        $('.score-checkbox').on('change', function () {
            var $row = $(this).closest('tr');
            var $cell = $(this).closest('.cell-score');

            if ($(this).is(':checked')) {
                // Uncheck all other checkboxes in this same row
                $row.find('.score-checkbox').not(this).prop('checked', false);
                $row.find('.cell-score').removeClass('active-score');
                $cell.addClass('active-score');
                $row.removeClass('row-missing').addClass('row-scored');
            } else {
                $cell.removeClass('active-score');
                if ($row.find('.score-checkbox:checked').length === 0) {
                    $row.removeClass('row-scored');
                }
            }
        });

        // 2. Click on table cell to select the checkbox
        $('.cell-score').on('click', function (e) {
            if (e.target.type !== 'checkbox') {
                var $checkbox = $(this).find('.score-checkbox');
                var isChecked = $checkbox.is(':checked');
                var $row = $(this).closest('tr');

                // If already checked, unchecking it
                if (isChecked) {
                    $checkbox.prop('checked', false).trigger('change');
                } else {
                    // Check this one and uncheck others in this row
                    $row.find('.score-checkbox').not($checkbox).prop('checked', false);
                    $checkbox.prop('checked', true).trigger('change');
                }
            }
        });

        // 3. Form validation before submit & animated loading state
        $('#form-penilaian').on('submit', function (e) {
            var missingRows = [];

            $('#table-penilaian tbody tr.item-row').each(function () {
                var rowNum = $(this).data('row-num');
                var checkedCount = $(this).find('.score-checkbox:checked').length;
                if (checkedCount === 0) {
                    missingRows.push(rowNum);
                    $(this).addClass('row-missing');
                }
            });

            if (missingRows.length > 0) {
                e.preventDefault();
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Penilaian Belum Lengkap!',
                        html: '<p class="mb-2">Setiap aspek pertanyaan wajib dipilih 1 nilai skor.</p><div class="p-2 bg-light rounded text-danger font-weight-bold">Item yang belum diisi: No. ' + missingRows.join(', ') + '</div>',
                        confirmButtonColor: '#007bff',
                        confirmButtonText: '<i class="fas fa-check mr-1"></i> Baik, Saya Lengkapi'
                    });
                } else {
                    alert('Perhatian: Setiap item penilaian wajib dipilih 1 nilai!\n\nItem yang belum diisi nilainya: No. ' + missingRows.join(', '));
                }
                
                // Scroll to the first missing item smoothly
                var firstMissing = $('#table-penilaian tbody tr.item-row.row-missing').first();
                if (firstMissing.length) {
                    $('html, body').animate({
                        scrollTop: firstMissing.offset().top - 140
                    }, 400);
                }
                return false;
            }

            // Trigger submit animation on button
            var $btn = $('#ajaxSubmit');
            $btn.addClass('btn-submitting').prop('disabled', true);
            $btn.html('<i class="fas fa-circle-notch fa-spin mr-2"></i> Menyimpan Penilaian...');
        });

        // 4. Animated confirmation modal & button loading for "Kunci Nilai (Closed)"
        $('#formFinalScore').on('submit', function (e) {
            e.preventDefault();
            var form = this;
            var $btn = $(form).find('button[type="submit"]');

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Kunci Nilai Penilaian?',
                    text: 'Setelah dikunci (Closed), data penilaian dan pembeli tidak dapat diubah lagi.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-lock mr-1"></i> Ya, Kunci Sekarang!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    focusCancel: true
                }).then(function (result) {
                    if (result.isConfirmed) {
                        $btn.addClass('btn-submitting').prop('disabled', true);
                        $btn.html('<i class="fas fa-circle-notch fa-spin mr-2"></i> Mengunci Nilai...');
                        form.submit();
                    }
                });
            } else {
                if (confirm('Kunci Nilai Penilaian? Setelah dikunci (Closed), data tidak dapat diubah lagi.')) {
                    $btn.addClass('btn-submitting').prop('disabled', true);
                    $btn.html('<i class="fas fa-circle-notch fa-spin mr-2"></i> Mengunci Nilai...');
                    form.submit();
                }
            }
        });

        // Initialize Summernote editors
        if ($('#summernote').length) {
            $('#summernote').summernote({
                height: 120,
                placeholder: 'Tuliskan catatan kesesuaian produk terhadap SNI 56-2017...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']]
                ]
            });
        }

        if ($('#kritiksaran').length) {
            $('#kritiksaran').summernote({
                height: 120,
                placeholder: 'Tuliskan kritik dan saran dari pelanggan...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']]
                ]
            });
        }
    });
</script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
@endsection
