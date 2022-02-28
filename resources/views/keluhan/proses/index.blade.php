@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="row">
            <div class="card-body">
                @include('components.alert')
                @if ($keluhan->status == 'open')
                <form method="post" action="{{route('proses.closed', $keluhan->id)}}" id="form">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success"><i class="fa fa-mouse"> Proses Sekarang </i></button>
                </form>
                @elseif ($keluhan->status == 'selesai')
                <form method="post" action="{{route('proses.status', $keluhan->id)}}" id="form">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-close"> Close Proses</i></button>
                </form>
                @else
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info!</h5>
                    Data Ini Sedang di Proses.
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-tasks"></i> FORM KELUHAN PELANGGAN
                            <small class="float-right">No : {{ $keluhan->nomer_keluhan }}</small>
                        </h4>
                    </div>

                </div>
                <hr>
                <div class="row invoice-info">
                    <div class="col-sm-3 invoice-col">
                        <address>
                            <strong>Tanggal Keluhan</strong><br>
                            <strong>Nama Buyer</strong><br>
                            <strong>Nama Marketing</strong><br>
                            <strong>Nomer Wo</strong><br>
                            <strong>Nomer Sc</strong><br>
                            <strong>Nama Motif</strong><br>
                            <strong>C/W, Qty</strong><br>
                            <strong>Jenis</strong><br>
                        </address>
                    </div>

                    <div class="col-sm-5 invoice-col">
                        <address>
                            : {{ $keluhan->tgl_keluhan }}<br>
                            : {{ $keluhan->buyer->nama_buyer }}<br>
                            : {{ $keluhan->nama_marketing }}<br>
                            : {{ $keluhan->no_wo }}<br>
                            : {{ $keluhan->no_sc }}<br>
                            : {{ $keluhan->nama_motif }}<br>
                            : {{ $keluhan->cw_qty }}<br>
                            : {{ $keluhan->jenis }}<br>
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>{!!
                            DNS2D::getBarcodeHTML($keluhan->nomer_keluhan.''.$keluhan->buyer->nama_buyer,'QRCODE')
                            !!}</b>
                    </div>
                </div>
                <hr>
                <div id="accordion">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo"><i
                                        class="fas fa-chevron-down">
                                        Informasi Masalah
                                    </i></a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                {!! $keluhan->masalah !!}
                            </div>
                        </div>
                    </div>

                    <div class="card card-success">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseThree"><i
                                        class="fas fa-chevron-down">
                                        Informasi Solusi
                                    </i></a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                {!! $keluhan->solusi !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-header">
            @if($keluhan->status == 'selesai' || $keluhan->status == 'proses' )
            <h1 class="card-title"><button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                    data-target="#myModal" id="open"><i class="fa fa-pen"></i>
                    Proses Keluhan</button></h1>
            @else
            <h3>Data tidak bisa diproses..</h3>
            @endif
        </div>
        <form method="post" action="{{route('proses.store')}}" id="form">
            @csrf
            <!-- Modal -->
            <div id="myModal" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="alert alert-danger" style="display:none"></div>
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Transaksi Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="complaints_id" value="{{ $keluhan->id }}">
                            <div class="form-group">
                                <label>Target Waktu</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="date" name="target_waktu" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" />
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="defects_id">Penyebab Komplaint</label>
                                <select name="defects_id" id="defects_id"
                                    class="form-control @error('defects_id') is-invalid @enderror">
                                    <option value="{{ old('defects_id') ?: '' }}"></option>
                                    @foreach($ab as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('defects_id'))
                                <div class="invalid-feedback">{{
                                    $errors->first('defects_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="penyelidik">Nama Penyelidik</label>
                                <select name="penyelidik" id="penyelidik"
                                    class="form-control @error('penyelidik') is-invalid @enderror">
                                    <option value="{{ old('penyelidik') ?: '' }}"></option>
                                    @foreach($ac as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('penyelidik'))
                                <div class="invalid-feedback">{{
                                    $errors->first('penyelidik') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="hasil_penelusuran">Hasil Penelurusan</label>
                                <textarea class="form-control @error('hasil_penelusuran') is-invalid @enderror"
                                    name="hasil_penelusuran" id="hasil_penelurusan"
                                    value="{{ old('hasil_penelusuran') ?: '' }}"></textarea>
                                @if ($errors->has('hasil_penelusuran'))
                                <div class="invalid-feedback">{{
                                    $errors->first('hasil_penelusuran') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="tindakan">Tindakan</label>
                                <textarea class="form-control @error('tindakan') is-invalid @enderror" name="tindakan"
                                    id="tindakan" value="{{ old('tindakan') ?: '' }}"></textarea>
                                @if ($errors->has('tindakan'))
                                <div class="invalid-feedback">{{
                                    $errors->first('tindakan') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="asal_masalah">Asal Masalah</label>
                                <input type="text" name="asal_masalah"
                                    class="form-control @error('asal_masalah') is-invalid @enderror" id="asal_masalah"
                                    value="{{ old('asal_masalah') ?: '' }}" placeholder="Masukkan Asal Masalah">
                                @if ($errors->has('asal_masalah'))
                                <div class="invalid-feedback">{{
                                    $errors->first('asal_masalah') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Tanggal Verifikasi</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="date" name="tgl_verifikasi" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" />
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="hasil_verifikasi">Hasil Verifikasi</label>
                                <textarea class="form-control @error('hasil_verifikasi') is-invalid @enderror"
                                    name="hasil_verifikasi" id="hasil_verifikasi"
                                    value="{{ old('hasil_verifikasi') ?: '' }}"></textarea>
                                @if ($errors->has('hasil_verifikasi'))
                                <div class="invalid-feedback">{{
                                    $errors->first('hasil_verifikasi') }}</div>
                                @endif
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-success " id="ajaxSubmit">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <table id="t_barang" class="table table-bordered table-striped" border="1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Target Waktu</th>
                            <th>Penyebab</th>
                            <th>Hasil</th>
                            <th>Tindakan</th>
                            <th>Tgl Verifikasi</th>
                            <th>Hasil Verifikasi</th>
                            <th>Asal Masalah</th>
                            <th>Penyelidik</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <?php $no = 1 ?>
                    <tbody>
                        @forelse ($result as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->target_waktu }}</td>
                            <td>{{ $item->defect->nama }}</td>
                            <td>{!! $item->hasil_penelusuran !!}</td>
                            <td>{!! $item->tindakan !!}</td>
                            <td>{{ $item->tgl_verifikasi }}</td>
                            <td>{!! $item->hasil_verifikasi !!}</td>
                            <td>{!! $item->asal_masalah !!}</td>
                            <td>{{ $item->users['name'] }}</td>
                            <td>
                                <div class="container">
                                    @if($keluhan->status == 'proses' || $keluhan->status =='selesai')
                                    <form action="{{ route('proses.destroy', $item->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                            @empty
                        <tr>
                            <td colspan="12">Data Penelurusan Belum Ada.</td>
                        </tr>
                        </tr>
                    </tbody>
                    @endforelse
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection

@section('tablejs')
<script>
    $(document).ready(function(){
          $('#defects_id').select2({
              placeholder: 'Pilih Defect',
              minimumInputLength: 1,
              allowClear: true
        });
        $('#penyelidik').select2({
        placeholder: 'Pilih Penyelidik',
        minimumInputLength: 1,
        allowClear: true
        });
       });
</script>

<script>
    $(document).ready(function(){
          $('#defects_id').select2({
              dropdownParent: $("#myModal"),
              placeholder: 'Pilih Penyebab',
              minimumInputLength: 1,
              width: '100%',
              allowClear: true
        });
       });
</script>
<script>
    $(document).ready(function(){
          $('#penyelidik').select2({
              dropdownParent: $("#myModal"),
              placeholder: 'Pilih Penyelidik',
              minimumInputLength: 1,
              width: '100%',
              allowClear: true
        });
       });
</script>

<script>
    $(function () {
    // Summernote
    $('#hasil_penelurusan').summernote()
    $('#tindakan').summernote()
    $('#hasil_verifikasi').summernote()
  })
</script>


</script>
@endsection
