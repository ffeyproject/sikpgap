@extends('layouts.app')

@push('page_css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
/* Modern Card & Styling */
.card-user-edit {
    border-radius: 12px;
    border: 1px solid #e3e6f0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    background-color: #ffffff;
}
.form-section-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: #4e73df;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
    padding-bottom: 6px;
    border-bottom: 2px solid #eaecf4;
    display: flex;
    align-items: center;
    gap: 8px;
}
.form-label {
    font-weight: 600;
    color: #333333;
    font-size: 0.88rem;
    margin-bottom: 5px;
}
.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.2);
}
.posisi-card-option {
    border: 2px solid #e3e6f0;
    border-radius: 8px;
    padding: 10px 14px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    margin-bottom: 8px;
}
.posisi-card-option:hover {
    border-color: #4e73df;
    background-color: #f8f9fc;
}
.posisi-card-option input[type="radio"] {
    margin-right: 10px;
    cursor: pointer;
}
.posisi-card-option.active {
    border-color: #4e73df;
    background-color: #eef2ff;
    font-weight: 600;
}
.current-ttd-box {
    border: 2px dashed #d1d3e2;
    border-radius: 8px;
    padding: 12px;
    display: inline-block;
    background: #fafbfc;
    text-align: center;
}
.btn-press-anim {
    transition: transform 0.12s ease, box-shadow 0.15s ease;
}
.btn-press-anim:active {
    transform: scale(0.97);
}
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-7">
                <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.55rem;">
                    <i class="fas fa-user-edit text-primary mr-2"></i>Ubah Data Pengguna
                </h1>
                <p class="text-muted small mb-0 mt-1">
                    Memperbarui identitas, kredensial, jabatan posisi, dan peran (role) untuk pengguna: <strong>{{ $user->name }}</strong>
                </p>
            </div>
            <div class="col-12 col-md-5 text-md-right mt-3 mt-md-0">
                <ol class="breadcrumb bg-transparent p-0 mb-2 justify-content-md-end small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Pengguna</a></li>
                    <li class="breadcrumb-item active text-primary">Ubah Data</li>
                </ol>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm" style="border-radius: 6px;">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Pengguna
                </a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        
        <!-- Notifikasi Banner Lengkap Jika Terjadi Error / Validasi Gagal -->
        @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert" style="border-radius: 12px; border-left: 5px solid #dc3545;">
            <div class="d-flex align-items-start">
                <div class="mr-3 mt-1">
                    <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="alert-heading font-weight-bold mb-1">
                        Pembaruan Data Gagal Disimpan!
                    </h5>
                    <p class="mb-2 small">
                        Ditemukan <strong>{{ $errors->count() }} kesalahan input</strong> yang perlu diperbaiki sebelum data dapat disimpan:
                    </p>
                    <ul class="mb-0 pl-3 small font-weight-bold">
                        @foreach ($errors->all() as $error)
                            <li class="mb-1">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert" style="border-radius: 12px; border-left: 5px solid #dc3545;">
            <div class="d-flex align-items-center">
                <i class="fas fa-times-circle fa-2x text-danger mr-3"></i>
                <div>
                    <h6 class="font-weight-bold mb-1">Terjadi Kesalahan Sistem!</h6>
                    <span class="small">{{ session('error') }}</span>
                </div>
                <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert" style="border-radius: 12px; border-left: 5px solid #28a745;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fa-2x text-success mr-3"></i>
                <div>
                    <h6 class="font-weight-bold mb-1">Berhasil!</h6>
                    <span class="small">{{ session('success') }}</span>
                </div>
                <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card card-user-edit mb-4">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="m-0 font-weight-bold text-dark">
                                <i class="fas fa-id-card text-primary mr-2"></i>Formulir Data Akun Pengguna
                            </h5>
                            <small class="text-muted">Periksa dan perbaiki kolom yang bertanda merah jika ada kesalahan</small>
                        </div>
                        <span class="badge badge-light border px-3 py-2 text-muted">
                            User ID: #{{ $user->id }}
                        </span>
                    </div>

                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data" id="formEditUser">
                        @method('PATCH')
                        @csrf

                        <div class="card-body p-4">

                            <!-- Bagian 1: Identitas & Kredensial Akun -->
                            <div class="form-section-title">
                                <i class="fas fa-user-circle"></i> 1. Informasi Identitas & Login
                            </div>

                            <div class="row">
                                <!-- Nama Lengkap -->
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="name" class="form-label">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="fas fa-user text-muted"></i></span>
                                        </div>
                                        <input type="text" id="name" name="name" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name', $user->name) }}" 
                                               placeholder="Contoh: Budi Santoso" required>
                                        @error('name')
                                        <div class="invalid-feedback font-weight-bold">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Username -->
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="username" class="form-label">
                                        Username <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="fas fa-at text-muted"></i></span>
                                        </div>
                                        <input type="text" id="username" name="username" 
                                               class="form-control @error('username') is-invalid @enderror" 
                                               value="{{ old('username', $user->username) }}" 
                                               placeholder="Contoh: budi_s" required>
                                        @error('username')
                                        <div class="invalid-feedback font-weight-bold">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="email" class="form-label">
                                        Alamat Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                                        </div>
                                        <input type="email" id="email" name="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email', $user->email) }}" 
                                               placeholder="Contoh: budi@gajahtex.com" required>
                                        @error('email')
                                        <div class="invalid-feedback font-weight-bold">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Email digunakan untuk login dan notifikasi sistem.</small>
                                </div>

                                <!-- Tanda Tangan Digital -->
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label d-flex justify-content-between align-items-center">
                                        <span>Tanda Tangan Digital (TTD)</span>
                                        <span class="text-muted small" style="font-size: 0.75rem;">Maks. 5 MB (JPG/PNG/WEBP)</span>
                                    </label>
                                    <div class="d-flex align-items-start mb-2">
                                        <!-- Current TTD Box -->
                                        <div class="current-ttd-box mr-3" style="min-width: 120px; min-height: 85px;">
                                            @if(!empty($user->g_ttd))
                                                <img id="imgCurrentTTD" src="{{ asset('image/ttd/' . $user->g_ttd) }}?t={{ time() }}" 
                                                     alt="TTD {{ $user->name }}" 
                                                     style="max-height: 60px; max-width: 120px; object-fit: contain;"
                                                     onerror="this.style.display='none'; document.getElementById('ttdMissingAlert').style.display='block';">
                                                <div id="ttdMissingAlert" style="display:none;" class="text-danger small py-1">
                                                    <i class="fas fa-exclamation-circle"></i> File tidak ada di disk
                                                </div>
                                                <div class="text-muted mt-1" style="font-size: 0.7rem; word-break: break-all;">
                                                    <i class="fas fa-file-image text-primary mr-1"></i>{{ $user->g_ttd }}
                                                </div>
                                            @else
                                                <div class="text-muted py-2" style="font-size: 0.75rem;">
                                                    <i class="fas fa-signature fa-2x mb-1 d-block text-secondary"></i>
                                                    Belum Ada TTD
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="custom-file mb-1">
                                                <input type="file" id="g_ttd" name="g_ttd" 
                                                       class="custom-file-input @error('g_ttd') is-invalid @enderror" 
                                                       accept="image/png, image/jpeg, image/jpg, image/webp, image/svg+xml">
                                                <label class="custom-file-label text-truncate" for="g_ttd" id="g_ttd_label">Pilih file gambar baru...</label>
                                            </div>
                                            <small class="text-muted d-block">
                                                <i class="fas fa-info-circle mr-1"></i>Biarkan kosong jika tidak ingin mengubah tanda tangan.
                                            </small>

                                            <!-- Live Preview Box untuk Gambar yang Baru Dipilih -->
                                            <div id="newTtdPreviewBox" class="mt-2 p-2 border rounded bg-light" style="display:none;">
                                                <div class="d-flex align-items-center">
                                                    <img id="newTtdPreviewImg" src="" alt="Pratinjau Baru" style="max-height: 50px; max-width: 90px; object-fit: contain; background: #fff; border: 1px solid #ddd; border-radius: 4px; padding: 2px;" class="mr-2">
                                                    <div class="small">
                                                        <strong class="text-success d-block"><i class="fas fa-arrow-circle-up mr-1"></i>Akan Diunggah:</strong>
                                                        <span id="newTtdFileName" class="text-dark font-weight-bold"></span> 
                                                        <span id="newTtdFileSize" class="badge badge-info ml-1"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            @error('g_ttd')
                                            <div class="text-danger small font-weight-bold mt-1">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bagian 2: Posisi / Jabatan Pengguna -->
                            <div class="form-section-title mt-4">
                                <i class="fas fa-briefcase"></i> 2. Posisi / Jabatan
                            </div>

                            <p class="small text-muted mb-2">Pilih salah satu posisi atau hak wewenang departemen pengguna di dalam sistem:</p>
                            @php
                                $currentPosisi = old('posisi', $user->posisi);
                                $posisiList = [
                                    'marketing' => ['label' => 'Marketing', 'icon' => 'fas fa-bullhorn text-primary', 'desc' => 'Divisi Pemasaran & Penjualan'],
                                    'kabagqa' => ['label' => 'Kabag QA', 'icon' => 'fas fa-user-shield text-info', 'desc' => 'Kepala Bagian Quality Assurance'],
                                    'qa' => ['label' => 'QA', 'icon' => 'fas fa-tasks text-success', 'desc' => 'Staff Quality Assurance / Investigasi Keluhan'],
                                    'Admin' => ['label' => 'Admin', 'icon' => 'fas fa-crown text-danger', 'desc' => 'Administrator Sistem & Manajemen Master Data'],
                                    'user' => ['label' => 'User / Buyer', 'icon' => 'fas fa-user text-secondary', 'desc' => 'Pengguna Umum / Pelanggan (Buyer)']
                                ];
                            @endphp

                            <div class="row mb-3">
                                @foreach ($posisiList as $key => $pos)
                                <div class="col-12 col-sm-6 col-md-4 mb-2">
                                    <label class="posisi-card-option w-100 {{ $currentPosisi == $key ? 'active' : '' }}">
                                        <input type="radio" name="posisi" value="{{ $key }}" {{ $currentPosisi == $key ? 'checked' : '' }} required>
                                        <div>
                                            <div class="font-weight-bold text-dark">
                                                <i class="{{ $pos['icon'] }} mr-1"></i>{{ $pos['label'] }}
                                            </div>
                                            <small class="text-muted">{{ $pos['desc'] }}</small>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @error('posisi')
                            <div class="alert alert-danger py-2 px-3 small font-weight-bold mb-3">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror

                            <!-- Bagian 3: Penugasan Peran (Roles) -->
                            <div class="form-section-title mt-4">
                                <i class="fas fa-shield-alt"></i> 3. Hak Akses Peran (Roles)
                            </div>

                            <p class="small text-muted mb-2">Centang peran (role) yang diberikan untuk pengguna ini:</p>

                            <div class="table-responsive border rounded mb-3">
                                <table class="table table-hover table-striped mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 50px;" class="text-center">
                                                <input type="checkbox" id="check_all_roles" name="all_permission" title="Pilih Semua Role">
                                            </th>
                                            <th>Nama Peran (Role Name)</th>
                                            <th>Keterangan Hak Akses</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $role)
                                        @php
                                            $hasRole = in_array($role->name, (array)old('role', $userRole)) || in_array($role->id, (array)old('role', $userRole));
                                        @endphp
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="role[{{ $role->id }}]" value="{{ $role->name }}" 
                                                       class="role-checkbox" id="role_{{ $role->id }}"
                                                       {{ $hasRole ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <label for="role_{{ $role->id }}" class="mb-0 font-weight-bold text-dark" style="cursor: pointer;">
                                                    <i class="fas fa-key text-warning mr-1"></i>{{ $role->name }}
                                                </label>
                                            </td>
                                            <td class="text-muted small">
                                                Izin akses modul dan permission terdaftar untuk grup <strong>{{ $role->name }}</strong>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <!-- Card Footer Action Buttons -->
                        <div class="card-footer bg-light px-4 py-3 d-flex align-items-center justify-content-between border-top">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary px-4 font-weight-bold btn-press-anim" style="border-radius: 6px;">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-4 font-weight-bold shadow-sm btn-press-anim" id="btnSubmitUser" style="border-radius: 6px;">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('tablejs')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Toggle Check All Roles
        $('#check_all_roles').on('change', function() {
            var isChecked = $(this).is(':checked');
            $('.role-checkbox').prop('checked', isChecked);
        });

        // Toggle active style on radio cards
        $('input[type="radio"][name="posisi"]').on('change', function() {
            $('.posisi-card-option').removeClass('active');
            $(this).closest('.posisi-card-option').addClass('active');
        });

        // Update label and live preview when a file is selected
        $('#g_ttd').on('change', function(e) {
            var file = this.files[0];
            if (file) {
                $('#g_ttd_label').text(file.name);
                var sizeKb = (file.size / 1024).toFixed(1);
                var sizeText = sizeKb > 1024 ? (sizeKb / 1024).toFixed(2) + ' MB' : sizeKb + ' KB';
                $('#newTtdFileName').text(file.name);
                $('#newTtdFileSize').text(sizeText);

                if (file.size > 5 * 1024 * 1024) {
                    $('#newTtdFileSize').removeClass('badge-info').addClass('badge-danger').text(sizeText + ' (Melebihi 5MB!)');
                } else {
                    $('#newTtdFileSize').removeClass('badge-danger').addClass('badge-info');
                }

                var reader = new FileReader();
                reader.onload = function(evt) {
                    $('#newTtdPreviewImg').attr('src', evt.target.result);
                    $('#newTtdPreviewBox').slideDown(150);
                };
                reader.readAsDataURL(file);
            } else {
                $('#g_ttd_label').text('Pilih file gambar baru...');
                $('#newTtdPreviewBox').slideUp(150);
            }
        });

        // Submit button loading animation - prevent double click without interrupting multipart stream
        $('#formEditUser').on('submit', function() {
            var $btn = $('#btnSubmitUser');
            $btn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan Perubahan...');
            $btn.css('pointer-events', 'none').addClass('disabled');
        });

        // Tampilkan Notifikasi SweetAlert2 jika ada error validasi
        @if (isset($errors) && $errors->any())
            var errorListHtml = '<ul class="text-left mb-0 pl-3 small font-weight-bold text-danger">';
            @foreach ($errors->all() as $err)
                errorListHtml += '<li>{{ addslashes($err) }}</li>';
            @endforeach
            errorListHtml += '</ul>';

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Pembaruan Data Gagal!',
                    html: '<p class="mb-2">Silakan periksa kolom-kolom yang ditandai merah di bawah:</p>' + errorListHtml,
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: '<i class="fas fa-check mr-1"></i> Mengerti, Saya Perbaiki'
                });
            }
        @endif
    });
</script>
@endsection
