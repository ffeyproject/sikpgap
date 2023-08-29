@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="row">
            <div class="card-body">
                @include('components.alert')
                @include('sweetalert::alert')
                @if ($keluhan->status == 'open')
                <form method="post" action="{{route('proses.closed', $keluhan->id)}}" id="form">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success"><i class="fa fa-mouse"> Proses Sekarang </i></button>
                </form>
                @elseif ($keluhan->status == 'selesai' || $keluhan->status == 'va')
                {{-- <form method="post" action="{{route('proses.status', $keluhan->id)}}" id="form">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-close"> Close Proses</i></button>
                </form> --}}
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Info !</h5>
                    Silahkan Tunggu Data Verifikasi Di Proses.
                </div>
                @elseif ($keluhan->status == 'closed')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Info !</h5>
                    Data Ini Sudah Close.
                </div>

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
            <div class="p-3 mb-3 invoice">
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
                            <strong>Gambar Pendukung</strong><br>
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
                            <td>
                                @if($keluhan->status == 'proses')
                                <button type="button" class="btn btn-warning btn-large" data-toggle="modal"
                                    data-target="#editModal" id="open">Edit
                                    Gambar</button>
                                @else
                                <button type="button" class="btn btn-info btn-large" data-toggle="modal"
                                    data-target="#showImage" id="open">Lihat
                                    Gambar</button>
                                @endif

                            </td>
                            <!-- Modal -->
                            <div class="modal fade" id="showImage" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body">
                                            @if($keluhan->g_keluhan == null)
                                            Maaf Tidak Ada Gambar Pendukung
                                            @else
                                            <img src="{{ url('image/keluhan/'.$keluhan->g_keluhan) }}"
                                                style="width: 760px; height: 700px;">
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form method="post" action="{{route('keluhan.egambar', $keluhan->id)}}"
                                enctype="multipart/form-data" id="form">
                                @csrf
                                @method('PATCH')
                                <!-- Modal -->
                                <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            </div>
                                            <div class="modal-body">
                                                <label>Ubah Gambar</label><br>
                                                <img src="{{ url('image/keluhan/'.$keluhan->g_keluhan) }}"
                                                    style="width: 100px; height: 100px;"><br><br>
                                                <input type="file" id="g_keluhan" name="g_keluhan"
                                                    class="@error('g_keluhan') is-invalid @enderror"
                                                    value="{{ $keluhan->g_keluhan }}">
                                                @if ($errors->has('g_keluhan'))
                                                <div class="invalid-feedback">{{ $errors->first('g_keluhan') }}</div>
                                                @endif
                                                <p class="help-block">Max.800kb</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                    Proses Awal Keluhan</button></h1>
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
                                <label for="departements_id">Asal Masalah</label>
                                <select name="departements_id" id="departements_id"
                                    class="form-control @error('departements_id') is-invalid @enderror">
                                    <option value="{{ old('departements_id') ?: '' }}"></option>
                                    @foreach($ad as $item)
                                    <option value="{{ $item->id }}">{{ $item->asal_masalah }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('departements_id'))
                                <div class="invalid-feedback">{{
                                    $errors->first('departements_id') }}</div>
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

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-success " id="ajaxSubmit">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        @foreach ($result as $item )
        @if($keluhan->status == 'selesai' || $keluhan->status == 'proses' )
        <h1 class="card-title"><button type="button" class="btn btn-block btn-success" data-toggle="modal"
                data-target="#myModal2{{$item->id}}" id="open"><i class="fas fa-arrow-circle-right"
                    style="color: #00ffff;"></i>
                Lanjutkan Proses</button></h1>
        @else
        <hr>
        @endif

        <form method="post" action="{{route('proses.next', $item->id)}}" id="form">
            @csrf
            @method('PATCH')
            <!-- Modal -->
            <div id="myModal2{{$item->id}}" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
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
                            <input type="hidden" name="complaints_id" value="{{ $item->complaint->id }}" required>
                            <input type="hidden" name="id" value="{{ $item->id }}" required>

                            <div class="form-group">
                                <label for="tindakan">Tindakan</label>
                                <textarea class="form-control @error('tindakan') is-invalid @enderror" name="tindakan"
                                    id="tindakan" value="{{ old('tindakan') ?: '' }}">{{ $item->tindakan }}</textarea>
                                @if ($errors->has('tindakan'))
                                <div class="invalid-feedback">{{
                                    $errors->first('tindakan') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Tanggal Verifikasi</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="date" name="tgl_verifikasi" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" />
                                    @if ($errors->has('tgl_verifikasi'))
                                    <div class="invalid-feedback">{{
                                        $errors->first('tgl_verifikasi') }}</div>
                                    @endif
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
                                    value="{{ old('hasil_verifikasi') ?: '' }}">{{ $item->hasil_verifikasi }}</textarea>
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
        @endforeach
        <div class="card">
            <div class="card-body">
                <table id="t_barang" class="table table-bordered table-striped" border="1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Target Waktu</th>
                            <th>Penyebab Komplain</th>
                            <th>Hasil Penelusuran Masalah</th>
                            <th>Asal Masalah</th>
                            <th>Penyelidik</th>
                            <th>Tindakan Perbaikan</th>
                            <th>Tgl Verifikasi</th>
                            <th>Hasil Verifikasi</th>
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
                            <td>{{ $item->departements->asal_masalah }}</td>
                            <td>{{ $item->users['name'] }}</td>
                            <td>{!! $item->tindakan !!}</td>
                            <td>{{ $item->tgl_verifikasi }}</td>
                            <td>{!! $item->hasil_verifikasi !!}</td>
                            <td>
                                <div class="container">
                                    <a class="btn btn-primary" data-toggle="modal"
                                        data-target="#myModalEdit{{$item->id}}" id="open">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>
                                    <form method="post" action="{{route('proses.edit', $item->id)}}" id="form">
                                        @csrf
                                        @method('PATCH')
                                        <!-- Modal -->
                                        <div id="myModalEdit{{$item->id}}" class="modal hide fade" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="alert alert-danger" style="display:none"></div>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Proses Awal</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="complaints_id"
                                                            value="{{ $item->complaint->id }}" required>
                                                        <input type="hidden" name="id" value="{{ $item->id }}" required>

                                                        <div class="form-group">
                                                            <label for="defects_id">Penyebab Komplaint</label>
                                                            <select name="defects_id" id="defects_edit"
                                                                class="form-control @error('defects_id') is-invalid @enderror">
                                                                <option value="{{ $item->defects_id }}">{{
                                                                    $item->defect->nama }}</option>
                                                                @foreach($ab as $abc)
                                                                <option value="{{ $abc->id }}">{{ $abc->nama }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('defects_id'))
                                                            <div class="invalid-feedback">{{
                                                                $errors->first('defects_id') }}</div>
                                                            @endif
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="departements_id">Penyebab Komplaint</label>
                                                            <select name="departements_id" id="departements_edit"
                                                                class="form-control @error('departements_id') is-invalid @enderror">
                                                                <option value="{{ $item->departements_id }}">{{
                                                                    $item->departements->asal_masalah }}</option>
                                                                @foreach($ad as $abc)
                                                                <option value="{{ $abc->id }}">{{ $abc->asal_masalah }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('departments_id'))
                                                            <div class="invalid-feedback">{{
                                                                $errors->first('departments_id') }}</div>
                                                            @endif
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="hasil_penelusuran">Hasil Verifikasi</label>
                                                            <textarea
                                                                class="form-control @error('hasil_penelusuran') is-invalid @enderror"
                                                                name="hasil_penelusuran" id="hasil_penelurusanE"
                                                                value="{{ old('hasil_penelusuran') ?: '' }}">{{ $item->hasil_penelusuran }}</textarea>
                                                            @if ($errors->has('hasil_penelusuran'))
                                                            <div class="invalid-feedback">{{
                                                                $errors->first('hasil_penelusuran') }}</div>
                                                            @endif
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button class="btn btn-success "
                                                                id="ajaxSubmit">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{-- <button type="button" class="btn btn-block btn-success" data-toggle="modal"
                                    data-target="#myModal2{{$item->id}}" id="open"><i class="fas fa-pencil-alt"
                                        style="color: #00ffff;"></i>
                                </button> --}}
                                <div class="container">
                                    @if($keluhan->status == 'proses' || $keluhan->status =='selesai')
                                    <form action="{{ route('proses.destroy', $item->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
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
          $('#defects_edit').select2({
            dropdownParent: $("#myModalEdit{{$item->id}}"),
              placeholder: 'Pilih Penyebab ---',
              minimumInputLength: 1,
              width: '100%',
              allowClear: true
        });
       });
</script>
<script>
    $(document).ready(function(){
          $('#departements_edit').select2({
            dropdownParent: $("#myModalEdit{{$item->id}}"),
              placeholder: 'Pilih Asal Masalah',
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
    $(document).ready(function(){
          $('#departements_id').select2({
              dropdownParent: $("#myModal"),
              placeholder: 'Pilih Asal Masalah',
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
    $('#tindakanE').summernote()
    $('#hasil_verifikasi').summernote()
    $('#hasil_penelurusanE').summernote()
  })
</script>


</script>
@endsection