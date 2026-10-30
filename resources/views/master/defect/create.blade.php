@extends('layouts.app')
@section('content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="page-header-box">
            <div class="page-title-box">
                <div class="page-title-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div>
                    <h1>Tambah Defect Baru</h1>
                    <p class="page-subtitle">Daftarkan data penyebab komplain / defect produksi</p>
                </div>
            </div>
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('defect.index') }}">Penyebab Komplain</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </div>

        @include('components.alert')
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card card-modern">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-exclamation-circle text-primary mr-1"></i>
                            <span>Form Input Defect</span>
                        </div>
                        <a href="{{ route('defect.index') }}" class="btn-modern-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                    </div>

                    <form method="post" action="{{ route('defect.store') }}" id="form" class="form-modern">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_defect">Kode Defect <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"><i class="fas fa-barcode"></i></span>
                                            </div>
                                            <input type="text" name="kode_defect"
                                                class="form-control @error('kode_defect') is-invalid @enderror" id="kode_defect"
                                                value="{{ old('kode_defect') }}" placeholder="Contoh: DEF-001" required>
                                            @if ($errors->has('kode_defect'))
                                                <div class="invalid-feedback">{{ $errors->first('kode_defect') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kategori">Kategori Proses <span class="text-danger">*</span></label>
                                        <select name="kategori" id="kategori"
                                            class="form-control @error('kategori') is-invalid @enderror" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            <option value="Dyeing" {{ old('kategori') == 'Dyeing' ? 'selected' : '' }}>Dyeing</option>
                                            <option value="Printing" {{ old('kategori') == 'Printing' ? 'selected' : '' }}>Printing</option>
                                            <option value="Weaving" {{ old('kategori') == 'Weaving' ? 'selected' : '' }}>Weaving</option>
                                            <option value="Makloon" {{ old('kategori') == 'Makloon' ? 'selected' : '' }}>Makloon</option>
                                            <option value="QA" {{ old('kategori') == 'QA' ? 'selected' : '' }}>QA</option>
                                        </select>
                                        @if ($errors->has('kategori'))
                                            <div class="invalid-feedback">{{ $errors->first('kategori') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama">Nama Defect / Masalah <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                                            </div>
                                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                                id="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Defect" required>
                                            @if ($errors->has('nama'))
                                                <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="summernote">Deskripsi / Keterangan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                            id="summernote">{{ old('keterangan') }}</textarea>
                                        @if ($errors->has('keterangan'))
                                            <div class="invalid-feedback">{{ $errors->first('keterangan') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('defect.index') }}" class="btn btn-light text-muted border">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn-modern-primary">
                                <i class="fas fa-save"></i>
                                <span>Simpan Defect</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('tablejs')
<script>
    $(document).ready(function(){
        $('#kategori').select2({
            placeholder: '-- Pilih Kategori --',
            allowClear: true
        });
        $('#summernote').summernote({
            height: 140,
            placeholder: 'Tuliskan rincian penjelasan defect...'
        });
    });
</script>
@endsection
