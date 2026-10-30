@extends('layouts.app')

@section('content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="page-header-box">
            <div class="page-title-box">
                <div class="page-title-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div>
                    <h1>Grafik Analitik per Pelanggan (Buyer)</h1>
                    <p class="page-subtitle">Analisis tren dan penyebab komplain spesifik berdasarkan pelanggan atau rentang waktu</p>
                </div>
            </div>
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                <li class="breadcrumb-item active">Grafik Buyer</li>
            </ol>
        </div>

        @include('components.alert')
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Filter Card -->
        <div class="card card-modern mb-4">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-filter text-primary mr-1"></i>
                    <span>Filter Pelanggan & Rentang Waktu</span>
                </div>
                <a href="{{ route('data.grafik.buyer') }}" class="btn btn-sm btn-light border text-muted">
                    <i class="fas fa-sync-alt mr-1"></i> Reset Filter
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('data.search.buyer') }}" method="POST" class="form-modern">
                    @csrf
                    <div class="row">
                        <!-- Tahun -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <label for="tahun" class="font-weight-bold">
                                <i class="far fa-calendar-alt text-primary mr-1"></i> Tahun <small class="text-muted font-weight-normal">(Opsional)</small>
                            </label>
                            <input type="number" id="tahun" name="tahun" min="2000" max="2099"
                                class="form-control"
                                value="{{ $tahun ?? old('tahun') }}"
                                placeholder="Contoh: {{ date('Y') }}">
                        </div>

                        <!-- Tanggal Mulai -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <label for="tanggal_mulai" class="font-weight-bold">
                                <i class="far fa-calendar text-info mr-1"></i> Tanggal Mulai
                            </label>
                            <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                                value="{{ old('tanggal_mulai', $tanggalMulai ?? '') }}">
                        </div>

                        <!-- Tanggal Akhir -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <label for="tanggal_akhir" class="font-weight-bold">
                                <i class="far fa-calendar-check text-info mr-1"></i> Tanggal Akhir
                            </label>
                            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                                value="{{ old('tanggal_akhir', $tanggalAkhir ?? '') }}">
                        </div>

                        <!-- Kategori Keluhan -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <label for="kategori" class="font-weight-bold">
                                <i class="fas fa-tag text-primary mr-1"></i> Kategori Keluhan
                            </label>
                            <select id="kategori" name="kategori" class="form-control select2">
                                <option value="Semua" {{ (isset($kategori) && $kategori == 'Semua') ? 'selected' : '' }}>Semua Kategori</option>
                                <option value="eksternal" {{ (isset($kategori) && $kategori == 'eksternal') ? 'selected' : '' }}>Eksternal</option>
                                <option value="internal" {{ (isset($kategori) && $kategori == 'internal') ? 'selected' : '' }}>Internal</option>
                            </select>
                        </div>

                        <!-- Pelanggan / Buyer -->
                        <div class="col-lg-9 col-md-8 mb-3 mb-md-0">
                            <label for="buyer" class="font-weight-bold">
                                <i class="fas fa-building text-primary mr-1"></i> Pilih Pelanggan (Buyer)
                            </label>
                            <select id="buyer" name="buyer" class="form-control select2">
                                <option value="">-- Semua Pelanggan --</option>
                                @foreach($buyer as $b)
                                    <option value="{{ $b->id }}" {{ (isset($selectedBuyer) && $selectedBuyer->id == $b->id) ? 'selected' : '' }}>
                                        [{{ $b->kode_buyer }}] {{ $b->nama_buyer }} ({{ ucfirst($b->kategori_buyer) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tombol Cari -->
                        <div class="col-lg-3 col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn-modern-primary w-100 justify-content-center py-2">
                                <i class="fas fa-search"></i>
                                <span>Filter Grafik</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if(isset($labels) && isset($values) && count($values) > 0)
            @php
                $totalKeluhan = $values->sum();
                $topDefect = $labels->first() ?? 'Tidak ada data';
                $topDefectCount = $values->first() ?? 0;
            @endphp

            <!-- Selected Buyer Detail Card (If filtered by specific buyer) -->
            @if(isset($selectedBuyer))
                <div class="card card-modern mb-4 border-primary">
                    <div class="card-body p-3">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle mr-3 d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px; background: #eff6ff; color: #2563eb;">
                                    <i class="fas fa-building fa-lg"></i>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="mb-0 font-weight-bold text-dark">{{ $selectedBuyer->nama_buyer }}</h5>
                                        <span class="badge-code ml-2">{{ $selectedBuyer->kode_buyer }}</span>
                                    </div>
                                    <small class="text-muted">
                                        <i class="far fa-user mr-1"></i> PIC: {{ $selectedBuyer->cp_buyer ?: '-' }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-phone-alt fa-xs mr-1"></i> {{ $selectedBuyer->telp_buyer ?: '-' }}
                                    </small>
                                </div>
                            </div>
                            <div class="mt-2 mt-md-0">
                                @if(strtolower($selectedBuyer->kategori_buyer) == 'eksternal')
                                    <span class="badge-kategori-ext"><i class="fas fa-globe-americas"></i> Eksternal</span>
                                @else
                                    <span class="badge-kategori-int"><i class="fas fa-industry"></i> Internal</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- KPI Metric Stats Row -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                    <div class="card card-modern h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle p-3 mr-3 d-flex align-items-center justify-content-center"
                                style="width: 52px; height: 52px; background: #eff6ff; color: #2563eb;">
                                <i class="fas fa-chart-pie fa-lg"></i>
                            </div>
                            <div>
                                <small class="text-muted font-weight-bold text-uppercase d-block">Total Kasus Keluhan</small>
                                <h3 class="mb-0 font-weight-bold text-dark">{{ $totalKeluhan }}</h3>
                                <small class="text-muted">Periode Terpilih</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                    <div class="card card-modern h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle p-3 mr-3 d-flex align-items-center justify-content-center"
                                style="width: 52px; height: 52px; background: #fef2f2; color: #dc2626;">
                                <i class="fas fa-exclamation-triangle fa-lg"></i>
                            </div>
                            <div>
                                <small class="text-muted font-weight-bold text-uppercase d-block">Defect Paling Sering</small>
                                <h5 class="mb-0 font-weight-bold text-dark text-truncate" style="max-width: 200px;" title="{{ $topDefect }}">
                                    {{ $topDefect }}
                                </h5>
                                <small class="text-danger font-weight-bold">{{ $topDefectCount }} Kasus</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12">
                    <div class="card card-modern h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted font-weight-bold text-uppercase d-block">Parameter Filter</small>
                                <div class="mt-1">
                                    @if(!empty($tahun))
                                        <span class="badge-code mr-1">Thn {{ $tahun }}</span>
                                    @endif
                                    @if(!empty($tanggalMulai) && !empty($tanggalAkhir))
                                        <span class="badge badge-light border text-muted mr-1 font-weight-normal">
                                            {{ $tanggalMulai }} s/d {{ $tanggalAkhir }}
                                        </span>
                                    @endif
                                    @if(strtolower($kategori) == 'eksternal')
                                        <span class="badge-kategori-ext">Eksternal</span>
                                    @elseif(strtolower($kategori) == 'internal')
                                        <span class="badge-kategori-int">Internal</span>
                                    @else
                                        <span class="badge-kategori-general">Semua Kategori</span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('buyer.index') }}" class="btn-modern-secondary btn-sm text-nowrap">
                                <i class="fas fa-users mr-1"></i> Data Buyer
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row">
                <!-- Line Chart: Tren Bulanan -->
                <div class="col-lg-6 mb-4">
                    <div class="card card-modern h-100">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-chart-line text-info mr-1"></i>
                                <span>Tren Keluhan Bulanan</span>
                            </div>
                            <span class="badge badge-light border text-muted">
                                {{ isset($selectedBuyer) ? $selectedBuyer->nama_buyer : 'Semua Pelanggan' }}
                            </span>
                        </div>
                        <div class="card-body">
                            <div style="position: relative; height: 320px;">
                                <canvas id="grafikBulanan"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bar Chart: Penyebab Masalah -->
                <div class="col-lg-6 mb-4">
                    <div class="card card-modern h-100">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-chart-bar text-primary mr-1"></i>
                                <span>Ranking Penyebab Masalah (Defect)</span>
                            </div>
                            <span class="badge badge-light border text-muted">{{ count($labels) }} Jenis Defect</span>
                        </div>
                        <div class="card-body">
                            <div style="position: relative; height: 320px;">
                                <canvas id="grafikPenjualan"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State / Guidance Card -->
            <div class="card card-modern">
                <div class="card-body text-center py-5">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                            style="width: 80px; height: 80px; background: #eff6ff; color: #2563eb;">
                            <i class="fas fa-user-tag fa-3x"></i>
                        </div>
                    </div>
                    <h4 class="font-weight-bold text-dark">Pilih Pelanggan atau Periode Waktu</h4>
                    <p class="text-muted mx-auto" style="max-width: 480px;">
                        Gunakan panel filter di atas untuk memilih nama <strong>Pelanggan (Buyer)</strong>, <strong>Tahun</strong>, atau <strong>Rentang Tanggal</strong>, lalu klik <strong>Filter Grafik</strong> untuk memvisualisasikan data.
                    </p>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@section('tablejs')
<script>
    $(document).ready(function() {
        $('#buyer').select2({
            placeholder: "-- Pilih Pelanggan (Buyer) --",
            allowClear: true,
            width: '100%'
        });
        $('#kategori').select2({
            allowClear: false,
            width: '100%'
        });
    });
</script>

@if(isset($labels) && isset($values) && count($values) > 0)
<script>
document.addEventListener('DOMContentLoaded', function () {
    var labelSuffix = '';
    @if(isset($tahun) && !empty($tahun))
        labelSuffix = 'Tahun ' + @json($tahun);
    @elseif(isset($tanggalMulai) && isset($tanggalAkhir) && !empty($tanggalMulai) && !empty($tanggalAkhir))
        labelSuffix = @json($tanggalMulai) + ' s/d ' + @json($tanggalAkhir);
    @endif

    // 1. Grafik Bulanan (Line Chart)
    @if(isset($bulanLabels) && isset($bulanValues))
    var ctxBulanan = document.getElementById('grafikBulanan').getContext('2d');
    var gradientBulanan = ctxBulanan.createLinearGradient(0, 0, 0, 300);
    gradientBulanan.addColorStop(0, 'rgba(236, 72, 153, 0.35)');
    gradientBulanan.addColorStop(1, 'rgba(236, 72, 153, 0.0)');

    new Chart(ctxBulanan, {
        type: 'line',
        data: {
            labels: @json($bulanLabels),
            datasets: [{
                label: 'Jumlah Keluhan ' + labelSuffix,
                data: @json($bulanValues),
                backgroundColor: gradientBulanan,
                borderColor: '#ec4899',
                borderWidth: 2.5,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#ec4899',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                lineTension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: 'top',
                labels: { boxWidth: 12, fontColor: '#64748b', fontSize: 12 }
            },
            scales: {
                xAxes: [{
                    gridLines: { display: false },
                    ticks: { fontColor: '#64748b' }
                }],
                yAxes: [{
                    gridLines: { color: 'rgba(226, 232, 240, 0.8)', zeroLineColor: '#cbd5e1' },
                    ticks: {
                        beginAtZero: true,
                        precision: 0,
                        fontColor: '#64748b'
                    }
                }]
            },
            tooltips: {
                backgroundColor: '#1e293b',
                titleFontSize: 13,
                bodyFontSize: 12,
                cornerRadius: 8,
                xPadding: 12,
                yPadding: 10
            }
        }
    });
    @endif

    // 2. Grafik Defect (Bar Chart)
    var ctxDefect = document.getElementById('grafikPenjualan').getContext('2d');
    new Chart(ctxDefect, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Total Kasus Defect',
                data: @json($values),
                backgroundColor: [
                    '#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6',
                    '#06b6d4', '#ec4899', '#6366f1', '#14b8a6', '#f97316'
                ],
                borderWidth: 0,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: { display: false },
                    ticks: {
                        fontColor: '#64748b',
                        callback: function(value) {
                            return value.length > 14 ? value.substr(0, 14) + '...' : value;
                        }
                    }
                }],
                yAxes: [{
                    gridLines: { color: 'rgba(226, 232, 240, 0.8)', zeroLineColor: '#cbd5e1' },
                    ticks: {
                        beginAtZero: true,
                        precision: 0,
                        fontColor: '#64748b'
                    }
                }]
            },
            tooltips: {
                backgroundColor: '#1e293b',
                titleFontSize: 13,
                bodyFontSize: 12,
                cornerRadius: 8,
                xPadding: 12,
                yPadding: 10
            }
        }
    });
});
</script>
@endif
@endsection
