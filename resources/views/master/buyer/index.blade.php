@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="page-header-box">
            <div class="page-title-box">
                <div class="page-title-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div>
                    <h1>Master Pelanggan</h1>
                    <p class="page-subtitle">Kelola informasi pelanggan internal & eksternal perusahaan</p>
                </div>
            </div>
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                <li class="breadcrumb-item active">Pelanggan</li>
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
                    <span>Daftar Pelanggan</span>
                    <span class="badge badge-light border text-muted ml-2 font-weight-normal">{{ count($buyer) }} Data</span>
                </div>
                <div>
                    <a href="{{ route('buyer.create') }}" class="btn-modern-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Pelanggan</span>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="t_barang" class="table table-modern table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th>Kode</th>
                                <th>Nama Pelanggan</th>
                                <th>Kategori</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Contact Person</th>
                                <th>Email</th>
                                <th style="width: 100px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($buyer as $item)
                                <tr>
                                    <td class="text-center text-muted font-weight-bold">{{ $no++ }}</td>
                                    <td>
                                        <span class="badge-code">{{ $item->kode_buyer }}</span>
                                    </td>
                                    <td>
                                        <strong class="text-dark">{{ $item->nama_buyer }}</strong>
                                    </td>
                                    <td>
                                        @if (strtolower($item->kategori_buyer) == 'eksternal')
                                            <span class="badge-kategori-ext">
                                                <i class="fas fa-globe-americas"></i> Eksternal
                                            </span>
                                        @else
                                            <span class="badge-kategori-int">
                                                <i class="fas fa-industry"></i> Internal
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $item->alamat_buyer ?: '-' }}</td>
                                    <td>
                                        @if($item->telp_buyer)
                                            <span class="text-nowrap"><i class="fas fa-phone-alt fa-xs text-muted mr-1"></i>{{ $item->telp_buyer }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->cp_buyer)
                                            <span><i class="far fa-user fa-xs text-muted mr-1"></i>{{ $item->cp_buyer }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->email_buyer)
                                            <a href="mailto:{{ $item->email_buyer }}" class="text-primary">{{ $item->email_buyer }}</a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="action-btn-group">
                                            <a href="{{ route('buyer.edit', $item->id) }}" class="btn-action-icon btn-action-edit" title="Edit Data">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form action="{{ route('buyer.destroy', $item->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-icon btn-action-delete"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan {{ $item->nama_buyer }}?')"
                                                    title="Hapus Data">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 text-secondary opacity-50 d-block"></i>
                                        <p class="mb-0">Belum ada data pelanggan yang tersimpan.</p>
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
