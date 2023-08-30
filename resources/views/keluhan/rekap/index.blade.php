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
                <h3>REGISTER KELUHAN PELANGGAN EKSTERNAL</h3>
            </div>
        </div>
        <div class="callout callout-warning">
            <h6>Menampilkan Data Rekap yang Statusnya Selesai atau Closed</h6>
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
                    <form action="{{ route('keluhan.data.cetak') }}" method="get">

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
                                <a href="{{ route('keluhan.data.cetak') }}" class="btn btn-warning">
                                    Refresh</a>
                            </div>
                            {{-- <div class="form-group">
                                <a href="{{ route('keluhan.data.cetak') }}" class="btn btn-warning">
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
                                    <th>Hasil Penyelidikan</th>
                                    <th>Tindakan Perbaikan</th>
                                    <th>Asal Masalah</th>
                                    <th>Penyebab Komplain</th>
                                    <th>Target Penyelesaian</th>
                                    <th>Hasil Verifikasi</th>
                                    <th>Tindakan Akhir</th>
                                    <th>Verifikasi Akhir</th>
                                    <th>Status</th>
                                </thead>
                                <?php $no = 1 ?>
                                <tbody>
                                    @foreach($complaints as $complaint)
                                    @if( $complaint->status == 'selesai' || $complaint->status == 'proses' ||
                                    $complaint->status == 'closed' )
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{$complaint->nomer_keluhan}}</td>
                                        <td>{{$complaint->tgl_keluhan}}</td>
                                        <td>{{$complaint->nama_marketing}}</td>
                                        <td>{{$complaint->nama_buyer}}</td>
                                        <td>{{$complaint->no_wo}}, {{ $complaint->no_sc }}</td>
                                        <td>{{$complaint->nama_motif}}, {{ $complaint->cw_qty }}</td>
                                        <td>{!!$complaint->masalah!!}</td>
                                        <td>{!!$complaint->hasil_penelusuran!!}</td>
                                        <td>{!! $complaint->tindakan !!}</td>
                                        <td>{{ $complaint->departements->asal_masalah }}</td>
                                        <td>{{ $complaint->defect->nama }}</td>
                                        <td>{{ $complaint->target_waktu }}</td>
                                        <td>{!! $complaint->hasil_verifikasi !!}</td>
                                        <td>{!! $complaint->solusi !!}</td>
                                        @if ($complaint->is_verifikasi == true)
                                        <td>{!! $complaint->verifikasi_akhir !!}</td>
                                        @else
                                        <td><span class="badge badge-warning">Belum Verifikasi</span></td>
                                        @endif
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
    // $(function () {
//     $("#t_barang").DataTable({
//         "responsive": true,
//         "lengthChange": false,
//         "autoWidth": true,
//         "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
//     }).buttons().container().appendTo('#t_barang_wrapper .col-md-9:eq(0)');
// });

// $(document).ready(function() {
// $('#mytable').DataTable( {
//     responsive: true,
//     autoFill: true,
//     autoWidth: true,
//     fixedColumns: true,
//     fixedHeader: true,
//     scrollY: "300px",
//     scrollX: true,
//     scrollCollapse: true,
//     dom: 'Bfrtip',
//     buttons: [
//     'copy', 'csv', 'excel', 'print',
//     {
//     extend: 'pdfHtml5',
//     orientation: 'landscape',
//     pageSize: 'LEGAL'
//     }
//     ]
//     } );
// } );

// $(document).ready(function() {
// var table = $('#t_barang').DataTable( {
// scrollY: "300px",
// scrollX: true,
// scrollCollapse: true,
// paging: false,
// fixedColumns: {
// heightMatch: 'none'
// }
// } );
// } );
</script>
{{-- <script>
    $(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('keluhan.data') }}",
columns: [
{data: 'id', name: 'id'},
{data: 'name', name: 'name'},
{data: 'email', name: 'email'},
{data: 'created_at', name: 'created_at'},
{data: 'updated_at', name: 'updated_at'}
],
initComplete: function () {
this.api().columns().every(function () {
var column = this;
var input = document.createElement("input");
$(input).appendTo($(column.footer()).empty())
.on('change', function () {
var val = $.fn.dataTable.util.escapeRegex($(this).val());

column.search(val ? val : '', true, false).draw();
});
});
}
});
});
</script> --}}

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