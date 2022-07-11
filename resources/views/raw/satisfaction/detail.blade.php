@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="row">
            <div class="card-body">
                @if($kepuasan->status == 'closed')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info!</h5>
                    Data Ini Sudah Close.
                </div>
                <div class="mb-2 row">
                    <div class="container">
                        <a href="{{ route('kepuasan.index') }}" class="btn btn-block btn-dark btn-lg">Back To Index</a>
                    </div>
                </div>
                @include('components.alert')
                @else
                @include('components.alert')
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info!</h5>
                    Isian Form Penilaian
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="p-3 mb-3 invoice">
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-tasks"></i> FORM KEPUASAN PELANGGAN
                            <small class="float-right">No : {{ $kepuasan->kode_penilaian }}</small>
                        </h4>
                    </div>
                </div>
                <hr>
                <div class="row invoice-info">
                    <div class="col-sm-3 invoice-col">
                        <address>
                            <strong>Tanggal Penilaian</strong><br>
                            <strong>Nama Buyer</strong><br>
                            <strong>Nama Kontak</strong><br>
                            <strong>Alamat</strong><br>
                            <strong>Created By</strong><br><br>
                            <button type="button" class="btn btn-block btn-warning btn-sm" data-toggle="modal"
                                data-target="#myModal{{$kepuasan->id}}" id="open">
                                Ubah Data
                                di atas</button><br>
                            <form method="post" action="{{route('raw-data.update', $kepuasan->id)}}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <!-- Modal -->
                                <div id="myModal{{$kepuasan->id}}" class="modal hide fade" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true" style="overflow: hidden;">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="alert alert-danger" style="display:none"></div>
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="overflow: hidden;">
                                                <div class="form-group">
                                                    <label for="buyers_id">Nama Buyer</label><br>
                                                    <select name="buyers_id" id="buyers_id"
                                                        class="form-control @error('buyers_id') is-invalid @enderror">
                                                        <option value="{{ $kepuasan->buyer->id }}">{{
                                                            $kepuasan->buyer->nama_buyer }}</option>
                                                        @foreach($buyer as $ll)
                                                        <option value="{{ $ll->id }}">{{ $ll->nama_buyer }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('buyers_id'))
                                                    <div class="invalid-feedback">{{
                                                        $errors->first('buyers_id') }}</div>
                                                    @endif
                                                </div>
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
                                                <div class="form-group">
                                                    <label for="user_id">Nama Marketing</label>
                                                    <select name="user_id" id="user_id"
                                                        class="form-control @error('user_id') is-invalid @enderror">
                                                        <option value="{{ $kepuasan->user_id }}">{{
                                                            $kepuasan->users->name }}</option>
                                                        @foreach($user as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('user_id'))
                                                    <div class="invalid-feedback">{{
                                                        $errors->first('user_id') }}</div>
                                                    @endif
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
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </address>
                    </div>

                    <div class="col-sm-5 invoice-col">
                        <address>
                            : {{ \Carbon\Carbon::parse($kepuasan->tgl_penilaian)->format('d-m-Y') }}<br>
                            : {{ $kepuasan->buyer->nama_buyer }}<br>
                            : {{ $kepuasan->nama_kontak }}<br>
                            : {{ $kepuasan->alamat }}<br>
                            : {{ $kepuasan->users->name }}<br>
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
            </div>
        </div>
        <div class="card-header">
        </div>
    </div>
</div>
@endsection

@section('tablejs')

<script>
    $(document).ready(function(){
          $('#buyers_id').select2({
              dropdownParent: $('#myModal'),
              placeholder: 'Pilih Buyer',
              minimumInputLength: 1,
              width: '100%',
              allowClear: true
        });
        $('#user_id').select2({
        placeholder: 'Pilih Marketing',
        minimumInputLength: 2,
        width: '100%',
        allowClear: true
        });
       });
</script>

<script>
    $(function () {
    // Summernote
    $('#summernote').summernote()
    $('#kritiksaran').summernote()
  })
</script>

@endsection