@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Keluhan</h1><br>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Keluhan</li>
                </ol>
            </div>
        </div>
        <div class="row mb-2">
            <div class="container">
                <a href="{{ route('keluhan.create') }}" class="btn btn-primary btn-lg">Tambah Keluhan</a>
            </div>
        </div>
        @include('components.alert')
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="t_barang" class="table table-bordered table-striped" border="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Detail</th>
                                    <th>Nomer</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Nama Buyer</th>
                                    <th>Nama Marketing</th>
                                    <th>Status</th>
                                    @if (Auth::user()->posisi == 'marketing')
                                    <th></th>
                                    @else
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <?php $no = 1 ?>
                            <tbody>
                                @forelse ($complaint as $item)
                                Pg<tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#myModal{{$item->id}}" id="open">Lihat</button>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="myModal{{$item->id}}" tabindex="-1"
                                        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel">Detail Keluhan :
                                                        {{ $item->nomer_keluhan }}, Buyer:{{ $item->buyer->nama_buyer }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal">
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">No Wo</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control"
                                                                        value="{{ $item->no_wo }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">No Sc</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control"
                                                                        value="{{ $item->no_sc }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Nama
                                                                    Motif</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control"
                                                                        value="{{ $item->nama_motif }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">C/W,Qty
                                                                </label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control"
                                                                        value="{{ $item->cw_qty }}" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="callout callout-warning">
                                                        <h5>Masalah :</h5>
                                                        <p>{!! $item->masalah !!}</p>
                                                    </div>
                                                    <div class="callout callout-info">
                                                        <h5>Solusi :</h5>
                                                        <p>{!! $item->solusi !!}</p>
                                                    </div>
                                                    {{-- <div class="col-sm-8 col-md-9">
                                                        <h4 class="text-center bg-navy">Created : {{ $item->created_at
                                                            }}</h4>
                                                        <h4 class="text-center bsg-teal">Updated : {{ $item->updated_at
                                                            }}</h4>
                                                    </div> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <td><a href="{{ route('keluhan.show', $item->id) }}" target="_blank" </a> {{
                                            $item->nomer_keluhan }}
                                    </td>
                                    <td>{{ $item->tgl_keluhan }}
                                    </td>
                                    <td>{{ $item->jenis }}</td>
                                    <td>{{ $item->buyer['nama_buyer'] }}</td>
                                    <td>{{ $item->nama_marketing }}</td>
                                    <td>
                                        @if( $item->status == 'open' )
                                        <span class="badge bg-primary">{{ $item->status }}
                                            @elseif($item->status == 'closed')
                                            <span class="badge bg-danger">{{ $item->status }}
                                                @elseif( $item->status == 'proses' )
                                                <span class="badge bg-warning">{{ $item->status }}
                                                    @else
                                                    <span class="badge bg-danger">{{ $item->status }}
                                                        @endif
                                                    </span>
                                    </td>
                                    <td>
                                        @if( $item->status == 'open' && Auth::user()->posisi == 'marketing' )
                                        <div class="container">
                                        </div>
                                        @elseif($item->status == 'open')
                                        <div class="container">
                                            <a href="{{ route('proses.index', $item->id) }}" class="btn btn-primary"><i
                                                    class="fa fa-edit"></i>
                                                Proses</a>
                                        </div>
                                        @endif
                                    </td>
                                    @empty
                                <tr>
                                    <td colspan="12">Data tidak ada.</td>
                                </tr>
                                </tr>

                            </tbody>
                            @endforelse
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@section('tablejs')
<script>
    $(function () {
        $("#t_barang").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#t_barang_wrapper .col-md-6:eq(0)');
    });

</script>
@endsection
