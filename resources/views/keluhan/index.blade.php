@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
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
        <div class="row mb-2">
            <div class="container">
                <a href="{{ route('keluhan.create') }}" class="btn btn-primary btn-lg">Tambah Keluhan</a>
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
                        <table id="t_barang" class="table table-bordered table-striped" border="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Detail</th>
                                    <th>Nomer</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Nama Buyer</th>
                                    <th>Nama Marketing</th>
                                    <th>Tgl Proses</th>
                                    <th>Status</th>
                                    @if (Auth::user()->posisi == 'marketing')
                                    <th></th>
                                    @else
                                    <th>Aksi</th>
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
                                    <td>{{ $item->buyer['nama_buyer'] }}</td>
                                    <td>{{ $item->nama_marketing }}</td>
                                    <td>
                                        @if( $item->status == 'open' )
                                        <span class="badge bg-warning">Data Belum Di Proses</span>
                                        @else
                                        {{ $item->tgl_proses }}
                                    </td>
                                    @endif
                                    <td>
                                        @if( $item->status == 'open' )
                                        <span class="badge bg-primary">{{ $item->status }}
                                            @elseif( $item->status == 'proses' )
                                            <span class="badge bg-warning">{{ $item->status }}
                                                @elseif( $item->status == 'selesai' )
                                                <span class="badge bg-success">{{ $item->status }}
                                                    @else
                                                    <span class="badge bg-danger">{{ $item->status }}
                                                        @endif
                                                    </span>
                                    </td>
                                    <td>
                                        @if( $item->status == 'open' && Auth::user()->posisi == 'marketing' )
                                        <div class="container">
                                        </div>
                                        @elseif($item->status == 'open')
                                        <div class="container">
                                            <a href="{{ route('proses.index', $item->id) }}" class="btn btn-primary"><i
                                                    class="fa fa-edit"></i>
                                                Proses</a>
                                        </div>
                                        @elseif($item->status == 'proses')
                                        <div class="container">
                                            <a href="{{ route('proses.index', $item->id) }}" class="btn btn-warning"><i
                                                    class="fa fa-edit"></i>
                                                Lanjutkan</a>
                                        </div>
                                        @elseif($item->status == 'selesai')
                                        <div class="container">
                                            <a href="{{ route('proses.index', $item->id) }}" class="btn btn-success"><i
                                                    class="fa fa-edit"></i>
                                                Lihat</a>
                                        </div>
                                        @endif
                                    </td>
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
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#t_barang_wrapper .col-md-6:eq(0)');
    });

</script>
@endsection
