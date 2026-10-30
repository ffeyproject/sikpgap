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
                    <h1>Ubah Data Pelanggan</h1>
                    <p class="page-subtitle">Perbarui data pelanggan: <strong>{{ $buyer->nama_buyer }}</strong></p>
                </div>
            </div>
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('buyer.index') }}">Pelanggan</a></li>
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
                            <i class="fas fa-id-card text-primary mr-1"></i>
                            <span>Edit Informasi Pelanggan</span>
                            <span class="badge-code ml-2">{{ $buyer->kode_buyer }}</span>
                        </div>
                        <a href="{{ route('buyer.index') }}" class="btn-modern-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                    </div>

                    <form method="post" action="{{ route('buyer.update', $buyer->id) }}" id="form" class="form-modern">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama_buyer">Nama Pelanggan <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"><i class="far fa-building"></i></span>
                                            </div>
                                            <input type="text" name="nama_buyer"
                                                class="form-control @error('nama_buyer') is-invalid @enderror" id="nama_buyer"
                                                value="{{ old('nama_buyer', $buyer->nama_buyer) }}" placeholder="Masukkan Nama Pelanggan" required>
                                            @if ($errors->has('nama_buyer'))
                                                <div class="invalid-feedback">{{ $errors->first('nama_buyer') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat_buyer">Alamat Lengkap</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <input type="text" name="alamat_buyer"
                                                class="form-control @error('alamat_buyer') is-invalid @enderror" id="alamat_buyer"
                                                value="{{ old('alamat_buyer', $buyer->alamat_buyer) }}" placeholder="Masukkan Alamat Lengkap">
                                            @if ($errors->has('alamat_buyer'))
                                                <div class="invalid-feedback">{{ $errors->first('alamat_buyer') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cp_buyer">Contact Person (PIC)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"><i class="far fa-user"></i></span>
                                            </div>
                                            <input type="text" name="cp_buyer"
                                                class="form-control @error('cp_buyer') is-invalid @enderror" id="cp_buyer"
                                                value="{{ old('cp_buyer', $buyer->cp_buyer) }}" placeholder="Nama kontak PIC">
                                            @if ($errors->has('cp_buyer'))
                                                <div class="invalid-feedback">{{ $errors->first('cp_buyer') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telp_buyer">Nomor Telepon / WhatsApp</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"><i class="fas fa-phone-alt"></i></span>
                                            </div>
                                            <input type="text" name="telp_buyer"
                                                class="form-control @error('telp_buyer') is-invalid @enderror" id="telp_buyer"
                                                value="{{ old('telp_buyer', $buyer->telp_buyer) }}" placeholder="Nomor Telepon">
                                            @if ($errors->has('telp_buyer'))
                                                <div class="invalid-feedback">{{ $errors->first('telp_buyer') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email_buyer">Email Pelanggan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"><i class="far fa-envelope"></i></span>
                                            </div>
                                            <input type="email" name="email_buyer"
                                                class="form-control @error('email_buyer') is-invalid @enderror" id="email_buyer"
                                                value="{{ old('email_buyer', $buyer->email_buyer) }}" placeholder="contoh@perusahaan.com">
                                            @if ($errors->has('email_buyer'))
                                                <div class="invalid-feedback">{{ $errors->first('email_buyer') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('buyer.index') }}" class="btn btn-light text-muted border">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn-modern-primary">
                                <i class="fas fa-save"></i>
                                <span>Perbarui Pelanggan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
