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
                    <h1>Tambah Index Penilaian</h1>
                    <p class="page-subtitle">Daftarkan kriteria parameter baru untuk evaluasi kepuasan pelanggan</p>
                </div>
            </div>
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('item.index') }}">Index Penilaian</a></li>
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
                            <i class="fas fa-tasks text-primary mr-1"></i>
                            <span>Form Input Index Penilaian</span>
                        </div>
                        <a href="{{ route('item.index') }}" class="btn-modern-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                    </div>

                    <form method="post" action="{{ route('item.store') }}" id="form" class="form-modern">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_penilaian">Nama Parameter Penilaian <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                    <input type="text" name="nama_penilaian"
                                        class="form-control @error('nama_penilaian') is-invalid @enderror" id="nama_penilaian"
                                        value="{{ old('nama_penilaian') }}" placeholder="Contoh: Kualitas Ketepatan Waktu Pengiriman" required>
                                    @if ($errors->has('nama_penilaian'))
                                        <div class="invalid-feedback">{{ $errors->first('nama_penilaian') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="summernote">Deskripsi / Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                    id="summernote">{{ old('keterangan') }}</textarea>
                                @if ($errors->has('keterangan'))
                                    <div class="invalid-feedback">{{ $errors->first('keterangan') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('item.index') }}" class="btn btn-light text-muted border">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn-modern-primary">
                                <i class="fas fa-save"></i>
                                <span>Simpan Parameter</span>
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
        $('#summernote').summernote({
            height: 140,
            placeholder: 'Tuliskan deskripsi parameter penilaian...'
        });
    });
</script>
@endsection
