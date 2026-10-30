@extends('layouts.app')
@section('content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="page-header-box">
            <div class="page-title-box">
                <div class="page-title-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <div>
                    <h1>Ubah Asal Masalah</h1>
                    <p class="page-subtitle">Perbarui data: <strong>{{ $departement->asal_masalah }}</strong></p>
                </div>
            </div>
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('asal_masalah.index') }}">Asal Masalah</a></li>
                <li class="breadcrumb-item active">Ubah</li>
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
                            <i class="fas fa-map-pin text-primary mr-1"></i>
                            <span>Edit Informasi Asal Masalah</span>
                            <span class="badge-code ml-2">{{ $departement->kode_asal }}</span>
                        </div>
                        <a href="{{ route('asal_masalah.index') }}" class="btn-modern-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                    </div>

                    <form method="post" action="{{ route('asal_masalah.update', $departement->id) }}" id="form" class="form-modern">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="asal_masalah">Nama Asal Masalah / Departemen <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fas fa-sitemap"></i></span>
                                    </div>
                                    <input type="text" name="asal_masalah"
                                        class="form-control @error('asal_masalah') is-invalid @enderror" id="asal_masalah"
                                        value="{{ old('asal_masalah', $departement->asal_masalah) }}" placeholder="Masukkan Asal Masalah" required>
                                    @if ($errors->has('asal_masalah'))
                                        <div class="invalid-feedback">{{ $errors->first('asal_masalah') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="summernote">Deskripsi / Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                    id="summernote">{{ old('keterangan', $departement->keterangan) }}</textarea>
                                @if ($errors->has('keterangan'))
                                    <div class="invalid-feedback">{{ $errors->first('keterangan') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('asal_masalah.index') }}" class="btn btn-light text-muted border">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn-modern-primary">
                                <i class="fas fa-save"></i>
                                <span>Perbarui Data</span>
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
            placeholder: 'Tuliskan keterangan detail asal masalah...'
        });
    });
</script>
@endsection
