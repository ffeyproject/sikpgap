@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="row">
            <div class="card-body">
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
</div>
</div>
@endsection
