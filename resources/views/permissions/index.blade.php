@extends('layouts.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-12 col-md-6">
                <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.6rem;">
                    <i class="fas fa-user-shield text-primary mr-2"></i>Master Permission
                </h1>
                <p class="text-muted small mb-0 mt-1">
                    Daftar hak akses dan permission rute aplikasi. Sistem otomatis mendeteksi dan mensinkronisasi rute baru setiap halaman ini dimuat.
                </p>
            </div>
            <div class="col-12 col-md-6 text-md-right mt-3 mt-md-0">
                <ol class="breadcrumb bg-transparent p-0 mb-2 justify-content-md-end small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                    <li class="breadcrumb-item active">Permission</li>
                </ol>
                <div class="d-flex justify-content-md-end" style="gap: 8px;">
                    <a href="{{ route('permissions.sync') }}" class="btn btn-success btn-sm shadow-sm" style="border-radius: 6px;">
                        <i class="fas fa-sync-alt mr-1"></i> Sync Route Sekarang
                    </a>
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm shadow-sm" style="border-radius: 6px;">
                        <i class="fas fa-plus-circle mr-1"></i> Tambah Manual
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        @include('components.alert')

        <!-- Notifikasi Banner Khusus Sinkronisasi Otomatis Rute Baru -->
        @if(session('sync_info'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert" style="border-radius: 12px; border-left: 5px solid #28a745;">
            <div class="d-flex align-items-start">
                <i class="fas fa-magic fa-2x text-success mr-3 mt-1"></i>
                <div class="flex-grow-1">
                    <h5 class="alert-heading font-weight-bold mb-1">
                        Sinkronisasi Rute Otomatis Berhasil!
                    </h5>
                    <p class="mb-2 small">
                        Sistem mendeteksi <strong>{{ session('sync_info')['count'] }} rute baru</strong> yang belum terdaftar. Rute berikut telah otomatis ditambahkan ke Master Permission dan diberikan hak aksesnya ke Role <strong>Admin</strong>:
                    </p>
                    <div class="d-flex flex-wrap" style="gap: 6px;">
                        @foreach(session('sync_info')['routes'] as $rName)
                            <span class="badge badge-light border text-dark px-2 py-1" style="font-size: 0.78rem;">
                                <i class="fas fa-check-circle text-success mr-1"></i><code>{{ $rName }}</code>
                            </span>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm" style="border-radius: 12px; border: 1px solid #e3e6f0;">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="m-0 font-weight-bold text-dark">
                                <i class="fas fa-list-alt text-primary mr-2"></i>Daftar Hak Akses (Permissions)
                            </h5>
                            <small class="text-muted">Total terdaftar: <strong>{{ $permissions->count() }} permission</strong></small>
                        </div>
                        <span class="badge badge-light border px-3 py-2 text-muted">
                            <i class="fas fa-shield-alt text-success mr-1"></i> Guard: web
                        </span>
                    </div>

                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table id="t_permissions" class="table table-bordered table-hover table-striped mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 50px;" class="text-center">No</th>
                                        <th>Nama Permission / Route</th>
                                        <th style="width: 120px;" class="text-center">Guard</th>
                                        <th style="width: 130px;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                @php $no = 1; @endphp
                                <tbody>
                                    @forelse ($permissions as $permission)
                                    <tr>
                                        <td class="text-center align-middle">{{ $no++ }}</td>
                                        <td class="align-middle">
                                            <span class="font-weight-bold text-dark">
                                                <i class="fas fa-key text-warning mr-1"></i><code>{{ $permission->name }}</code>
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-info px-2 py-1">{{ $permission->guard_name }}</span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex align-items-center justify-content-center" style="gap: 4px;">
                                                <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-sm btn-info" title="Detail">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning" title="Ubah">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus permission {{ $permission->name }}?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="fas fa-shield-alt fa-2x mb-2 d-block text-secondary"></i>
                                            Belum ada data permission.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('tablejs')
<script>
    $(function () {
        $("#t_permissions").DataTable({
            "responsive": true,
            "lengthChange": true,
            "pageLength": 25,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "language": {
                "search": "Cari Permission:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ permission",
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya"
                }
            }
        }).buttons().container().appendTo('#t_permissions_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
