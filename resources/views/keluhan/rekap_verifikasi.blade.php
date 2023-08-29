@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1>Data Rekap Verifikasi Keluhan</h1><br>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Keluhan</li>
                </ol>
            </div>
        </div>
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
                        @include('sweetalert::alert')
                        <table id="t_barang" class="table table-bordered table-striped" border="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomer</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Nama Buyer</th>
                                    <th>Nama Marketing</th>
                                    <th>Tgl Proses</th>
                                    <th>Status Internal</th>
                                    <th>Close Marketing</th>
                                    @if (Auth::user()->posisi == 'marketing')
                                    <th></th>
                                    @else
                                    <th>Hasil Scan Penyelesaian</th>
                                    @endif
                                    <th>Kode Defect</th>
                                    <th>CT/SP</th>
                                    <th>Keterangan Verifikasi</th>
                                </tr>
                            </thead>
                            <?php $no = 1 ?>
                            <tbody>
                                @forelse ($complaint as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td><a href="{{ route('proses.detail', $item->id) }}" target="_blank" </a> {{
                                            $item->nomer_keluhan }}
                                    </td>
                                    <td>{{ $item->tgl_keluhan }}
                                    </td>
                                    <td>{{ $item->jenis }}</td>
                                    <td>{{ $item->buyer['nama_buyer'] }}</td>
                                    <td>{{ $item->nama_marketing }}</td>
                                    <td>
                                        @if( $item->status == 'open' )
                                        <span class="badge bg-warning">Data Belum Di Proses</span>
                                        @else
                                        {{ $item->tgl_proses }}
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->status == 'open' )
                                        <span class="badge bg-primary">{{ $item->status }}
                                            @elseif( $item->status == 'proses' )
                                            <span class="badge bg-warning">{{ $item->status }}
                                                @elseif( $item->status == 'selesai' )
                                                <span class="badge bg-success">{{ $item->status }}
                                                    @elseif( $item->status == 'va' )
                                                    <span class="badge bg-info">{{ $item->status }}
                                                        @else
                                                        <span class="badge bg-danger">{{ $item->status }}
                                                        </span>
                                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->status_marketing == '0' )
                                        <span class="badge bg-warning">Tidak</span>
                                        @else
                                        <span class="badge bg-danger">Ya</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $item->status == 'open' && Auth::user()->posisi == 'marketing' )
                                        <div class="container">
                                        </div>
                                        @elseif($item->status == 'open')
                                        <div class="container">
                                            <span class="badge badge-warning">Belum Ada Hasil Upload</span>
                                        </div>
                                        @elseif($item->status == 'proses')
                                        <div class="container">
                                            <span class="badge badge-warning">Belum Ada Hasil Upload</span>
                                        </div>
                                        @elseif($item->status == 'selesai')
                                        <div class="container">
                                            <span class="badge badge-warning">Belum Ada Hasil Upload</span>
                                        </div>
                                        @else
                                        <div class="container">
                                            <span class="badge badge-primary">Sudah Upload</span>
                                        </div>
                                    </td>
                                    <!-- Modal -->
                                    @endif

                                    <td>
                                        @foreach ($item->results as $aa )
                                        {{--
                                    <td>{{ $aa->departements->asal_masalah }}</td> --}}
                                    @if ($aa->defect)
                                    {{ $aa->defect->kode_defect }},
                                    @endif
                                    @endforeach
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
            "searching": true,
            "autoWidth": false,
            "buttons": [
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
                // "copy", "csv", "excel", "pdf", "print", "colvis"
               
            ]
        }).buttons().container().appendTo('#t_barang_wrapper .col-md-6:eq(0)');
    });

</script>
@endsection