@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <!-- Header Page -->
    <div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);">
        <div class="card-body p-4 text-white">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="badge bg-white bg-opacity-25 text-white px-3 py-1 fs-7">Role & Permission Management</span>
                    </div>
                    <h3 class="fw-bold mb-1 text-white">Edit Role: {{ $role->name }}</h3>
                    <p class="mb-0 text-white-50">Sesuaikan hak akses modul dan rute sistem yang dapat diakses oleh peran ini.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('roles.index') }}" class="btn btn-light btn-sm px-3 shadow-sm text-dark fw-semibold">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Role
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if (isset($errors) && $errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill fs-4 me-2 text-danger"></i>
            <div>
                <strong>Perhatian!</strong> Terjadi kesalahan pada data yang Anda input:
                <ul class="mb-0 mt-1 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form method="POST" action="{{ route('roles.update', $role->id) }}" id="formEditRole">
        @method('patch')
        @csrf

        <!-- Card Role Info -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold text-dark">Nama Role <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-lock text-primary"></i></span>
                            <input value="{{ old('name', $role->name) }}" type="text" class="form-control border-start-0 ps-0" name="name" id="name" placeholder="Misal: admin, manager, staff" required>
                        </div>
                        <small class="text-muted">Nama peran unik yang digunakan untuk autentikasi sistem.</small>
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <div class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small">Status Hak Akses Aktif</div>
                                <div class="fw-bold text-dark fs-5">
                                    <span id="selected-count" class="text-primary">{{ count($rolePermissions) }}</span> / 
                                    <span id="total-count">{{ $permissions->count() }}</span> Terpilih
                                </div>
                            </div>
                            <span class="badge bg-primary px-3 py-2 rounded-pill fs-7">Guard: {{ $role->guard_name ?? 'web' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toolbar Filter Permissions -->
        <div class="card shadow-sm border-0 mb-4 sticky-top bg-white" style="top: 15px; z-index: 1020;">
            <div class="card-body py-3 px-4">
                <div class="row g-2 align-items-center justify-content-between">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                            <input type="text" id="permissionSearch" class="form-control border-start-0 ps-0" placeholder="Ketik untuk mencari permission / route...">
                            <button class="btn btn-outline-secondary border-start-0" type="button" id="clearSearch" style="display: none;">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-7 d-flex flex-wrap justify-content-md-end gap-2">
                        <button type="button" class="btn btn-outline-primary btn-sm fw-semibold" id="btnSelectAll">
                            <i class="bi bi-check-all me-1"></i> Pilih Semua ({{ $permissions->count() }})
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm fw-semibold" id="btnDeselectAll">
                            <i class="bi bi-dash-square me-1"></i> Batalkan Semua
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm px-4 fw-bold shadow-sm">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grouped Permissions List -->
        <div id="permissionsContainer">
            @php
                $rolePermLookup = array_flip($rolePermissions);
            @endphp

            @foreach($groupedPermissions as $groupName => $groupItems)
                @php
                    $groupCheckedCount = 0;
                    foreach($groupItems as $item) {
                        if (isset($rolePermLookup[$item->name])) {
                            $groupCheckedCount++;
                        }
                    }
                    $isAllGroupChecked = ($groupCheckedCount === count($groupItems));
                @endphp
                <div class="card shadow-sm border-0 mb-3 module-group-card" data-group="{{ strtolower($groupName) }}">
                    <div class="card-header bg-light py-2 px-3 border-0 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-dark px-2 py-1 fs-7 fw-bold">{{ $groupName }}</span>
                            <span class="badge bg-secondary bg-opacity-25 text-dark group-count-badge">
                                {{ $groupCheckedCount }} / {{ count($groupItems) }} aktif
                            </span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-link btn-sm text-decoration-none fw-semibold p-0 btn-toggle-group" data-group-target="{{ strtolower($groupName) }}">
                                <small>{{ $isAllGroupChecked ? 'Batalkan Modul Ini' : 'Pilih Semua di Modul Ini' }}</small>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-2">
                            @foreach($groupItems as $permission)
                                @php
                                    $isChecked = isset($rolePermLookup[$permission->name]);
                                @endphp
                                <div class="col-md-6 col-lg-4 permission-item-col" data-perm-name="{{ strtolower($permission->name) }}">
                                    <label class="permission-card-label d-flex align-items-center justify-content-between p-2 rounded border cursor-pointer h-100 {{ $isChecked ? 'bg-primary-subtle border-primary' : 'bg-white' }}" style="cursor: pointer; transition: all 0.15s ease;">
                                        <div class="d-flex align-items-center gap-2 overflow-hidden me-2">
                                            <input type="checkbox" 
                                                   name="permission[{{ $permission->name }}]" 
                                                   value="{{ $permission->name }}" 
                                                   class="form-check-input permission-checkbox mt-0 flex-shrink-0" 
                                                   data-group="{{ strtolower($groupName) }}"
                                                   {{ $isChecked ? 'checked' : '' }}>
                                            <span class="font-monospace small text-truncate fw-semibold text-dark" title="{{ $permission->name }}">
                                                {{ $permission->name }}
                                            </span>
                                        </div>
                                        <span class="badge {{ $permission->guard_name === 'api' ? 'bg-warning text-dark' : 'bg-light text-secondary border' }} flex-shrink-0" style="font-size: 0.65rem;">
                                            {{ $permission->guard_name }}
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Bottom Action Bar -->
        <div class="card shadow-sm border-0 mt-4 mb-5">
            <div class="card-body p-3 text-end d-flex justify-content-between align-items-center">
                <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Batal & Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4 fw-bold">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan Role
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('tablejs')
<script type="text/javascript">
$(document).ready(function() {
    function updateSelectedCount() {
        var totalSelected = $('.permission-checkbox:checked').length;
        $('#selected-count').text(totalSelected);

        // Update counts per group
        $('.module-group-card').each(function() {
            var group = $(this).data('group');
            var groupTotal = $(this).find('.permission-checkbox').length;
            var groupChecked = $(this).find('.permission-checkbox:checked').length;
            $(this).find('.group-count-badge').text(groupChecked + ' / ' + groupTotal + ' aktif');

            var btn = $(this).find('.btn-toggle-group small');
            if (groupChecked === groupTotal && groupTotal > 0) {
                btn.text('Batalkan Modul Ini');
            } else {
                btn.text('Pilih Semua di Modul Ini');
            }
        });
    }

    // Toggle card highlight on check
    $(document).on('change', '.permission-checkbox', function() {
        var label = $(this).closest('.permission-card-label');
        if ($(this).is(':checked')) {
            label.addClass('bg-primary-subtle border-primary').removeClass('bg-white');
        } else {
            label.removeClass('bg-primary-subtle border-primary').addClass('bg-white');
        }
        updateSelectedCount();
    });

    // Select All
    $('#btnSelectAll').on('click', function() {
        $('.permission-checkbox').each(function() {
            if (!$(this).is(':checked')) {
                $(this).prop('checked', true);
                $(this).closest('.permission-card-label').addClass('bg-primary-subtle border-primary').removeClass('bg-white');
            }
        });
        updateSelectedCount();
    });

    // Deselect All
    $('#btnDeselectAll').on('click', function() {
        $('.permission-checkbox').each(function() {
            if ($(this).is(':checked')) {
                $(this).prop('checked', false);
                $(this).closest('.permission-card-label').removeClass('bg-primary-subtle border-primary').addClass('bg-white');
            }
        });
        updateSelectedCount();
    });

    // Toggle Group Button
    $(document).on('click', '.btn-toggle-group', function() {
        var groupCard = $(this).closest('.module-group-card');
        var checkboxes = groupCard.find('.permission-checkbox');
        var allChecked = checkboxes.length === groupCard.find('.permission-checkbox:checked').length;

        checkboxes.each(function() {
            $(this).prop('checked', !allChecked);
            var label = $(this).closest('.permission-card-label');
            if (!allChecked) {
                label.addClass('bg-primary-subtle border-primary').removeClass('bg-white');
            } else {
                label.removeClass('bg-primary-subtle border-primary').addClass('bg-white');
            }
        });

        updateSelectedCount();
    });

    // Realtime Search
    $('#permissionSearch').on('keyup', function() {
        var query = $(this).val().toLowerCase().trim();
        if (query.length > 0) {
            $('#clearSearch').show();
        } else {
            $('#clearSearch').hide();
        }

        $('.module-group-card').each(function() {
            var groupCard = $(this);
            var hasVisible = false;

            groupCard.find('.permission-item-col').each(function() {
                var permName = $(this).data('perm-name');
                if (permName.indexOf(query) !== -1) {
                    $(this).show();
                    hasVisible = true;
                } else {
                    $(this).hide();
                }
            });

            if (hasVisible) {
                groupCard.show();
            } else {
                groupCard.hide();
            }
        });
    });

    // Clear Search
    $('#clearSearch').on('click', function() {
        $('#permissionSearch').val('').trigger('keyup');
    });
});
</script>
@endsection
