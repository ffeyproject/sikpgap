@extends('customer.layout.app')
@section('content')
<div class="page-section counter-section">
    <div class="container">
        <div class="col-12">
            <h4>
                <i class="fas fa-tasks"></i> FORM KEPUASAN PELANGGAN
                <small class="float-right">No : {{ $kepuasan->kode_penilaian }}</small>
            </h4>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-3 invoice-col">
                <address>
                    <strong>Tanggal Penilaian</strong><br>
                    <strong>Nama Buyer</strong><br>
                    <strong>Nama Kontak</strong><br>
                    <strong>Alamat</strong><br><br>
                    @if($kepuasan->status == 'open')
                    <button type="button" class="btn btn-block btn-warning btn-sm" data-toggle="modal"
                        data-target="#myModal{{$kepuasan->id}}" id="open">
                        Ubah Data Kontak
                    </button><br>
                    <form method="post" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <!-- Modal -->
                        <div class="container h-200">
                            <div class="row align-items-center h-200">
                                <div class="modal fade" id="myModal{{$kepuasan->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama_kontak">Nama Kontak</label>
                                                    <input type="Text" name="nama_kontak"
                                                        class="form-control @error('nama_kontak') is-invalid @enderror"
                                                        id="nama_kontak" value="{{ $kepuasan->nama_kontak }}"
                                                        placeholder="" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input type="Text" name="alamat"
                                                        class="form-control @error('alamat') is-invalid @enderror"
                                                        id="alamat" value="{{ $kepuasan->alamat }}" placeholder=""
                                                        autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal</label>
                                                    <div class="input-group date" id="reservationdate"
                                                        data-target-input="nearest">
                                                        <input type="date" name="tgl_penilaian"
                                                            class="form-control datetimepicker-input"
                                                            data-target="#reservationdate"
                                                            value="{{ $kepuasan->tgl_penilaian }}" />
                                                        <div class="input-group-append" data-target="#reservationdate"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="desc_kesesuaian"
                                                    class="form-control @error('desc_kesesuaian') is-invalid @enderror"
                                                    id="desc_kesesuaian" value="{{ $kepuasan->desc_kesesuaian }}"
                                                    placeholder="" autocomplete="off">
                                                <input type="hidden" name="kritik_saran"
                                                    class="form-control @error('kritik_saran') is-invalid @enderror"
                                                    id="kritik_saran" value="{{ $kepuasan->kritik_saran }}"
                                                    placeholder="" autocomplete="off">
                                                <input type="hidden" name="status"
                                                    class="form-control @error('status') is-invalid @enderror"
                                                    id="status" value="{{ $kepuasan->status }}" placeholder=""
                                                    autocomplete="off">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @else
                    <a class="btn btn-info" href="{{ route('kepuasan.cetak', $kepuasan->id) }}" target="_blank">
                        Cetak
                    </a>
                    @endif
                </address>
            </div>

            <div class="col-sm-5 invoice-col">
                <address>
                    : {{ \Carbon\Carbon::parse($kepuasan->tgl_penilaian)->format('d-m-Y') }}<br>
                    : {{ $kepuasan->buyer->nama_buyer }}<br>
                    : {{ $kepuasan->nama_kontak }}<br>
                    : {{ $kepuasan->alamat }}<br>
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>{!!
                    DNS2D::getBarcodeHTML($kepuasan->kode_penilaian.''.$kepuasan->buyer->nama_buyer,'QRCODE')
                    !!}</b><br>
            </div>

            @if($kepuasan->status == 'closed')
            <table class="table table-bordered table-striped" border="2">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Item Penilaian</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <?php $no = 1 ?>
                <tbody>
                    @foreach ($detail as $row)
                    <input type="hidden" name="satisfactions_id" value="{{ $kepuasan->id }}">
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ $row->itemevaluation->nama_penilaian}}
                        <td>{{ $row->score}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <div class="form-group">
                <label for="rata-rata">NILAI RATA RATA : {{round($detail->avg('score'), 2)}}</label>
            </div>

            <div class="card-body">
                <div class="callout callout-info">
                    <h5>Kesesuaian Produk terhadap persyaratan Sertifikasi SNI 56-2017 untuk Merek MAFELA dan
                        GAIA</h5>
                    <p>{!! $kepuasan->desc_kesesuaian !!}</p>
                </div>
                <div class="callout callout-danger">
                    <h5>Kritik dan Saran</h5>
                    <p>{!! $kepuasan->kritik_saran !!}.</p>
                </div>
            </div>
            @endif
        </div>
        <div class="row align-items-center text-center">
            @if($kepuasan->status == 'open')
            <div class="card">
                <div id="accordion">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" data-toggle="collapse" href="#petunjuk"><i
                                        class="fas fa-chevron-down">
                                        (Show) Petunjuk Pengisian
                                    </i></a>
                            </h4>
                        </div>
                        <div id="petunjuk" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <p>
                                <ul>
                                    <li>Berikan penilaian dengan cara memberikann tanda <b>ceklis</b> pada kolom yang
                                        tersedia.
                                    </li>
                                    <li>Acuan dalam memilih jawaban yang tersedia adalah sebagai berikut :</li>
                                    <ul>
                                        <li>Skor 0, apabila <b>TIDAK ADA PENILAIAN</b>
                                        </li>
                                        <li>Skor 20, apabila penilaian menurut anda atas komponen yang dinilai adalah
                                            <b>TIDAK BAIK</b>
                                        </li>
                                        <li>Skor 40, apabila penilaian menurut anda atas komponen yang dinilai adalah
                                            <b>KURANG BAIK</b>
                                        </li>
                                        <li>Skor 60, apabila penilaian menurut anda atas komponen yang dinilai adalah
                                            <b>CUKUP BAIK</b>
                                        </li>
                                        <li>Skor 80, apabila penilaian menurut anda atas komponen yang dinilai adalah
                                            <b>BAIK</b>
                                        </li>
                                        <li>Skor 100, apabila penilaian menurut anda atas komponen yang dinilai adalah
                                            <b>BAIK SEKALI</b>
                                        </li>
                                    </ul>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info!</h5>
                    Jika Index Penilaian Kosong isikan <b>Nilai 0</b>. Atau<br>
                    Jika Index No.11 Tidak Diisi Maka isikan <b>Nilai 0</b>
                </div>
                <form method="post" action="{{route('penilaian.spenilaian')}}" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered table-striped" border="2">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Item Penilaian</th>
                                <th>0</th>
                                <th>20</th>
                                <th>40</th>
                                <th>60</th>
                                <th>80</th>
                                <th>100</th>
                            </tr>
                        </thead>
                        <?php $no = 1 ?>
                        <tbody>
                            @foreach ($item as $row)
                            <input type="hidden" name="satisfactions_id" value="{{ $kepuasan->id }}">
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><input type="hidden" name="item_evaluations_id[]"
                                        class="form-control @error('item_evaluations_id') is-invalid @enderror"
                                        id="item_evaluations_id" value="{{ $row->id }}"
                                        placeholder="{{ $row->nama_penilaian }}">{{
                                    $row->nama_penilaian }}
                                </td>
                                <td align="center">
                                    <input type="checkbox" name="score[]"
                                        class="form-check-input @error('score[]') is-invalid @enderror" id="score"
                                        value="">
                                    @if ($errors->has('score[]'))
                                    <div class="invalid-feedback">{{
                                        $errors->first('score[]') }}</div>
                                    @endif
                                </td>
                                <td align="center">
                                    <input type="checkbox" name="score[]"
                                        class="form-check-input @error('score[]') is-invalid @enderror" id="score"
                                        value="20">
                                    @if ($errors->has('score[]'))
                                    <div class="invalid-feedback">{{
                                        $errors->first('score[]') }}</div>
                                    @endif
                                </td>
                                <td align="center">
                                    <input type="checkbox" name="score[]"
                                        class="form-check-input @error('score') is-invalid @enderror" id="score"
                                        value="40">
                                    @if ($errors->has('score[]'))
                                    <div class="invalid-feedback">{{
                                        $errors->first('score[]') }}</div>
                                    @endif
                                </td>
                                <td align="center">
                                    <input type="checkbox" name="score[]"
                                        class="form-check-input @error('score') is-invalid @enderror" id="score"
                                        value="60">
                                    @if ($errors->has('score[]'))
                                    <div class="invalid-feedback">{{
                                        $errors->first('score[]') }}</div>
                                    @endif
                                </td>
                                <td align="center">
                                    <input type="checkbox" name="score[]"
                                        class="form-check-input @error('score[]') is-invalid @enderror" id="score"
                                        value="80">
                                    @if ($errors->has('score[]'))
                                    <div class="invalid-feedback">{{
                                        $errors->first('score[]') }}</div>
                                    @endif
                                </td>
                                <td align="center">
                                    <input type="checkbox" name="score[]"
                                        class="form-check-input @error('score[]') is-invalid @enderror" id="score"
                                        value="100">
                                    @if ($errors->has('score[]'))
                                    <div class="invalid-feedback">{{
                                        $errors->first('score[]') }}</div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <div class="form-group">
                        <label for="desc_kesesuaian">Kesesuaian produk kami terhadap persyaratan sertifikasi
                            SNI 56-2017
                            kain tenun untuk stelan (Suiting) merek Mafela dan Gaia</label>
                        <textarea class="form-control @error('desc_kesesuaian') is-invalid @enderror"
                            name="desc_kesesuaian" id="summernote"
                            value="{{ old('desc_kesesuaian') ?: '' }}"></textarea>
                        @if ($errors->has('desc_kesesuaian'))
                        <div class="invalid-feedback">{{
                            $errors->first('desc_kesesuaian') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="kritik_saran">Kritik dan Saran</label>
                        <textarea class="form-control @error('kritik_saran') is-invalid @enderror" name="kritik_saran"
                            id="kritiksaran" value="{{ old('kritik_saran') ?: '' }}"></textarea>
                        @if ($errors->has('kritik_saran'))
                        <div class="invalid-feedback">{{
                            $errors->first('kritik_saran') }}</div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h6><i class="icon fas fa-ban"></i> NOTED !</h6>
                            * Data yang sudah di SAVE tidak bisa Diubah
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success " id="ajaxSubmit">Save</button>
                        </div>
                </form>
            </div>
            @endif
        </div>
    </div> <!-- .container -->
</div> <!-- .page-section -->
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
