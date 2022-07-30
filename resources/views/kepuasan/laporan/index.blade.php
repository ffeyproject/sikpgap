@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1>Laporan Kepuasan</h1><br>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
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
                    {{-- <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div> --}}
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped" border="1" id="mytable" width="100px">
                            <thead>
                                {{-- <tr>
                                    <th rowspan="2" style="width: 90px;">No</th>
                                    <th rowspan="2" style="width: 90px;">Penilaian</th>
                                    <th colspan="3" style="width: 90px;">Buyer</th>
                                    <th rowspan="2" style="width: 90px;">Rata-Rata</th>
                                    <th rowspan="2" style="width: 90px;">Keterangan</th>
                                </tr>
                                <tr role="row">
                                    @foreach($index as $item)
                                    <th>{{ $item->kode_penilaian}}</th>
                                    @endforeach
                                </tr> --}}
                                <th>No</th>
                                <th>Kode Penilaian</th>
                                <th>Buyer</th>
                                <th>Tanggal Penilaian</th>
                                <th>Penilaian</th>
                                <th>Score</th>
                            </thead>
                            <?php $no = 1 ?>
                            <tbody>
                                @foreach ( $coba as $item )
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->satisfaction->kode_penilaian }}</td>
                                    <td>{{ $item->satisfaction->buyer->nama_buyer }}</td>
                                    <td>{{ $item->tgl_penilaian }}</td>
                                    <td>{{ $item->itemevaluation->nama_penilaian }}</td>
                                    <td>{{ $item->satisfaction->r_nilai }}</td>
                                    {{-- @foreach ($item->resultsatis as $nilai )
                                <tr role="row">
                                    <td>{{ $nilai->nama_penilaian }}</td>
                                </tr>
                                @endforeach --}}
                                </tr>
                                @endforeach
                                {{-- @foreach ( $index as $item )
                                <tr role="row">
                                    <td></td>
                                    <td></td>
                                    <td>{{ $item->kode_penilaian }}</td>
                                    <td>{{ $item->kode_penilaian }}</td>
                                </tr>
                                @endforeach
                                </tr> --}}
                            </tbody>
                        </table>
                        {{-- <b> NILAI RATA RATA : {{round($laporan->avg('score'), 2)}}</b> --}}
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

{{-- <script>
    $(document).ready(function() {
            $('#mytable thead tr').clone(true).appendTo( '#mytable thead' );
            $('#mytable thead tr:eq() th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type=" text" placeholder=" Search '+title+'" />' );

                        $( 'input', this ).on( 'keyup change', function () {
                        if ( table.column(i).search() !== this.value ) {
                        table
                        .column(i)
                        .search( this.value )
                        .draw();
                        }
                        });
                        });

                        var table = $('#mytable').DataTable( {
                        "autoWidth":false,
                        orderCellsTop: true,
                        fixedHeader: true,
                        orderable: true,
                        searchable: true,
                        responsive: true
                        });
    });
</script> --}}

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