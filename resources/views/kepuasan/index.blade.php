@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1>Kepuasan Pelanggan</h1><br>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Penyebab</li>
                </ol>
            </div>
        </div>
        <div class="mb-2 row">
            <div class="col-sm-6">
                <a href="{{ route('kepuasan.create') }}" class="btn btn-primary btn-lg"><i
                        class="far fa-plus-square"></i> New</a>
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
                    <div class="card-body">
                        <table id="t_kepuasan" class="table table-bordered table-striped" border="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>View</th>
                                    <th>Kode Penilaian</th>
                                    <th>Tanggal Penilaian</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nama Kontak</th>
                                    <th>Alamat</th>
                                    <th>Rata Rata Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php $no = 1 ?>
                            <tbody>
                                @forelse ($kepuasan as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <a href="{{ route('kepuasan.vpenilaian', $item->id) }}" target="_blank" <button
                                            type="button" class="btn btn-info btn-sm">
                                            Detail</button></a>
                                    </td>
                                    <td>{{ $item->kode_penilaian }}</td>
                                    <td>{{ $item->tgl_penilaian }}</td>
                                    <td>{{ $item->buyer->nama_buyer }}</td>
                                    <td>{{ $item->nama_kontak }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->r_nilai }}</td>
                                    <td>
                                        @if($item->status == 'open')
                                        <div class="container">
                                            <form action="{{ route('kepuasan.destroy', $item->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
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
        $("#t_kepuasan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#t_barang_wrapper .col-md-6:eq(0)');
    });

</script>
@endsection