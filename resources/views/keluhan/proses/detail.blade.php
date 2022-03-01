@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="row">
            <div class="card-body">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info!</h5>
                    Data Ini Sedang di Proses.
                </div>
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
                            <th>Penyebab</th>
                            <th>Hasil</th>
                            <th>Tindakan</th>
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

@endsection
