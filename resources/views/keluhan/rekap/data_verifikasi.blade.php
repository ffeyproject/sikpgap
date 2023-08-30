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
                    <form action="{{ route('data.verifikasi') }}" method="get">

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

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Pilih</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">All</option>
                                    <option value="open">Open</option>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="va">Va</option>
                                    <option value="closed">Close</option>
                                </select>
                            </div>
                        </div>

                        <div class=" col-md-2" style="margin-top: 24px;">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <a href="{{ route('data.verifikasi') }}" class="btn btn-warning">
                                    Refresh</a>
                            </div>
                        </div>

                    </form>
                    <div class="card-body">
                        {{-- <table class="table table-bordered table-striped" id="mytable"> --}}
                            <table id="mytable" class="table table-bordered table-striped" border="1" cellpadding="5">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lihat Upload Tindakan</th>
                                        <th>Nomer</th>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Nama Buyer</th>
                                        <th>Nama Marketing</th>
                                        <th>CT/SP</th>
                                        <th>Keterangan Verifikasi</th>
                                    </tr>
                                </thead>
                                <?php $no = 1 ?>
                                <tbody>
                                    @forelse ($complaints as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-large" data-toggle="modal"
                                                data-target="#largeModal{{ $item->id }}" id="open">Lihat Hasil Upload
                                            </button>
                                        </td>
                                        <td><a href="{{ route('proses.detail', $item->id) }}" target="_blank" </a> {{
                                                $item->nomer_keluhan }}
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="largeModal{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            @if ($item->upload_tindakan == true)
                                                            <img src="{{ url('image/verifikasi/'.$item->tindakan_verifikasi) }}"
                                                                style="width: 760px; height: 700px;">
                                                            @else
                                                            <h4>Belum Ada Upload</h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class=" modal-footer">
                                                        <button type="button" class="btn btn-default" 2
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <td>{{ $item->tgl_keluhan }}
                                        </td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ $item->buyer['nama_buyer'] }}</td>
                                        <td>
                                            {{ $item->nama_marketing }}
                                        </td>
                                        <td>{{ $item->cutting_point }}</td>
                                        <td>{!! $item->verifikasi_akhir !!}</td>
                                        @empty
                                    <tr>
                                        <td colspan="12">Data tidak ada.</td>
                                    </tr>
                                    </tr>

                                </tbody>
                                @endforelse
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