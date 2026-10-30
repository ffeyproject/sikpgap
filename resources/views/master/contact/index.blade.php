@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="page-header-box">
            <div class="page-title-box">
                <div class="page-title-icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div>
                    <h1>Pesan Masuk (Contact)</h1>
                    <p class="page-subtitle">Daftar feedback dan pesan masuk dari pelanggan atau pengguna</p>
                </div>
            </div>
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                <li class="breadcrumb-item active">Pesan</li>
            </ol>
        </div>

        @include('components.alert')
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-modern">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-inbox text-primary mr-1"></i>
                    <span>Daftar Pesan Masuk</span>
                    <span class="badge badge-light border text-muted ml-2 font-weight-normal">{{ count($contact) }} Pesan</span>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="t_contact" class="table table-modern table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th style="width: 140px;">Kode Contact</th>
                                <th>Pengirim</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 150px;">Tanggal Masuk</th>
                                <th style="width: 80px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($contact as $item)
                                <tr>
                                    <td class="text-center text-muted font-weight-bold">{{ $no++ }}</td>
                                    <td>
                                        <span class="badge-code">{{ $item->kode_contact }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $item->user ? $item->user->name : '-' }}</strong>
                                    </td>
                                    <td>
                                        @if($item->user && $item->user->email)
                                            <a href="mailto:{{ $item->user->email }}" class="text-primary">{{ $item->user->email }}</a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-dark small" style="max-height: 70px; overflow-y: auto;">
                                            {{ $item->message }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light border">{{ $item->status ?: 'Terkirim' }}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ $item->created_at ? $item->created_at->format('d M Y H:i') : '-' }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('pesan.destroy', $item->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-icon btn-action-delete"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')"
                                                title="Hapus Pesan">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-envelope-open fa-3x mb-3 text-secondary opacity-50 d-block"></i>
                                        <p class="mb-0">Belum ada pesan masuk.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('tablejs')
<script>
    $(function () {
        $("#t_contact").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "paginate": {
                    "previous": "<i class='fas fa-angle-left'></i>",
                    "next": "<i class='fas fa-angle-right'></i>"
                }
            },
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#t_contact_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
