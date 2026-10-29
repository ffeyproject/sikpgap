@extends('layouts.app')

@push('page_css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
/* Modern Form & Card Styling */
.card-modern {
    border-radius: 14px;
    border: 1px solid #e3e8ee;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    background-color: #ffffff;
    overflow: hidden;
}

.form-section-header {
    font-size: 0.95rem;
    font-weight: 700;
    color: #3b5998;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 16px;
    padding-bottom: 8px;
    border-bottom: 2px solid #eaecf4;
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-label-custom {
    font-weight: 600;
    color: #374151;
    font-size: 0.88rem;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.form-control-modern {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 9px 12px;
    font-size: 0.9rem;
    transition: all 0.2s ease-in-out;
}

.form-control-modern:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
}

.input-group-text-modern {
    background-color: #f9fafb;
    border: 1px solid #d1d5db;
    border-radius: 8px 0 0 8px;
    color: #6b7280;
}

/* Radio Card Selector for Jenis */
.jenis-card-option {
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    padding: 14px 16px;
    cursor: pointer;
    transition: all 0.22s ease-in-out;
    background-color: #ffffff;
    display: flex;
    align-items: center;
    position: relative;
    height: 100%;
}

.jenis-card-option:hover {
    border-color: #4f46e5;
    background-color: #f8faff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.08);
}

.jenis-card-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.jenis-card-option.active {
    border-color: #4f46e5;
    background-color: #eef2ff;
    box-shadow: 0 0 0 1px #4f46e5;
}

.jenis-icon-box {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    margin-right: 14px;
    flex-shrink: 0;
}

.jenis-icon-dyeing {
    background-color: #e0f2fe;
    color: #0284c7;
}

.jenis-icon-printing {
    background-color: #fef3c7;
    color: #d97706;
}

.jenis-icon-weaving {
    background-color: #dcfce7;
    color: #16a34a;
}

/* Custom Select2 Modern styling */
.select2-container--default .select2-selection--single {
    height: 42px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 8px !important;
    padding: 6px 10px !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 28px !important;
    color: #374151 !important;
    font-size: 0.9rem !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px !important;
    right: 8px !important;
}

.select2-dropdown {
    border-radius: 8px !important;
    border: 1px solid #d1d5db !important;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

/* Button & Interaction Animation */
.btn-press-anim {
    transition: transform 0.12s ease, box-shadow 0.15s ease;
    border-radius: 8px;
}

.btn-press-anim:active {
    transform: scale(0.97);
}

.note-editor.note-frame {
    border-radius: 8px !important;
    border-color: #d1d5db !important;
    overflow: hidden;
}
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-12 col-md-7">
                <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.6rem;">
                    <i class="fas fa-file-invoice text-primary mr-2"></i>Registrasi Keluhan Pelanggan Eksternal
                </h1>
                <p class="text-muted small mb-0 mt-1">
                    Form pencatatan keluhan teknis dari pelanggan eksternal (buyer) untuk investigasi dan tindak lanjut Quality Assurance (QA).
                </p>
            </div>
            <div class="col-12 col-md-5 text-md-right mt-3 mt-md-0">
                <ol class="breadcrumb bg-transparent p-0 mb-2 justify-content-md-end small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('keluhan.index') }}">Keluhan</a></li>
                    <li class="breadcrumb-item active text-primary">Tambah Eksternal</li>
                </ol>
                <div class="d-flex justify-content-md-end" style="gap: 8px;">
                    <a href="{{ route('keluhan.internal') }}" class="btn btn-outline-info btn-sm shadow-sm btn-press-anim">
                        <i class="fas fa-exchange-alt mr-1"></i> Beralih ke Keluhan Internal
                    </a>
                    <a href="{{ route('keluhan.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm btn-press-anim">
                        <i class="fas fa-arrow-left mr-1"></i> Daftar Keluhan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <!-- Banner Error Validasi -->
        @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert" style="border-radius: 12px; border-left: 5px solid #dc3545;">
            <div class="d-flex align-items-start">
                <i class="fas fa-exclamation-triangle fa-2x text-danger mr-3 mt-1"></i>
                <div class="flex-grow-1">
                    <h5 class="alert-heading font-weight-bold mb-1">Terdapat Kolom yang Belum Lengkap / Salah!</h5>
                    <p class="mb-2 small">Mohon periksa <strong>{{ $errors->count() }} kolom</strong> berikut sebelum mengirimkan laporan keluhan:</p>
                    <ul class="mb-0 pl-3 small font-weight-bold">
                        @foreach ($errors->all() as $error)
                            <li class="mb-1">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif

        <!-- Card Informasi Panduan Input -->
        <div class="alert alert-light border shadow-sm mb-4" style="border-radius: 12px; border-left: 5px solid #3b82f6 !important; background-color: #f8fafc;">
            <div class="d-flex align-items-center">
                <div class="mr-3 text-primary">
                    <i class="fas fa-info-circle fa-2x"></i>
                </div>
                <div>
                    <h6 class="font-weight-bold mb-1 text-dark">Ketentuan Pengisian Formulir Keluhan Eksternal</h6>
                    <span class="small text-muted">
                        Pastikan Nomor WO & Nomor SC sesuai dengan dokumen transaksi produksi. Sertakan bukti fisik atau sampel kain yang cacat agar proses investigasi QA dapat segera dijadwalkan.
                    </span>
                </div>
            </div>
        </div>

        <!-- Form Utama -->
        <form method="POST" action="{{ route('keluhan.store') }}" id="formComplaint" enctype="multipart/form-data">
            @csrf

            <div class="card card-modern mb-4">
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="m-0 font-weight-bold text-dark">
                            <i class="fas fa-clipboard-list text-primary mr-2"></i>Formulir Data Keluhan Eksternal
                        </h5>
                        <small class="text-muted">Isikan seluruh kolom bertanda bintang (<span class="text-danger">*</span>) secara lengkap</small>
                    </div>
                    <span class="badge badge-primary px-3 py-2 text-uppercase" style="letter-spacing: 0.5px; border-radius: 6px;">
                        <i class="fas fa-tag mr-1"></i> Kategori: Eksternal
                    </span>
                </div>

                <div class="card-body p-4">

                    <!-- BAGIAN 1: INFORMASI REGISTRASI & PELANGGAN -->
                    <div class="form-section-header">
                        <i class="fas fa-user-tag"></i> 1. Informasi Registrasi & Pelanggan (Buyer)
                    </div>

                    <div class="row">
                        <!-- Tanggal Keluhan -->
                        <div class="col-12 col-md-4 mb-3">
                            <label for="tgl_keluhan" class="form-label-custom">
                                <span>Tanggal Keluhan <span class="text-danger">*</span></span>
                                <small class="text-muted">Tanggal laporan</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-modern"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" name="tgl_keluhan" id="tgl_keluhan" 
                                       class="form-control form-control-modern @error('tgl_keluhan') is-invalid @enderror"
                                       value="{{ old('tgl_keluhan', date('Y-m-d')) }}" required>
                                @error('tgl_keluhan')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Nama Pelanggan / Buyer -->
                        <div class="col-12 col-md-4 mb-3">
                            <label for="buyers_id" class="form-label-custom">
                                <span>Nama Buyer / Pelanggan <span class="text-danger">*</span></span>
                            </label>
                            <select name="buyers_id" id="buyers_id" 
                                    class="form-control select2 @error('buyers_id') is-invalid @enderror" required style="width: 100%;">
                                <option value=""></option>
                                @foreach($buyer as $item)
                                    <option value="{{ $item->id }}" {{ old('buyers_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_buyer }}
                                    </option>
                                @endforeach
                            </select>
                            @error('buyers_id')
                            <div class="text-danger small font-weight-bold mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Marketing -->
                        <div class="col-12 col-md-4 mb-3">
                            <label for="nama_marketing" class="form-label-custom">
                                <span>Nama Marketing <span class="text-danger">*</span></span>
                                <small class="text-muted"><i class="fas fa-check-circle text-success mr-1"></i>Marketing Aktif</small>
                            </label>
                            <select name="nama_marketing" id="nama_marketing" 
                                    class="form-control select2 @error('nama_marketing') is-invalid @enderror" required style="width: 100%;">
                                <option value=""></option>
                                @php
                                    $defaultMarketing = old('nama_marketing', Auth::user()->name ?? '');
                                @endphp
                                @foreach($user as $item)
                                    <option value="{{ $item->name }}" {{ $defaultMarketing == $item->name ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_marketing')
                            <div class="text-danger small font-weight-bold mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- BAGIAN 2: DATA ORDER & SPESIFIKASI KAIN -->
                    <div class="form-section-header mt-4">
                        <i class="fas fa-layer-group"></i> 2. Data Order & Spesifikasi Produk
                    </div>

                    <div class="row">
                        <!-- Nomor WO -->
                        <div class="col-12 col-md-6 mb-3">
                            <label for="no_wo" class="form-label-custom">
                                <span>Nomor WO (Work Order) <span class="text-danger">*</span></span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-modern"><i class="fas fa-barcode"></i></span>
                                </div>
                                <input type="text" name="no_wo" id="no_wo" 
                                       class="form-control form-control-modern @error('no_wo') is-invalid @enderror" 
                                       value="{{ old('no_wo') }}" placeholder="Contoh: WO-2026-00123" required>
                                @error('no_wo')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Nomor SC -->
                        <div class="col-12 col-md-6 mb-3">
                            <label for="no_sc" class="form-label-custom">
                                <span>Nomor SC (Sales Contract) <span class="text-danger">*</span></span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-modern"><i class="fas fa-file-contract"></i></span>
                                </div>
                                <input type="text" name="no_sc" id="no_sc" 
                                       class="form-control form-control-modern @error('no_sc') is-invalid @enderror" 
                                       value="{{ old('no_sc') }}" placeholder="Contoh: SC-2026-0045" required>
                                @error('no_sc')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Jenis Proses Kain (Radio Cards) -->
                        <div class="col-12 mb-3">
                            <label class="form-label-custom mb-2">
                                <span>Jenis Proses Produksi <span class="text-danger">*</span></span>
                                <small class="text-muted">Pilih kategori proses tekstil</small>
                            </label>
                            @php
                                $selectedJenis = old('jenis', 'Dyeing');
                            @endphp
                            <div class="row">
                                <!-- Dyeing -->
                                <div class="col-12 col-md-4 mb-2">
                                    <label class="jenis-card-option w-100 {{ $selectedJenis == 'Dyeing' ? 'active' : '' }}">
                                        <input type="radio" name="jenis" value="Dyeing" {{ $selectedJenis == 'Dyeing' ? 'checked' : '' }} required>
                                        <div class="jenis-icon-box jenis-icon-dyeing">
                                            <i class="fas fa-fill-drip"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold text-dark" style="font-size: 1rem;">Dyeing</div>
                                            <small class="text-muted">Proses Pencelupan / Pewarnaan Kain</small>
                                        </div>
                                    </label>
                                </div>

                                <!-- Printing -->
                                <div class="col-12 col-md-4 mb-2">
                                    <label class="jenis-card-option w-100 {{ $selectedJenis == 'Printing' ? 'active' : '' }}">
                                        <input type="radio" name="jenis" value="Printing" {{ $selectedJenis == 'Printing' ? 'checked' : '' }} required>
                                        <div class="jenis-icon-box jenis-icon-printing">
                                            <i class="fas fa-print"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold text-dark" style="font-size: 1rem;">Printing</div>
                                            <small class="text-muted">Proses Cetak Motif / Corak Tekstil</small>
                                        </div>
                                    </label>
                                </div>

                                <!-- Weaving -->
                                <div class="col-12 col-md-4 mb-2">
                                    <label class="jenis-card-option w-100 {{ $selectedJenis == 'Weaving' ? 'active' : '' }}">
                                        <input type="radio" name="jenis" value="Weaving" {{ $selectedJenis == 'Weaving' ? 'checked' : '' }} required>
                                        <div class="jenis-icon-box jenis-icon-weaving">
                                            <i class="fas fa-border-all"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold text-dark" style="font-size: 1rem;">Weaving</div>
                                            <small class="text-muted">Proses Penenunan Kain Mentah / Grey</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @error('jenis')
                            <div class="text-danger small font-weight-bold mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Motif -->
                        <div class="col-12 col-md-4 mb-3">
                            <label for="nama_motif" class="form-label-custom">
                                <span>Nama Motif / Corak Desain <span class="text-danger">*</span></span>
                            </label>
                            <input type="text" name="nama_motif" id="nama_motif" 
                                   class="form-control form-control-modern @error('nama_motif') is-invalid @enderror" 
                                   value="{{ old('nama_motif') }}" placeholder="Contoh: Sakura Flower 03 / Motif Batik" required>
                            @error('nama_motif')
                            <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- CW QTY -->
                        <div class="col-12 col-md-4 mb-3">
                            <label for="cw_qty" class="form-label-custom">
                                <span>CW Complaint (Colorway) <span class="text-danger">*</span></span>
                            </label>
                            <input type="text" name="cw_qty" id="cw_qty" 
                                   class="form-control form-control-modern @error('cw_qty') is-invalid @enderror" 
                                   value="{{ old('cw_qty') }}" placeholder="Contoh: CW 1, CW 2, Hitam, Navy" required>
                            @error('cw_qty')
                            <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- QTY Complaint -->
                        <div class="col-12 col-md-4 mb-3">
                            <label for="qty_complaint" class="form-label-custom">
                                <span>QTY Complaint (Jumlah Keluhan) <span class="text-danger">*</span></span>
                            </label>
                            <input type="text" name="qty_complaint" id="qty_complaint" 
                                   class="form-control form-control-modern @error('qty_complaint') is-invalid @enderror" 
                                   value="{{ old('qty_complaint') }}" placeholder="Contoh: 500 Yard / 2 Roll / 150 Meter" required>
                            @error('qty_complaint')
                            <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- BAGIAN 3: URAIAN MASALAH & BUKTI PENDUKUNG -->
                    <div class="form-section-header mt-4">
                        <i class="fas fa-exclamation-circle text-danger"></i> 3. Uraian Masalah & Bukti Pendukung
                    </div>

                    <div class="row">
                        <!-- Keterangan Sample / Bukti Pendukung -->
                        <div class="col-12 mb-3">
                            <label for="keterangan_sample" class="form-label-custom">
                                <span>Keterangan Sample / Bukti Pendukung <span class="text-danger">*</span></span>
                                <small class="text-muted">Wajib diserahkan / dikirim ke QA</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-modern"><i class="fas fa-box-open"></i></span>
                                </div>
                                <input type="text" name="keterangan_sample" id="keterangan_sample" 
                                       class="form-control form-control-modern @error('keterangan_sample') is-invalid @enderror" 
                                       value="{{ old('keterangan_sample') }}" 
                                       placeholder="Contoh: 1 roll kain cacat warna diserahkan langsung ke bagian QA" required>
                                @error('keterangan_sample')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Deskripsi Masalah (Summernote) -->
                        <div class="col-12 mb-4">
                            <label for="summernote" class="form-label-custom">
                                <span>Deskripsi Lengkap Masalah / Cacat Produk <span class="text-danger">*</span></span>
                                <small class="text-muted">Uraikan detail cacat, lokasi, dan kronologi keluhan</small>
                            </label>
                            <textarea class="form-control @error('masalah') is-invalid @enderror" name="masalah" 
                                      id="summernote" required>{{ old('masalah') }}</textarea>
                            @error('masalah')
                            <div class="text-danger small font-weight-bold mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Informasi Solusi Awal / Rekomendasi Tindakan -->
                        <div class="col-12 mb-3">
                            <label for="solusi" class="form-label-custom">
                                <span>Informasi Solusi Awal / Tindakan Sementara <span class="text-danger">*</span></span>
                                <small class="text-muted">Tindakan awal penanganan (isikan '-' jika belum ada)</small>
                            </label>
                            <textarea class="form-control @error('solusi') is-invalid @enderror" name="solusi" 
                                      id="solusi" required>{{ old('solusi', '-') }}</textarea>
                            @error('solusi')
                            <div class="text-danger small font-weight-bold mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Footer Action Buttons -->
                <div class="card-footer bg-light px-4 py-3 d-flex flex-wrap align-items-center justify-content-between border-top">
                    <a href="{{ route('keluhan.index') }}" class="btn btn-outline-secondary px-4 font-weight-bold btn-press-anim mb-2 mb-sm-0">
                        <i class="fas fa-times mr-1"></i> Batal & Kembali
                    </a>
                    <div class="d-flex" style="gap: 10px;">
                        <button type="reset" class="btn btn-outline-warning px-3 font-weight-bold btn-press-anim" id="btnReset">
                            <i class="fas fa-undo mr-1"></i> Reset Form
                        </button>
                        <button type="submit" class="btn btn-primary btn-lg px-4 font-weight-bold shadow-sm btn-press-anim" id="submitBtn">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Laporan Keluhan
                        </button>
                    </div>
                </div>

            </div>
        </form>

    </div>
</section>
@endsection

@section('tablejs')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2 Modern
        $('#buyers_id').select2({
            placeholder: '-- Pilih Nama Buyer / Pelanggan --',
            allowClear: true,
            width: '100%'
        });

        $('#nama_marketing').select2({
            placeholder: '-- Pilih Staff Marketing --',
            allowClear: true,
            width: '100%'
        });

        // Interaksi klik kartu radio Jenis (Dyeing / Printing / Weaving)
        $('.jenis-card-option').on('click', function() {
            $('.jenis-card-option').removeClass('active');
            $(this).addClass('active');
            $(this).find('input[type="radio"]').prop('checked', true);
        });

        // Inisialisasi Summernote untuk Masalah
        $('#summernote').summernote({
            placeholder: 'Tuliskan deskripsi detail masalah, jenis cacat, dan kronologi komplain dari pelanggan...',
            tabsize: 2,
            height: 140,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });

        // Inisialisasi Summernote untuk Solusi
        $('#solusi').summernote({
            placeholder: 'Tuliskan solusi awal atau tindakan penanganan sementara (isikan tanda minus "-" jika belum ada)...',
            tabsize: 2,
            height: 110,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['view', ['fullscreen']]
            ]
        });

        // Submit button loading animation & konfirmasi
        $('#formComplaint').on('submit', function() {
            var $btn = $('#submitBtn');
            $btn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim Laporan Keluhan...');
            $btn.css('pointer-events', 'none').addClass('disabled');
        });

        // SweetAlert2 jika ada error validasi
        @if (isset($errors) && $errors->any())
            var errorListHtml = '<ul class="text-left mb-0 pl-3 small font-weight-bold text-danger">';
            @foreach ($errors->all() as $err)
                errorListHtml += '<li>{{ addslashes($err) }}</li>';
            @endforeach
            errorListHtml += '</ul>';

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Formulir Belum Lengkap!',
                    html: '<p class="mb-2">Silakan lengkapi atau perbaiki kolom yang ditandai merah:</p>' + errorListHtml,
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: '<i class="fas fa-check mr-1"></i> Saya Periksa Kembali'
                });
            }
        @endif
    });
</script>
@endsection
