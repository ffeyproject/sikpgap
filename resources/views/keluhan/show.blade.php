@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="row">
            <div class="card-body">
                @if($keluhan->status == 'open')
                <a href="{{ route('keluhan.edit', $keluhan->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i>
                    Update </a>
                <form action="{{ route('keluhan.destroy', $keluhan->id) }}" method="POST"
                    style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <i class="fa fa-trash"> Delete </i>
                    </button>
                </form>
                @elseif ($keluhan->status == 'proses' || $keluhan->status == 'selesai')
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info!</h5>
                    Data Ini Sedang Di Proses.
                </div>
                @else
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info!</h5>
                    Data Ini Sudah Close.
                </div>
                @endif
            </div>
            @include('sweetalert::alert')
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
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <a href="{{ route('keluhan.print', $keluhan->id) }}" class="btn btn-warning">Cetak</a>
                    </div>
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
                        : {{ $keluhan->cw_qty }}, {{$keluhan->qty_complaint}}<br>
                        : {{ $keluhan->jenis }}<br>
                        <td>
                            <button type="button" class="btn btn-info btn-large" data-toggle="modal"
                                data-target="#largeModal" id="open">Show All Image
                            </button>
                        </td>
                        <!-- Modal -->
                        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">

                                        <!-- carousel -->
                                        <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                            <ol class='carousel-indicators'>
                                                <li data-target='#carouselExampleIndicators' data-slide-to='0'
                                                    class='active'></li>
                                                <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
                                                <li data-target='#carouselExampleIndicators' data-slide-to='2'></li>
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

                                            <a class='carousel-control-prev' href='#carouselExampleIndicators'
                                                role='button' data-slide='prev'>
                                                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                                <span class='sr-only'>Previous</span>
                                            </a>
                                            <a class='carousel-control-next' href='#carouselExampleIndicators'
                                                role='button' data-slide='next'>
                                                <span class='carousel-control-next-icon' aria-hidden='true'></span>
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


</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Gambar No : {{ $keluhan->nomer_keluhan }} </h3><br><br>
                @if($keluhan->status == 'open' || $keluhan->status == 'proses' || $keluhan->status == 'selesai' ||
                $keluhan->status == 'closed')
                <button type="button" class="btn btn-success btn-large" data-toggle="modal" data-target="#myImage"
                    id="open">Tambah
                    Gambar</button>
                @endif
                <form method="post" action="{{route('icomplaint.store')}}" id="form" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal -->
                    <div id="myImage" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="alert alert-danger" style="display:none"></div>
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Gambar Pendukung</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="complaints_id" value="{{ $keluhan->id }}">

                                    <div class="form-group">
                                        <label for="nama_image">Gambar Pendukung</label>
                                        <input type="file" name="nama_image"
                                            class="form-control @error('nama_image') is-invalid @enderror"
                                            id="nama_image" value="{{ old('nama_image') ?: '' }}" placeholder="">
                                        @if ($errors->has('nama_image'))
                                        <div class="invalid-feedback">{{
                                            $errors->first('nama_image') }}</div>
                                        @endif
                                        <p class="help-block">Max.800kb</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan">Deskripsi</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                            name="keterangan" id="keterangan"
                                            value="{{ old('keterangan') ?: '' }}"></textarea>
                                        @if ($errors->has('keterangan'))
                                        <div class="invalid-feedback">{{
                                            $errors->first('keterangan') }}</div>
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
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="float-right form-control" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-0 card-body table-responsive" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php $no = 1 ?>
                    <tbody>
                        @forelse ($icomplaint as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><img src="{{ url('image/keluhan/'.$item->nama_image) }}"
                                    style="width: 100px; height: 100px;"></td>
                            <td>{!! $item->keterangan !!}</td>
                            <td>
                                <form action="{{ route('icomplaint.destroy', $item->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            @empty
                        <tr>
                            <td colspan="12">Gambar Pendukung Belum Ada.</td>
                        </tr>
                        </tr>
                    </tbody>
                    @endforelse
                </table>
            </div>

        </div>

    </div>
</div>

@endsection
@section('tablejs')
<script>
    $(function () {
    // Summernote
    $('#keterangan').summernote()
  })
</script>
@endsection