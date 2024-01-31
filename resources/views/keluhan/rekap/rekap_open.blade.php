@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item">Keluhan</a></li>
                    <li class="breadcrumb-item active">Rekap</li>
                </ol>
            </div>
        </div>
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h3>REGISTER KELUHAN PELANGGAN EKSTERNAL STATUS OPEN & PROSES</h3>
            </div>
        </div>
        <div class="callout callout-warning">
            <h6>Menampilkan Data Rekap yang Statusnya Open dan Proses</h6>
        </div>
        @include('components.alert')
        @include('sweetalert::alert')
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <!-- /.card-header -->
                    <form action="{{ route('keluhan.data.open') }}" method="get">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Start Date</label>
                                <input type="date" class="form-control" name="start_date"
                                    value="{{ $currentTime->format('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">End Date</label>
                                <input type="date" class="form-control" name="end_date"
                                    value="{{ $currentTime2->format('Y-m-d') }}">
                            </div>
                        </div>

                        <div class=" col-md-2" style="margin-top: 24px;">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <a href="{{ route('keluhan.data.open') }}" class="btn btn-warning">
                                    Refresh</a>
                            </div>
                            {{-- <div class="form-group">
                                <a href="{{ route('keluhan.data.open') }}" class="btn btn-warning">
                                    Cetak</a>
                            </div> --}}
                        </div>
                    </form>
                    <div class="card-body">
                        {{-- <table class="table table-bordered table-striped" id="mytable"> --}}
                            <table id="mytable" class="table table-bordered table-striped" border="1" cellpadding="5">
                                <thead>
                                    <th>No</th>
                                    <th>No FKP</th>
                                    <th>Tanggal FKP</th>
                                    <th>Marketing</th>
                                    <th>Buyer</th>
                                    <th>No.Wo, No.Sc</th>
                                    <th>Motif, Quantity</th>
                                    <th>Masalah</th>
                                    <th>Status</th>
                                </thead>
                                <?php $no = 1 ?>
                                <tbody>
                                    @foreach($complaints as $complaint)
                                    @if( $complaint->status == 'open' || $complaint->status == 'proses' )
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{$complaint->nomer_keluhan}}</td>
                                        <td>{{$complaint->tgl_keluhan}}</td>
                                        <td>{{$complaint->nama_marketing}}</td>
                                        <td>{{$complaint->nama_buyer}}</td>
                                        <td>{{$complaint->no_wo}}, {{ $complaint->no_sc }}</td>
                                        <td>{{$complaint->nama_motif}}, {{ $complaint->cw_qty }}</td>
                                        <td>{!!$complaint->masalah!!}</td>
                                        <td>{{$complaint->status}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- Halaman : {{ $complaints->currentPage() }} <br />
                            Jumlah Data : {{ $complaints->total() }} <br /> --}}
                            {{-- Data Per Halaman : {{ $complaints->perPage() }} Data <br />
                            {{ $complaints->links() }} --}}
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
    $(document).ready(function() {
    $('#mytable thead tr').clone(true).appendTo('#mytable thead');
    $('#mytable thead tr:eq(1) th').each(function(i) {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder=" Cari ' + title + '" />');

        $('input', this).on('keyup change', function() {
            if (table.column(i).search() !== this.value) {
                table
                    .column(i)
                    .search(this.value)
                    .draw();
            }
        });
    });

    var table = $('#mytable').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        fixedColumns: true,
        autoFill: true,
        autoWidth: true,
        scrollX: true,
        scrollCollapse: true,
        scrollY: "600px",
        dom: 'Bfrtip',
        buttons: [
            {
            extend: 'copy'
            },
            {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'LEGAL'
            },
            {
            extend: 'csv'
            },
            {
            extend: 'print'
            },
            {
            extend: 'excel'
            },
            {
            extend: 'colvis'
            }
        ]
    });
});
</script>
@endsection