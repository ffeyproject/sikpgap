@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="page-header-box">
            <div class="page-title-box">
                <div class="page-title-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <div>
                    <h1>Master Index Penilaian</h1>
                    <p class="page-subtitle">Kelola poin kriteria dan parameter indeks survei kepuasan pelanggan</p>
                </div>
            </div>
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                <li class="breadcrumb-item active">Index Penilaian</li>
            </ol>
        </div>

        @include('components.alert')
        @include('sweetalert::alert')
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-modern">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-list-ul text-primary mr-1"></i>
                    <span>Daftar Parameter Penilaian</span>
                    <span class="badge badge-light border text-muted ml-2 font-weight-normal">{{ count($item) }} Data</span>
                </div>
                <div>
                    <a href="{{ route('item.create') }}" class="btn-modern-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Index Penilaian</span>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="t_barang" class="table table-modern table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th style="width: 150px;">Kode Penilaian</th>
                                <th>Nama Penilaian</th>
                                <th>Keterangan</th>
                                <th style="width: 160px;">Dibuat Oleh</th>
                                <th style="width: 100px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($item as $i_p)
                                <tr>
                                    <td class="text-center text-muted font-weight-bold">{{ $no++ }}</td>
                                    <td>
                                        <span class="badge-code">{{ $i_p->kode_item }}</span>
                                    </td>
                                    <td>
                                        <strong class="text-dark">{{ $i_p->nama_penilaian }}</strong>
                                    </td>
                                    <td>
                                        <div class="text-muted small" style="max-height: 60px; overflow-y: auto;">
                                            {!! $i_p->keterangan ?: '-' !!}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted small">
                                            <i class="far fa-user fa-xs mr-1 text-primary"></i>
                                            {{ $i_p->user ? $i_p->user->name : '-' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="action-btn-group">
                                            <a href="{{ route('item.edit', $i_p->id) }}" class="btn-action-icon btn-action-edit" title="Edit Data">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form action="{{ route('item.destroy', $i_p->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-icon btn-action-delete"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data penilaian {{ $i_p->nama_penilaian }}?')"
                                                    title="Hapus Data">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 text-secondary opacity-50 d-block"></i>
                                        <p class="mb-0">Belum ada data index penilaian yang tersimpan.</p>
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
        $("#t_barang").DataTable({
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
        }).buttons().container().appendTo('#t_barang_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
