@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="row">
            <div class="card-body">
                @include('sweetalert::alert')
                @if($keluhan->status == 'closed')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info!</h5>
                    Data Ini Sudah Close.
                </div>
                <button type="button" class="btn btn-primary btn-large" data-toggle="modal" data-target="#myImage"
                    id="open"><i class="fas fa-file-upload"></i> Upload Data Form Penyelesaian
                </button>
                <form method="post" action="{{route('keluhan.scan', $keluhan->id)}}" id="form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <!-- Modal -->
                    <div id="myImage" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="alert alert-danger" style="display:none"></div>
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Hasil Scan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="complaints_id" value="{{ $keluhan->id }}">

                                    <div class="form-group">
                                        <label for="hasil_scan">Gambar Hasil Scan</label>
                                        <input type="file" name="hasil_scan"
                                            class="form-control @error('hasil_scan') is-invalid @enderror"
                                            id="hasil_scan" value="{{ old('hasil_scan') ?: '' }}" placeholder="">
                                        @if ($errors->has('hasil_scan'))
                                        <div class="invalid-feedback">{{
                                            $errors->first('hasil_scan') }}</div>
                                        @endif
                                        <p class="help-block">Max.1.2Mb</p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button class="btn btn-success " id="ajaxSubmit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form><br>

                @if( Auth::user()->posisi == 'qa' && $keluhan->is_verifikasi ==
                false || Auth::user()->posisi == 'Admin' && $keluhan->is_verifikasi ==
                false )
                <button type="button" class="btn btn-warning btn-large" data-toggle="modal" data-target="#myModal"
                    id="open"><i class="fab fa-get-pocket"></i> Verifikasi Akhir
                </button>
                <form method="post" action="{{route('verifikasi.store', $keluhan->id)}}" id="form">
                    @csrf
                    @method('PATCH')
                    <!-- Modal -->
                    <div id="myModal" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="alert alert-danger" style="display:none"></div>
                                <div class="modal-header">
                                    <h5 class="modal-title">Verifikasi Akhir</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="complaints_id" value="{{ $keluhan->id }}">
                                    <div class="form-group">
                                        <label for="cutting_point">Cutting Point</label>
                                        <input type="number" name="cutting_point"
                                            class="form-control @error('cutting_point') is-invalid @enderror"
                                            id="cutting_point" value="{{ old('cutting_point') ?: '' }}"
                                            placeholder="Masukkan Cutting Point">
                                        @if ($errors->has('cutting_point'))
                                        <div class="invalid-feedback">{{
                                            $errors->first('cutting_point') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="verifikasi_akhir">Verifikasi Akhir</label>
                                        <textarea class="form-control @error('verifikasi_akhir') is-invalid @enderror"
                                            name="verifikasi_akhir"
                                            id="verifikasi_akhir">{{ old('verifikasi_akhir') ?: '' }}</textarea>
                                        @if ($errors->has('verifikasi_akhir'))
                                        <div class="invalid-feedback">{{
                                            $errors->first('verifikasi_akhir') }}</div>
                                        @endif
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button class="btn btn-success " id="ajaxSubmit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @else
                <button type="button" class="btn btn-success btn-large" data-toggle="modal" data-target="#myUpload"
                    id="open"><i class="fas fa-upload"></i> Silahkan Upload Tindakan Verifikasi
                </button>
                <form method="post" action="{{route('upload.verifikasi', $keluhan->id)}}" id="form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <!-- Modal -->
                    <div id="myUpload" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="alert alert-danger" style="display:none"></div>
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Dokumen Hasil Tindakan Verifikasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="complaints_id" value="{{ $keluhan->id }}">

                                    <div class="form-group">
                                        <label for="tindakan_verifikasi">Upload Hasil</label>
                                        <input type="file" name="tindakan_verifikasi"
                                            class="form-control @error('tindakan_verifikasi') is-invalid @enderror"
                                            id="tindakan_verifikasi" value="{{ old('tindakan_verifikasi') ?: '' }}"
                                            placeholder="">
                                        @if ($errors->has('tindakan_verifikasi'))
                                        <div class="invalid-feedback">{{
                                            $errors->first('tindakan_verifikasi') }}</div>
                                        @endif
                                        <p class="help-block">Max.1.5Mb</p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button class="btn btn-success " id="ajaxSubmit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form><br>
                @endif

                @else
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info!</h5>
                    Data Ini Sedang di Proses.
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Progres Data</h3>
                    </div>
                    <div class="p-0 card-body">
                        <div class="bs-stepper">
                            <div class="bs-stepper-header" role="tablist">

                                <div class="step" data-target="#open">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="open"
                                        id="open-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        @if ($keluhan->status == 'open' )
                                        <span class="badge bg-primary">Open</span>
                                        @else
                                        <span class="bs-stepper-label">Open</span>
                                        @endif
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#proses">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="proses"
                                        id="proses-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        @if ($keluhan->status == 'proses' )
                                        <span class="badge bg-primary">Proses</span>
                                        @else
                                        <span class="bs-stepper-label">Proses</span>
                                        @endif
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#selesai">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="selesai"
                                        id="selesai">
                                        <span class="bs-stepper-circle">3</span>
                                        @if ($keluhan->status == 'selesai' )
                                        <span class="badge bg-primary">Selesai</span>
                                        @else
                                        <span class="bs-stepper-label">Selesai</span>
                                        @endif
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#closed">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="closed"
                                        id="closed">
                                        <span class="bs-stepper-circle">4</span>
                                        @if ($keluhan->status == 'closed' )
                                        <span class="badge bg-primary">Closed</span>
                                        @else
                                        <span class="bs-stepper-label">Closed</span>
                                        @endif
                                    </button>
                                </div>
                            </div>
                            {{-- <div class="bs-stepper-content">

                                <div id="logins-part" class="content" role="tabpanel"
                                    aria-labelledby="logins-part-trigger">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1"
                                            placeholder="Password">
                                    </div>
                                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                </div>
                                <div id="information-part" class="content" role="tabpanel"
                                    aria-labelledby="information-part-trigger">
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="card-footer">
                        Jika bewarna biru maka proses status terakhir yang sedan dilakukan.
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
                                @if ($keluhan->status == 'proses' || $keluhan->status == 'selesai' || $keluhan->status
                                ==
                                'closed' || Auth::user()->posisi ==
                                'marketing' || Auth::user()->posisi ==
                                'admin')
                                <form method="post" action="{{route('close.marketing', $keluhan->id)}}" id="form">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-close">Close
                                            Marketing</i></button>
                                </form>
                                @endif
                                <br>
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> Update data gagal.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if($keluhan->status == 'selesai' || $keluhan->status =='closed' )
                                <a class="btn btn-info" href="{{ route('keluhan.cetak', $keluhan->id) }}"
                                    target="_blank"> Cetak
                                </a>
                                @endif
                                @if ($keluhan->status == 'selesai' || Auth::user()->posisi == 'qa' ||
                                Auth::user()->posisi ==
                                'admin')
                                <button type="button" class="btn btn-warning btn-large" data-toggle="modal"
                                    data-target="#editModal" id="open">Edit
                                    Informasi Solusi</button>
                                @endif
                            </div>
                            <form method="post" action="{{route('proses.esolusi', $keluhan->id)}}"
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
                                                <div class="form-group">
                                                    <label for="solusi">Solusi</label>
                                                    <textarea class="form-control @error('solusi') is-invalid @enderror"
                                                        name="solusi" id="solusi"
                                                        value="{{ old('solusi') ?: '' }}">{{ $keluhan->solusi }}</textarea>
                                                    @if ($errors->has('solusi'))
                                                    <div class="invalid-feedback">{{
                                                        $errors->first('solusi') }}</div>
                                                    @endif
                                                </div>
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
                                    <td>
                                        {{-- <button type="button" class="btn btn-info btn-large" data-toggle="modal"
                                            data-target="#largeModal" id="open">Lihat Gambar</button> --}}
                                        <button type="button" class="btn btn-info btn-large" data-toggle="modal"
                                            data-target="#largeModal" id="open">Show All
                                            Image
                                        </button>
                                    </td>
                                    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog"
                                        aria-labelledby="basicModal" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <!-- carousel -->
                                                    <div id='carouselExampleIndicators' class='carousel slide'
                                                        data-ride='carousel'>
                                                        <ol class='carousel-indicators'>
                                                            <li data-target='#carouselExampleIndicators'
                                                                data-slide-to='0' class='active'></li>
                                                            <li data-target='#carouselExampleIndicators'
                                                                data-slide-to='1'></li>
                                                            <li data-target='#carouselExampleIndicators'
                                                                data-slide-to='2'></li>
                                                        </ol>
                                                        <div class='carousel-inner'>
                                                            <?php $i=0; ?>
                                                            @foreach ($icomplaint as $gg)
                                                            <?php if ($i==0) {$set_ = 'active'; } else {$set_ = ''; } ?>
                                                            <div class='carousel-item <?php echo $set_; ?>'>
                                                                <img src="{{ url('image/keluhan/'.$gg->nama_image) }}"
                                                                    style="width: 760px; height: 700px;">
                                                            </div>
                                                            <?php $i++;?>
                                                            @endforeach
                                                        </div>
                                                        <a class='carousel-control-prev'
                                                            href='#carouselExampleIndicators' role='button'
                                                            data-slide='prev'>
                                                            <span class='carousel-control-prev-icon'
                                                                aria-hidden='true'></span>
                                                            <span class='sr-only'>Previous</span>
                                                        </a>
                                                        <a class='carousel-control-next'
                                                            href='#carouselExampleIndicators' role='button'
                                                            data-slide='next'>
                                                            <span class='carousel-control-next-icon'
                                                                aria-hidden='true'></span>
                                                            <span class='sr-only'>Next</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class=" modal-footer">
                                                    <button type="button" class="btn btn-default" 2
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                        </div>
                        <div id="accordion">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseThree"><i
                                                class="fas fa-chevron-down">
                                                Informasi Solusi
                                            </i></a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent="">
                                    <div class="card-body">
                                        {!! $keluhan->solusi !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-header">
                </div>
                <div class="card">
                    <div class="card-body">
                        <table id="t_barang" class="table table-bordered table-striped" border="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Target Waktu</th>
                                    <th>Penyebab Komplain</th>
                                    <th>Hasil Penelusuran Masalah</th>
                                    <th>Tindakan Perbaikan</th>
                                    <th>Asal Masalah</th>
                                    <th>Tgl Verifikasi</th>
                                    <th>Hasil Verifikasi</th>
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
                                    <td>{{ $item->departements->asal_masalah }}</td>
                                    <td>{{ $item->tgl_verifikasi }}</td>
                                    <td>{!! $item->hasil_verifikasi !!}</td>
                                    <td>{{ $item->users->name }}</td>
                                    <td>
                                        <div class="container">
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
            $(function () {
    // Summernote
    $('#summernote').summernote()
  })
    $(function () {
    // Summernote
    $('#verifikasi_akhir').summernote()
  })
        </script>

        <script>
            $(function () {

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()

//Date picker
$('#reservationdate').datetimepicker({
format: 'L'
});

//Date and time picker
$('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });


})
        </script>


        @endsection