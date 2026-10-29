@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-user text-primary mr-2"></i>Detail Pengguna</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Pengguna</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card shadow-sm" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="m-0 font-weight-bold text-dark">Informasi Akun: {{ $user->name }}</h5>
                        <div>
                            @if($user->status)
                                <span class="badge badge-success px-2 py-1 mr-1"><i class="fas fa-check-circle mr-1"></i>Aktif</span>
                            @else
                                <span class="badge badge-danger px-2 py-1 mr-1"><i class="fas fa-ban mr-1"></i>Nonaktif</span>
                            @endif
                            <span class="badge badge-light border px-2 py-1">User ID: #{{ $user->id }}</span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-12 col-sm-4 text-center border-right pr-sm-4 mb-3 mb-sm-0">
                                <div class="mb-3">
                                    <div class="text-muted small mb-1 font-weight-bold">Tanda Tangan Digital (TTD)</div>
                                    @if(!empty($user->g_ttd))
                                        <div class="p-2 border rounded bg-light d-inline-block">
                                            <img src="{{ asset('image/ttd/' . $user->g_ttd) }}?t={{ time() }}" 
                                                 alt="TTD {{ $user->name }}" 
                                                 style="max-height: 100px; max-width: 150px; object-fit: contain;"
                                                 onerror="this.onerror=null; this.parentElement.innerHTML='<span class=\'text-danger small\'>File tidak ditemukan</span>';">
                                        </div>
                                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">{{ $user->g_ttd }}</div>
                                    @else
                                        <div class="p-3 border rounded bg-light text-muted small">
                                            <i class="fas fa-signature fa-2x mb-1 d-block text-secondary"></i>
                                            Belum Ada TTD
                                        </div>
                                    @endif
                                </div>

                                <div class="badge badge-primary px-3 py-2 text-uppercase mb-2">
                                    {{ $user->posisi ?? 'Staff' }}
                                </div>
                            </div>

                            <div class="col-12 col-sm-8 pl-sm-4">
                                <table class="table table-sm table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th style="width: 140px;" class="text-muted">Nama Lengkap</th>
                                            <td class="font-weight-bold text-dark">{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Username</th>
                                            <td><code>{{ $user->username }}</code></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Alamat Email</th>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Posisi / Jabatan</th>
                                            <td><span class="badge badge-info">{{ $user->posisi ?? '-' }}</span></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Status Login</th>
                                            <td>
                                                @if($user->status)
                                                    <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>Aktif (Dapat Login ke Sistem)</span>
                                                @else
                                                    <span class="badge badge-danger px-2 py-1"><i class="fas fa-ban mr-1"></i>Nonaktif (Akses Login Diblokir)</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Hak Akses Role</th>
                                            <td>
                                                @forelse($user->roles as $role)
                                                    <span class="badge badge-success mr-1">{{ $role->name }}</span>
                                                @empty
                                                    <span class="text-muted">-</span>
                                                @endforelse
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light px-4 py-3 d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning font-weight-bold">
                            <i class="fas fa-edit mr-1"></i> Ubah Data & Status Pengguna
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
