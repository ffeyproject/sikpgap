@extends('layouts.app')

@push('page_css')
<style>
    .permission-item-card {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 14px;
        background-color: #ffffff;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0;
        min-height: 48px;
    }
    .permission-item-card:hover {
        border-color: #3b82f6;
        box-shadow: 0 2px 6px rgba(59, 130, 246, 0.15);
    }
    .permission-item-card.is-checked {
        background-color: #eff6ff !important;
        border-color: #60a5fa !important;
    }
    .perm-name-text {
        font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-size: 0.85rem;
        font-weight: 600;
        color: #1e293b;
        word-break: break-all;
    }
    .category-header-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
    }
    .sticky-toolbar {
        position: sticky;
        top: 0;
        z-index: 1020;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        border: 1px solid #e2e8f0;
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
                    <i class="fas fa-plus-circle text-primary mr-2"></i>Tambah Role Baru
                </h1>
                <p class="text-muted small mb-0 mt-1">
                    Buat peran baru dan pilih hak akses modul sistem yang diizinkan untuk peran ini.
                </p>
            </div>
            <div class="col-sm-6 text-sm-right mt-3 mt-sm-0">
                <ol class="breadcrumb bg-transparent p-0 mb-2 justify-content-sm-end small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a></li>
                    <li class="breadcrumb-item active">Tambah Role</li>
                </ol>
                <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Role
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content pb-5">
    <div class="container-fluid">

        @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 8px;">
            <div class="d-flex align-items-start">
                <i class="fas fa-exclamation-triangle fa-2x mr-3 mt-1"></i>
                <div>
                    <strong>Terdapat kendala pada input:</strong>
                    <ul class="mb-0 pl-3 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <form method="POST" action="{{ route('roles.store') }}" id="formCreateRole">
            @csrf

            <!-- Card Informasi Role -->
            <div class="card shadow-sm mb-4" style="border-radius: 10px; border: 1px solid #e2e8f0;">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-7">
                            <label for="name" class="font-weight-bold text-dark mb-1">
                                Nama Role / Peran <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0 text-primary">
                                        <i class="fas fa-id-badge"></i>
                                    </span>
                                </div>
                                <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name" placeholder="Misal: admin, manager, staff, qc" required>
                            </div>
                            <small class="text-muted mt-1 d-block">
                                Nama peran unik yang digunakan untuk hak akses rute sistem.
                            </small>
                        </div>
                        <div class="col-lg-6 col-md-5 mt-3 mt-md-0">
                            <div class="p-3 bg-light rounded d-flex align-items-center justify-content-between border">
                                <div>
                                    <div class="text-muted small text-uppercase font-weight-bold">Total Permission Dipilih</div>
                                    <div class="font-weight-bold text-dark" style="font-size: 1.3rem;">
                                        <span id="selected-count" class="text-primary">0</span>
                                        <span class="text-muted font-weight-normal" style="font-size: 1rem;">/ {{ $permissions->count() }} Terpilih</span>
                                    </div>
                                </div>
                                <span class="badge badge-primary px-3 py-2" style="font-size: 0.85rem; border-radius: 20px;">
                                    <i class="fas fa-shield-alt mr-1"></i> Guard: web
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Toolbar Quick Action & Live Search -->
            <div class="sticky-toolbar p-3 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-5 mb-2 mb-md-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0 text-muted">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <input type="text" id="permissionSearch" class="form-control" placeholder="Cari nama route / permission secara instan...">
                            <div class="input-group-append" id="clearSearchAppend" style="display: none;">
                                <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 text-md-right">
                        <button type="button" class="btn btn-outline-primary btn-sm font-weight-bold mr-1" id="btnSelectAll">
                            <i class="fas fa-check-double mr-1"></i> Pilih Semua ({{ $permissions->count() }})
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm font-weight-bold mr-2" id="btnDeselectAll">
                            <i class="fas fa-times-circle mr-1"></i> Batalkan Semua
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm px-3 font-weight-bold shadow-sm">
                            <i class="fas fa-save mr-1"></i> Simpan Role Baru
                        </button>
                    </div>
                </div>
            </div>

            <!-- Daftar Kategori Modul Permission -->
            <div id="permissionsContainer">
                @php
                    $oldPermissions = old('permission', []);
                    $oldLookup = is_array($oldPermissions) ? array_flip($oldPermissions) : [];
                    $catIndex = 0;
                @endphp

                @foreach($categories as $categoryName => $catData)
                    @php
                        $catIndex++;
                        $items = $catData['items'];
                        $groupCheckedCount = 0;
                        foreach($items as $item) {
                            if (isset($oldLookup[$item->name])) {
                                $groupCheckedCount++;
                            }
                        }
                        $isAllGroupChecked = ($groupCheckedCount === $items->count() && $items->count() > 0);
                        $catColor = $catData['color'];
                    @endphp

                    <div class="card card-outline card-{{ $catColor }} shadow-sm mb-4 module-category-card" data-category="{{ strtolower($categoryName) }}" style="border-radius: 10px;">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="d-flex align-items-center mb-2 mb-md-0">
                                    <div class="bg-{{ $catColor }} text-white rounded-circle mr-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                        <i class="{{ $catData['icon'] }} fa-fw"></i>
                                    </div>
                                    <div>
                                        <h5 class="category-header-title mb-0">
                                            {{ $categoryName }}
                                        </h5>
                                        <small class="text-muted">{{ $catData['description'] }}</small>
                                    </div>
                                    <span class="badge badge-light border ml-3 px-2 py-1 cat-count-badge font-weight-bold" style="font-size: 0.82rem;">
                                        <span class="checked-in-cat">{{ $groupCheckedCount }}</span> / {{ $items->count() }} Aktif
                                    </span>
                                </div>
                                <div class="card-tools d-flex align-items-center">
                                    <button type="button" class="btn btn-sm btn-outline-{{ $catColor }} font-weight-bold mr-2 btn-toggle-cat" data-cat-id="{{ $catIndex }}">
                                        <i class="fas {{ $isAllGroupChecked ? 'fa-square' : 'fa-check-square' }} mr-1"></i>
                                        <span class="btn-toggle-label">{{ $isAllGroupChecked ? 'Batalkan Kategori Ini' : 'Pilih Semua di Kategori Ini' }}</span>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 bg-light">
                            <div class="row">
                                @foreach($items as $permission)
                                    @php
                                        $isChecked = isset($oldLookup[$permission->name]);
                                    @endphp
                                    <div class="col-xl-4 col-md-6 mb-2 permission-item-col" data-perm-name="{{ strtolower($permission->name) }}">
                                        <label class="permission-item-card {{ $isChecked ? 'is-checked' : '' }}" for="perm_{{ $permission->id }}">
                                            <div class="custom-control custom-checkbox mr-2">
                                                <input type="checkbox" 
                                                       name="permission[{{ $permission->name }}]" 
                                                       value="{{ $permission->name }}" 
                                                       class="custom-control-input permission-checkbox" 
                                                       id="perm_{{ $permission->id }}"
                                                       {{ $isChecked ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="perm_{{ $permission->id }}">
                                                    <span class="perm-name-text" title="{{ $permission->name }}">
                                                        {{ $permission->name }}
                                                    </span>
                                                </label>
                                            </div>
                                            <span class="badge {{ $permission->guard_name === 'api' ? 'badge-warning text-dark' : 'badge-light border text-muted' }}" style="font-size: 0.68rem; padding: 4px 6px;">
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

            <!-- Footer Action Card -->
            <div class="card shadow-sm" style="border-radius: 10px; border: 1px solid #e2e8f0;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Batal & Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm">
                        <i class="fas fa-save mr-1"></i> Simpan Role Baru
                    </button>
                </div>
            </div>

        </form>
    </div>
</section>
@endsection

@section('tablejs')
<script type="text/javascript">
$(document).ready(function() {
    function updateSelectedCounters() {
        var totalSelected = $('.permission-checkbox:checked').length;
        $('#selected-count').text(totalSelected);

        $('.module-category-card').each(function() {
            var catTotal = $(this).find('.permission-checkbox').length;
            var catChecked = $(this).find('.permission-checkbox:checked').length;
            $(this).find('.checked-in-cat').text(catChecked);

            var toggleBtn = $(this).find('.btn-toggle-cat');
            var labelSpan = toggleBtn.find('.btn-toggle-label');
            var icon = toggleBtn.find('i');

            if (catChecked === catTotal && catTotal > 0) {
                labelSpan.text('Batalkan Kategori Ini');
                icon.removeClass('fa-check-square').addClass('fa-square');
            } else {
                labelSpan.text('Pilih Semua di Kategori Ini');
                icon.removeClass('fa-square').addClass('fa-check-square');
            }
        });
    }

    // Toggle highlight class when checkbox changes
    $(document).on('change', '.permission-checkbox', function() {
        var card = $(this).closest('.permission-item-card');
        if ($(this).is(':checked')) {
            card.addClass('is-checked');
        } else {
            card.removeClass('is-checked');
        }
        updateSelectedCounters();
    });

    // Pilih Semua Global
    $('#btnSelectAll').on('click', function() {
        $('.permission-checkbox').each(function() {
            if (!$(this).is(':checked')) {
                $(this).prop('checked', true);
                $(this).closest('.permission-item-card').addClass('is-checked');
            }
        });
        updateSelectedCounters();
    });

    // Batalkan Semua Global
    $('#btnDeselectAll').on('click', function() {
        $('.permission-checkbox').each(function() {
            if ($(this).is(':checked')) {
                $(this).prop('checked', false);
                $(this).closest('.permission-item-card').removeClass('is-checked');
            }
        });
        updateSelectedCounters();
    });

    // Toggle per Kategori
    $(document).on('click', '.btn-toggle-cat', function() {
        var catCard = $(this).closest('.module-category-card');
        var checkboxes = catCard.find('.permission-checkbox');
        var allChecked = checkboxes.length === catCard.find('.permission-checkbox:checked').length;

        checkboxes.each(function() {
            $(this).prop('checked', !allChecked);
            var itemCard = $(this).closest('.permission-item-card');
            if (!allChecked) {
                itemCard.addClass('is-checked');
            } else {
                itemCard.removeClass('is-checked');
            }
        });

        updateSelectedCounters();
    });

    // Live Instant Search
    $('#permissionSearch').on('keyup', function() {
        var query = $(this).val().toLowerCase().trim();
        if (query.length > 0) {
            $('#clearSearchAppend').show();
        } else {
            $('#clearSearchAppend').hide();
        }

        $('.module-category-card').each(function() {
            var catCard = $(this);
            var visibleCount = 0;

            catCard.find('.permission-item-col').each(function() {
                var permName = $(this).data('perm-name');
                if (permName.indexOf(query) !== -1) {
                    $(this).show();
                    visibleCount++;
                } else {
                    $(this).hide();
                }
            });

            if (visibleCount > 0) {
                catCard.show();
            } else {
                catCard.hide();
            }
        });
    });

    // Clear Search Input
    $('#clearSearch').on('click', function() {
        $('#permissionSearch').val('').trigger('keyup');
    });

    updateSelectedCounters();
});
</script>
@endsection
