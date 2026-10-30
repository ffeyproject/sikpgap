@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.6rem;">
                    <i class="fas fa-shield-alt text-primary mr-2"></i>Detail Role: {{ ucfirst($role->name) }}
                </h1>
                <p class="text-muted small mb-0 mt-1">
                    Daftar rute dan modul yang dapat diakses oleh peran <strong>{{ $role->name }}</strong>.
                </p>
            </div>
            <div class="col-sm-6 text-sm-right mt-3 mt-sm-0">
                <ol class="breadcrumb bg-transparent p-0 mb-2 justify-content-sm-end small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
                <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm mr-1">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Role
                </a>
                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm shadow-sm font-weight-bold">
                    <i class="fas fa-user-lock mr-1"></i> Kelola Hak Akses
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content pb-5">
    <div class="container-fluid">

        <!-- Info Header Card -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0" style="border-radius: 10px;">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas {{ strtolower($role->name) === 'admin' ? 'fa-crown' : 'fa-user-tag' }} fa-2x"></i>
                        </div>
                        <h4 class="font-weight-bold text-dark mb-1">{{ ucfirst($role->name) }}</h4>
                        <span class="badge badge-primary px-3 py-1 mb-3" style="border-radius: 20px;">
                            Guard: {{ $role->guard_name }}
                        </span>

                        <ul class="list-group list-group-unbordered text-left mt-2">
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">ID Role</span>
                                <span class="font-weight-bold">#{{ $role->id }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Total Hak Akses</span>
                                <span class="badge badge-success px-2 py-1">{{ $rolePermissions->count() }} Permission</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Tanggal Dibuat</span>
                                <span class="font-weight-bold text-dark">{{ $role->created_at ? $role->created_at->format('d M Y') : '-' }}</span>
                            </li>
                        </ul>

                        <div class="mt-4">
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-block font-weight-bold shadow-sm">
                                <i class="fas fa-edit mr-1"></i> Edit Hak Akses Role
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm border-0" style="border-radius: 10px;">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="m-0 font-weight-bold text-dark">
                                <i class="fas fa-list-check text-primary mr-2"></i>Daftar Hak Akses (Permissions) Terpasang
                            </h5>
                            <small class="text-muted">Ditemukan <strong>{{ $rolePermissions->count() }} rute hak akses</strong> aktif untuk peran ini</small>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <table id="tableShowRolePerm" class="table table-hover table-striped" style="width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 8%;" class="text-center">No</th>
                                    <th>Nama Rute / Permission</th>
                                    <th style="width: 15%;" class="text-center">Guard</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rolePermissions as $index => $permission)
                                <tr>
                                    <td class="text-center text-muted font-weight-bold">{{ $index + 1 }}</td>
                                    <td>
                                        <code class="text-dark font-weight-bold" style="font-size: 0.88rem;">{{ $permission->name }}</code>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge {{ $permission->guard_name === 'api' ? 'badge-warning text-dark' : 'badge-light border text-muted' }}" style="font-size: 0.75rem;">
                                            {{ $permission->guard_name }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('tablejs')
<script>
    $(document).ready(function() {
        $('#tableShowRolePerm').DataTable({
            "responsive": true,
            "pageLength": 10,
            "language": {
                "search": "Cari Permission:",
                "lengthMenu": "Tampilkan _MENU_ per halaman",
                "zeroRecords": "Tidak ditemukan permission yang sesuai",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ permission",
                "infoEmpty": "Tidak ada permission",
                "paginate": {
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>
@endsection
