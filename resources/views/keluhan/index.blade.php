@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
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
        <div class="mb-2 row">
            <div class="col-sm-6">
                {{-- <a href="{{ route('keluhan.create') }}" class="btn btn-primary btn-lg">Tambah Keluhan</a> --}}
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#keluhanModal">
                    Tambah Keluhan
                </button>
                <!-- Modal -->
                <div class="modal fade" id="keluhanModal" tabindex="-1" aria-labelledby="keluhanModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="keluhanModalLabel">Jenis Keluhan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Silakan pilih jenis sumber keluhan Anda:
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('keluhan.create') }}" class="btn btn-secondary">External (dari
                                    Buyer)</a>
                                <a href="{{ route('keluhan.internal') }}" class="btn btn-primary">Internal</a>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    <th>Detail</th>
                                    <th>Nomer</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Kategori</th>
                                    <th>Nama Buyer</th>
                                    <th>Nama Marketing</th>
                                    <th>Tgl Proses</th>
                                    <th>Status Internal</th>
                                    <th>Close Marketing</th>
                                    <th>Last Chat</th>
                                    @if (Auth::user()->posisi == 'qa' || Auth::user()->posisi == 'Admin')
                                    <th>Aksi</th>
                                    <th>Hasil Scan Penyelesaian</th>
                                    <th>CT/SP</th>
                                    <th>Verifikasi AKhir</th>
                                    @endif
                                </tr>
                            </thead>
                            <?php $no = 1 ?>
                            <tbody>
                                @forelse ($complaint as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <a href="{{ route('proses.detail', $item->id) }}" target="_blank" <button
                                            type="button" class="btn btn-info btn-sm">
                                            Detail</button></a>
                                    </td>
                                    <td><a href="{{ route('keluhan.show', $item->id) }}" target="_blank" </a> {{
                                            $item->nomer_keluhan }}
                                    </td>
                                    <td>{{ $item->tgl_keluhan }}
                                    </td>
                                    <td>{{ $item->jenis }}</td>
                                    <td>
                                        @if ($item->kategori_keluhan == 'eksternal')
                                        <span class="badge bg-success">External</span>
                                        @else
                                        <span class="badge bg-primary">Internal</span>
                                        @endif
                                    </td>
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
                                                            @endif
                                                        </span>
                                    </td>
                                    <td>
                                        @if( $item->status_marketing == '0' )
                                        <span class="badge bg-warning">Tidak</span>
                                        @else
                                        <span class="badge bg-danger">Ya</span>
                                        @endif
                                    </td>
                                    @php
                                    $latestChatPersonal = $item->chatPersonals->sortByDesc('created_at')->first();
                                    @endphp
                                    <td>
                                        {{ $latestChatPersonal->users->name ?? 'No User' }} -
                                        {{ $latestChatPersonal ? $latestChatPersonal->created_at->toDateTimeString() :
                                        'N/A' }}
                                    </td>
                                    @if (Auth::user()->posisi == 'qa' || Auth::user()->posisi == 'Admin')
                                    <td>
                                        @if( $item->status == 'open' && Auth::user()->posisi == 'marketing' )
                                        <div class="container">
                                        </div>
                                        @elseif($item->status == 'open')
                                        <div class="container">
                                            <a href="{{ route('proses.index', $item->id) }}" class="btn btn-primary"><i
                                                    class="fa fa-edit"></i>
                                                Proses</a>
                                            <a href="{{ route('keluhan.print', $item->id) }}"
                                                class="btn btn-warning">Cetak</a>
                                        </div>
                                        @elseif($item->status == 'proses')
                                        <div class="container">
                                            <a href="{{ route('proses.index', $item->id) }}" class="btn btn-warning"><i
                                                    class="fa fa-edit"></i>
                                                Lanjutkan</a>
                                        </div>
                                        @elseif($item->status == 'selesai' || $item->status =='va')
                                        <div class="container">
                                            <a href="{{ route('proses.index', $item->id) }}" class="btn btn-success"><i
                                                    class="fa fa-edit"></i>
                                                Lihat</a>
                                        </div>
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
                                        <button type="button" class="btn btn-info btn-large" data-toggle="modal"
                                            data-target="#largeModal{{ $item->id }}" id="open">Lihat Hasil Upload
                                        </button>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="largeModal{{ $item->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="basicModal" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <img src="{{ url('image/scan/'.$item->hasil_scan) }}"
                                                            style="width: 760px; height: 700px;">
                                                    </div>
                                                </div>
                                                <div class=" modal-footer">
                                                    <button type="button" class="btn btn-default" 2
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    </td>
                                    <td>{{ $item->cutting_point }}</td>
                                    <td>{!! $item->verifikasi_akhir !!}</td>
                                    @endif
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