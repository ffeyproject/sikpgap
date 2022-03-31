@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
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
                            <tr>
                                <td>Nama Buyer</td>
                                <td>Nama Penilaian</td>
                                <td>Rabu</td>
                                <td>Kamis</td>
                                <td>Jum’at</td>
                                <td>Sabtu</td>
                            <tr>
                                @if(isset($unique) && isset($index))
                                @foreach($unique as $key => $sfn)
                            <tr>
                                <td>{{ $sfn->kode_penilaian }}</td>
                                <td>{{$index[$key]}}</td>
                            </tr>
                            @endforeach
                            @endif
                            {{-- @foreach (array_merge($unique,$laporan) as $aa )
                            <tr>
                                <td>{{ $aa->kode_penelitian }}</td>

                            </tr>
                            @endforeach --}}
                            <tr>
                                <td></td>
                                <td>Seni Budaya</td>
                                <td></td>
                                <td>Sistem Operasi</td>
                                <td>Bhs.inggris</td>
                                <td>Sejarah Indonesia</td< /tr>
                            <tr>
                                <td></td>
                                <td>Pkn</td>
                            </tr>
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

<script>
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
</script>

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
