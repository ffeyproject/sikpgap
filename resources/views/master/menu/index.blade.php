@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="page-header-box">
            <div class="page-title-box">
                <div class="page-title-icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div>
                    <h1>Master Menu Customer</h1>
                    <p class="page-subtitle">Kelola konfigurasi dan daftar menu tampilan untuk portal customer</p>
                </div>
            </div>
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                <li class="breadcrumb-item active">Menu Customer</li>
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
                    <span>Daftar Menu Customer</span>
                    <span class="badge badge-light border text-muted ml-2 font-weight-normal">{{ count($menuDashboard) }} Data</span>
                </div>
                <div>
                    <a href="{{ route('menu.create') }}" class="btn-modern-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Item Menu</span>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="t_barang" class="table table-modern table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th style="width: 160px;">Kategori Menu</th>
                                <th>Item Menu</th>
                                <th>Keterangan</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 100px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($menuDashboard as $item)
                                <tr>
                                    <td class="text-center text-muted font-weight-bold">{{ $no++ }}</td>
                                    <td>
                                        <span class="badge-kategori-general">
                                            <i class="fas fa-folder fa-xs mr-1"></i>{{ $item->categori_menu }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong class="text-dark">{{ $item->item_menu }}</strong>
                                    </td>
                                    <td>
                                        <div class="text-muted small" style="max-height: 60px; overflow-y: auto;">
                                            {!! $item->ket_menu ?: '-' !!}
                                        </div>
                                    </td>
                                    <td>
                                        @if(strtolower($item->status) == 'active' || $item->status == '1')
                                            <span class="badge badge-success px-2 py-1">Active</span>
                                        @else
                                            <span class="badge badge-secondary px-2 py-1">{{ $item->status ?: 'Inactive' }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="action-btn-group">
                                            <a href="{{ route('menu.edit', $item->id) }}" class="btn-action-icon btn-action-edit" title="Edit Data">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form action="{{ route('menu.destroy', $item->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-icon btn-action-delete"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data menu {{ $item->item_menu }}?')"
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
                                        <p class="mb-0">Belum ada data menu customer yang tersimpan.</p>
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
