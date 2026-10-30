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
                    <h1>Data Detail Keluhan & Defect</h1>
                    <p class="page-subtitle">Rincian data integrasi antara departemen asal, defect, dan nomor keluhan</p>
                </div>
            </div>
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                <li class="breadcrumb-item active">Data Detail</li>
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
                    <i class="fas fa-list-alt text-primary mr-1"></i>
                    <span>Tabel Rincian Data</span>
                    <span class="badge badge-light border text-muted ml-2 font-weight-normal">{{ count($result) }} Baris Data</span>
                </div>
                <div>
                    <a href="{{ route('data.grafik') }}" class="btn-modern-secondary btn-sm">
                        <i class="fas fa-chart-pie mr-1"></i>
                        <span>Lihat Grafik</span>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="table table-modern table-hover">
                        <thead>
                            <tr class="header-titles">
                                <th style="width: 60px;" class="text-center">No</th>
                                <th>Departemen Asal</th>
                                <th>Defect (Masalah)</th>
                                <th>Nomor Keluhan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse($result as $item)
                                <tr>
                                    <td class="text-center text-muted font-weight-bold">{{ $no++ }}</td>
                                    <td>
                                        <span class="badge-kategori-general">
                                            <i class="fas fa-sitemap fa-xs mr-1"></i>
                                            {{ $item->departements['asal_masalah'] ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong class="text-dark">
                                            <i class="fas fa-exclamation-circle text-warning mr-1"></i>
                                            {{ $item->defect['nama'] ?? '-' }}
                                        </strong>
                                    </td>
                                    <td>
                                        <span class="badge-code text-primary">
                                            <i class="fas fa-file-invoice mr-1 text-muted"></i>
                                            {{ $item->complaint['nomer_keluhan'] ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 text-secondary opacity-50 d-block"></i>
                                        <p class="mb-0">Belum ada data detail yang tercatat.</p>
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
<style>
    .modern-filter-input {
        width: 100%;
        padding: 0.35rem 0.65rem;
        font-size: 0.8rem;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        background-color: #ffffff;
        color: #334155;
        transition: all 0.2s ease;
    }
    .modern-filter-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        outline: none;
    }
</style>
<script>
    $(document).ready(function() {
        // Clone header for column search
        $('#mytable thead tr.header-titles').clone(true).addClass('filters-row').appendTo('#mytable thead');
        
        $('#mytable thead tr.filters-row th').each(function(i) {
            var title = $(this).text().trim();
            if (i === 0) {
                $(this).html('');
            } else {
                $(this).html('<input type="text" class="modern-filter-input" placeholder="Cari ' + title + '..." />');
                
                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table.column(i).search(this.value).draw();
                    }
                });
            }
        });

        var table = $('#mytable').DataTable({
            orderCellsTop: true,
            responsive: true,
            autoWidth: false,
            language: {
                search: "Pencarian Cepat:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    previous: "<i class='fas fa-angle-left'></i>",
                    next: "<i class='fas fa-angle-right'></i>"
                }
            },
            dom: '<"d-flex flex-wrap justify-content-between align-items-center mb-3"Bf>rt<"d-flex flex-wrap justify-content-between align-items-center mt-3"ip>',
            buttons: [
                { extend: 'copy', className: 'btn btn-sm btn-outline-secondary' },
                { extend: 'excel', className: 'btn btn-sm btn-outline-success' },
                { extend: 'csv', className: 'btn btn-sm btn-outline-info' },
                { extend: 'pdfHtml5', className: 'btn btn-sm btn-outline-danger', orientation: 'landscape', pageSize: 'A4' },
                { extend: 'print', className: 'btn btn-sm btn-outline-primary' },
                { extend: 'colvis', className: 'btn btn-sm btn-outline-dark' }
            ]
        });
    });
</script>
@endsection
