@extends('customer.layout.app')
@section('content')
<div class="page-banner home-banner">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="container"><br><br><br><br><br>
                <form method="post" action="{{route('penilaian.store')}}" id="form">
                    @csrf
                    <div class="form-group">
                        <label>Nama Buyer</label>
                        <select name="buyers_id" id="buyers_id" class="dynamic form-control select2"
                            data-live-search="true" data-placeholder="Pilih Nama Buyer">
                            <option value=""></option>
                            @foreach($buyer as $key => $country)
                            <option value='{{ $key }}'>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                            id="alamat" value="{{ old('alamat') ?: '' }}" placeholder="Masukkan Alamat">
                        @if ($errors->has('alamat'))
                        <div class="invalid-feedback">{{
                            $errors->first('alamat') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="nama_kontak">Nama Kontak</label>
                        <input type="text" name="nama_kontak"
                            class="form-control @error('nama_kontak') is-invalid @enderror" id="nama_kontak"
                            value="{{ old('nama_kontak') ?: '' }}" placeholder="Masukkan Nama Kontak">
                        @if ($errors->has('nama_kontak'))
                        <div class="invalid-feedback">{{
                            $errors->first('nama_kontak') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Tanggal Penilaian</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="date" name="tgl_penilaian" class="form-control datetimepicker-input"
                                data-target="#reservationdate" />
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Description</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                            id="summernote" value="{{ old('keterangan') ?: '' }}"></textarea>
                        @if ($errors->has('keterangan'))
                        <div class="invalid-feedback">{{
                            $errors->first('keterangan') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="card-footer">

                    </div>
                </form>

            </div>
        </div>
    </div>
</div><br><br><br>

<div class="page-section client-section">
    <div class="container-fluid">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 justify-content-center">
            @foreach($image as $item)
            <div class="item wow zoomIn">
                <img src="{{ url('image/client/'.$item->g_client) }}" alt="">
            </div>
            @endforeach
        </div>
    </div> <!-- .container-fluid -->
</div> <!-- .page-section -->

@endsection
