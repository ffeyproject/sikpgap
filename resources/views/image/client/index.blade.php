@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Client</h1><br>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Data Client</li>
                </ol>
            </div>
        </div>
        <div class="row mb-2">
            <div class="container">
                <a href="{{ route('client.create') }}" class="btn btn-primary btn-lg">Add</a>
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
                        <table id="t_contact" class="table table-bordered table-striped" border="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Gambar</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php $no = 1 ?>
                            <tbody>
                                @forelse ($image as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_client }}</td>
                                    <td><img src="{{ url('image/client/'.$item->g_client) }}"
                                            style="width: 100px; height: 100px;"></td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <div class="container">
                                            <a href="{{ route('client.edit', $item->id) }}" class="btn btn-warning"><i
                                                    class="fa fa-edit"></i></a>
                                            <form action="{{ route('client.destroy', $item->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    @empty
                                <tr>
                                    <td colspan="12">Pesan tidak ada.</td>
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
        $("#t_contact").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#t_barang_wrapper .col-md-6:eq(0)');
    });

</script>
@endsection
