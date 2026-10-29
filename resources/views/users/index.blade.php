@extends('layouts.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Master User</h1><br>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div>
        </div>
        <div class="row mb-2">
            <div class="container">
                <a href="{{ route('users.create') }}" class="btn btn-warning btn-lg">Tambah User </a>
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
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="t_barang" class="table table-bordered table-striped" border="1">
                            <thead>
                                <tr>
                                    <th style="width: 40px;" class="text-center">No</th>
                                    <th style="width: 80px;" class="text-center">TTD</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Roles</th>
                                    <th style="width: 100px;" class="text-center">Status</th>
                                    <th style="width: 140px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <?php $no = 1 ?>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="text-center align-middle">
                                        @if(!empty($user->g_ttd))
                                            <img src="{{ asset('image/ttd/' . $user->g_ttd) }}?t={{ time() }}" 
                                                 alt="TTD {{ $user->name }}" 
                                                 style="height: 38px; max-width: 80px; object-fit: contain; border: 1px solid #e3e6f0; border-radius: 4px; padding: 2px; background: #fff;"
                                                 onerror="this.onerror=null; this.parentElement.innerHTML='<span class=\'badge badge-light text-muted border\'>No Image</span>';">
                                        @else
                                            <span class="badge badge-light text-muted border">Belum ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center align-middle">
                                        @if($user->status)
                                            <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>Aktif</span>
                                        @else
                                            <span class="badge badge-danger px-2 py-1"><i class="fas fa-ban mr-1"></i>Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex align-items-center justify-content-center" style="gap: 5px;">
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info" title="Detail Pengguna">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Ubah Data & Status Pengguna">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus Pengguna"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @empty
                                <tr>
                                    <td colspan="12">Data tidak ada.</td>
                                </tr>
                                </tr>
                                @endforelse
                            </tbody>
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
