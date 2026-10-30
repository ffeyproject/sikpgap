@extends('layouts.app')

@push('page_css')
<style>
    .role-badge {
        font-size: 0.95rem;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .permission-progress-bar {
        height: 6px;
        border-radius: 4px;
        background-color: #e2e8f0;
        overflow: hidden;
        margin-top: 5px;
    }
    .action-btn-group .btn {
        margin-right: 4px;
        border-radius: 5px;
        font-weight: 600;
    }
    .stat-card {
        border-radius: 10px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.08) !important;
    }
</style>
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.6rem;">
                    <i class="fas fa-user-shield text-primary mr-2"></i>Master Role & Hak Akses
                </h1>
                <p class="text-muted small mb-0 mt-1">
                    Kelola peran pengguna sistem dan atur batasan hak akses fitur secara terpusat.
                </p>
            </div>
            <div class="col-sm-6 text-sm-right mt-3 mt-sm-0">
                <ol class="breadcrumb bg-transparent p-0 mb-2 justify-content-sm-end small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                    <li class="breadcrumb-item active">Role</li>
                </ol>
                <div class="d-inline-flex">
                    <a href="{{ route('permissions.sync') }}" class="btn btn-outline-success btn-sm shadow-sm mr-2 font-weight-bold" title="Sinkronisasi rute baru ke permissions">
                        <i class="fas fa-sync-alt mr-1"></i> Sync Route
                    </a>
                    <a href="{{ route('permissions.index') }}" class="btn btn-outline-info btn-sm shadow-sm mr-2 font-weight-bold">
                        <i class="fas fa-key mr-1"></i> Master Permission
                    </a>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm shadow-sm font-weight-bold">
                        <i class="fas fa-plus-circle mr-1"></i> Tambah Role Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content pb-4">
    <div class="container-fluid">

        @include('components.alert')

        <!-- Statistik Info Box Widgets -->
        <div class="row mb-3">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-white shadow-sm stat-card border">
                    <div class="inner p-3">
                        <h3 class="font-weight-bold text-primary mb-1">{{ $roles->count() }}</h3>
                        <p class="text-muted mb-0 font-weight-bold text-uppercase" style="font-size: 0.8rem;">Total Peran (Roles)</p>
                    </div>
                    <div class="icon" style="top: 10px; right: 15px; color: rgba(0,123,255,0.15);">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-white shadow-sm stat-card border">
                    <div class="inner p-3">
                        <h3 class="font-weight-bold text-success mb-1">{{ $totalPermissions }}</h3>
                        <p class="text-muted mb-0 font-weight-bold text-uppercase" style="font-size: 0.8rem;">Total Hak Akses Sistem</p>
                    </div>
                    <div class="icon" style="top: 10px; right: 15px; color: rgba(40,167,69,0.15);">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-white shadow-sm stat-card border">
                    <div class="inner p-3">
                        <h3 class="font-weight-bold text-info mb-1">{{ $totalUsers }}</h3>
                        <p class="text-muted mb-0 font-weight-bold text-uppercase" style="font-size: 0.8rem;">Total Pengguna Terkait</p>
                    </div>
                    <div class="icon" style="top: 10px; right: 15px; color: rgba(23,162,184,0.15);">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-white shadow-sm stat-card border">
                    <div class="inner p-3">
                        <h3 class="font-weight-bold text-warning mb-1">web</h3>
                        <p class="text-muted mb-0 font-weight-bold text-uppercase" style="font-size: 0.8rem;">Default Auth Guard</p>
                    </div>
                    <div class="icon" style="top: 10px; right: 15px; color: rgba(255,193,7,0.2);">
                        <i class="fas fa-server"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Card Utama -->
        <div class="card shadow-sm border-0" style="border-radius: 12px; border: 1px solid #e2e8f0;">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-list-ul text-primary mr-2"></i>Daftar Role Pengguna
                    </h5>
                    <small class="text-muted">Kelola data hak akses masing-masing peran melalui tombol <strong>Atur Hak Akses</strong></small>
                </div>
                <div>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm font-weight-bold shadow-sm">
                        <i class="fas fa-plus mr-1"></i> Tambah Role
                    </a>
                </div>
            </div>

            <div class="card-body p-3">
                <div class="table-responsive">
                    <table id="tableRoles" class="table table-hover table-striped align-middle" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 5%;" class="text-center">No</th>
                                <th style="width: 25%;">Nama Role</th>
                                <th style="width: 15%;" class="text-center">Pengguna Terkait</th>
                                <th style="width: 25%;">Cakupan Hak Akses</th>
                                <th style="width: 15%;">Dibuat Pada</th>
                                <th style="width: 15%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                            @php
                                $permCount = $role->permissions_count ?? $role->permissions()->count();
                                $percent = $totalPermissions > 0 ? round(($permCount / $totalPermissions) * 100) : 0;
                                $isAdmin = strtolower($role->name) === 'admin';
                            @endphp
                            <tr>
                                <td class="text-center font-weight-bold text-muted">{{ $key + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-{{ $isAdmin ? 'primary' : 'light' }} text-{{ $isAdmin ? 'white' : 'dark' }} border rounded p-2 mr-3 text-center" style="width: 40px; height: 40px; line-height: 24px;">
                                            <i class="fas {{ $isAdmin ? 'fa-crown' : 'fa-user-tag' }} fa-fw"></i>
                                        </div>
                                        <div>
                                            <span class="font-weight-bold text-dark" style="font-size: 1rem;">
                                                {{ ucfirst($role->name) }}
                                            </span>
                                            @if($isAdmin)
                                                <span class="badge badge-primary ml-1" style="font-size: 0.65rem;">Super Admin</span>
                                            @endif
                                            <div class="small text-muted">
                                                Guard: <code>{{ $role->guard_name }}</code> &bull; ID: #{{ $role->id }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-info px-3 py-2" style="font-size: 0.85rem; border-radius: 20px;">
                                        <i class="fas fa-users mr-1"></i> {{ $role->users_count }} Pengguna
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small font-weight-bold text-dark">
                                            {{ $permCount }} / {{ $totalPermissions }} Rute
                                        </span>
                                        <span class="small font-weight-bold text-{{ $percent == 100 ? 'success' : ($percent > 50 ? 'primary' : 'warning') }}">
                                            {{ $percent }}%
                                        </span>
                                    </div>
                                    <div class="permission-progress-bar">
                                        <div class="progress-bar bg-{{ $percent == 100 ? 'success' : ($percent > 50 ? 'primary' : 'warning') }}" 
                                             role="progressbar" 
                                             style="width: {{ $percent }}%;" 
                                             aria-valuenow="{{ $percent }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100"></div>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.72rem;">
                                        @if($percent == 100)
                                            <i class="fas fa-check-circle text-success mr-1"></i>Akses Penuh Semua Modul
                                        @else
                                            <i class="fas fa-info-circle text-muted mr-1"></i>Akses Terbatas Terpilih
                                        @endif
                                    </small>
                                </td>
                                <td>
                                    <span class="text-dark small font-weight-bold d-block">
                                        {{ $role->created_at ? $role->created_at->format('d M Y') : '-' }}
                                    </span>
                                    <small class="text-muted">
                                        {{ $role->created_at ? $role->created_at->format('H:i') . ' WIB' : '' }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <div class="action-btn-group d-inline-flex">
                                        <a href="{{ route('roles.edit', $role->id) }}" 
                                           class="btn btn-sm btn-primary shadow-sm" 
                                           title="Atur Hak Akses / Edit Role">
                                            <i class="fas fa-user-lock mr-1"></i> Hak Akses
                                        </a>

                                        <a href="{{ route('roles.show', $role->id) }}" 
                                           class="btn btn-sm btn-outline-info shadow-sm" 
                                           title="Lihat Detail Role">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if(!$isAdmin)
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger shadow-sm btn-delete-role" 
                                                    data-id="{{ $role->id }}" 
                                                    data-name="{{ $role->name }}" 
                                                    data-users="{{ $role->users_count }}"
                                                    data-action="{{ route('roles.destroy', $role->id) }}" 
                                                    title="Hapus Role">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @else
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-secondary shadow-sm" 
                                                    disabled 
                                                    title="Role Admin utama tidak dapat dihapus">
                                                <i class="fas fa-lock"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Modal Konfirmasi Hapus Role -->
<div class="modal fade" id="deleteRoleModal" tabindex="-1" role="dialog" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0" style="border-radius: 12px;">
            <div class="modal-header bg-danger text-white border-0 py-3">
                <h5 class="modal-title font-weight-bold" id="deleteRoleModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Konfirmasi Hapus Role
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formDeleteRole" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-body p-4 text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-danger-light d-inline-flex align-items-center justify-content-center text-danger mb-2" style="width: 60px; height: 60px; background-color: #fee2e2;">
                            <i class="fas fa-trash-alt fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="font-weight-bold text-dark mb-2">Apakah Anda yakin?</h5>
                    <p class="text-muted mb-3">
                        Anda akan menghapus role <strong class="text-danger" id="deleteRoleTargetName">...</strong>.
                    </p>
                    <div id="deleteRoleWarning" class="alert alert-warning text-left small mb-0" style="display: none;">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        Perhatian: Role ini saat ini digunakan oleh <strong id="deleteRoleUserCount">0</strong> pengguna. Menghapus role ini dapat mempengaruhi hak akses mereka.
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 py-3 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary px-3 font-weight-bold" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger px-4 font-weight-bold shadow-sm">
                        <i class="fas fa-trash-alt mr-1"></i> Ya, Hapus Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('tablejs')
<script>
    $(document).ready(function () {
        var table = $("#tableRoles").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 10,
            "order": [[0, "asc"]],
            "language": {
                "search": "Cari Role:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ditemukan role yang sesuai",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ role",
                "infoEmpty": "Tidak ada data role",
                "infoFiltered": "(disaring dari _MAX_ total role)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            },
            "buttons": [
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel mr-1"></i> Excel',
                    className: 'btn btn-success btn-sm font-weight-bold shadow-sm mr-1',
                    exportOptions: { columns: [0, 1, 2, 3, 4] }
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf mr-1"></i> PDF',
                    className: 'btn btn-danger btn-sm font-weight-bold shadow-sm mr-1',
                    exportOptions: { columns: [0, 1, 2, 3, 4] }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print mr-1"></i> Cetak',
                    className: 'btn btn-info btn-sm font-weight-bold shadow-sm mr-1',
                    exportOptions: { columns: [0, 1, 2, 3, 4] }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-columns mr-1"></i> Kolom',
                    className: 'btn btn-secondary btn-sm font-weight-bold shadow-sm'
                }
            ]
        });

        table.buttons().container().appendTo('#tableRoles_wrapper .col-md-6:eq(0)');

        // Modal konfirmasi hapus
        $(document).on('click', '.btn-delete-role', function() {
            var actionUrl = $(this).data('action');
            var roleName = $(this).data('name');
            var userCount = parseInt($(this).data('users'), 10) || 0;

            $('#formDeleteRole').attr('action', actionUrl);
            $('#deleteRoleTargetName').text(roleName);

            if (userCount > 0) {
                $('#deleteRoleUserCount').text(userCount);
                $('#deleteRoleWarning').show();
            } else {
                $('#deleteRoleWarning').hide();
            }

            $('#deleteRoleModal').modal('show');
        });
    });
</script>
@endsection
