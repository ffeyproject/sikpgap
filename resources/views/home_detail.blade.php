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
                    <li class="breadcrumb-item active">Detail Grafik</li>
                </ol>
            </div>
        </div>
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h3>Data Detail Home Grafik</h3>
            </div>
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
                    <div class="card-body">
                        {{-- <table class="table table-bordered table-striped" id="mytable"> --}}
                            <table id="mytable" class="table table-bordered table-striped" border="1" cellpadding="5">
                                <thead>
                                    <th>No</th>
                                    <th>Departement</th>
                                    <th>Defect</th>
                                    <th>Nomer Komplaint</th>
                                </thead>
                                <?php $no = 1 ?>
                                <tbody>
                                    @foreach($result as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->departements['asal_masalah'] }}</td>
                                        <td>{{ $item->defect['nama'] }}</td>
                                        <td>{{ $item->complaint['nomer_keluhan'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <ul class="list-unstyled">
                                @foreach($result as $key => $row)
                                <li>{{ $row->departements['asal_masalah'] }}
                                    <ul>
                                        <li>{{ $result[$key]->defect['nama'] }}
                                        </li>
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                    </div> --}}
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
        autoWidth: false,
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