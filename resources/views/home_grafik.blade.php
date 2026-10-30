@extends('layouts.app')

@section('content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="page-header-box">
            <div class="page-title-box">
                <div class="page-title-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div>
                    <h1>Grafik Analitik Keluhan</h1>
                    <p class="page-subtitle">Visualisasi tren keluhan bulanan & distribusi penyebab masalah (defect)</p>
                </div>
            </div>
            <ol class="breadcrumb breadcrumb-modern">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Home</a></li>
                <li class="breadcrumb-item active">Data Grafik</li>
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
                    <span>Filter Periode & Kategori Keluhan</span>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('data.search') }}" method="POST" class="form-modern">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col-md-4 col-sm-6 mb-3 mb-md-0">
                            <label for="tahun" class="font-weight-bold">
                                <i class="far fa-calendar-alt text-primary mr-1"></i> Tahun <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" id="tahun" name="tahun" min="2000" max="2099"
                                    class="form-control" required
                                    value="{{ $tahun ?? old('tahun', date('Y')) }}"
                                    placeholder="Contoh: {{ date('Y') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-light"><i class="fas fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 col-sm-6 mb-3 mb-md-0">
                            <label for="kategori" class="font-weight-bold">
                                <i class="fas fa-tag text-primary mr-1"></i> Kategori Keluhan <span class="text-danger">*</span>
                            </label>
                            <select id="kategori" name="kategori" class="form-control">
                                <option value="Semua" {{ (isset($kategori) && $kategori == 'Semua') ? 'selected' : '' }}>
                                    Semua Kategori (Internal & Eksternal)
                                </option>
                                <option value="eksternal" {{ (isset($kategori) && $kategori == 'eksternal') ? 'selected' : '' }}>
                                    Eksternal (Dari Pelanggan)
                                </option>
                                <option value="internal" {{ (isset($kategori) && $kategori == 'internal') ? 'selected' : '' }}>
                                    Internal (Antar Departemen)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <button type="submit" class="btn-modern-primary w-100 justify-content-center py-2">
                                <i class="fas fa-search"></i>
                                <span>Tampilkan Grafik</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if(isset($labels) && isset($values) && isset($tahun))
            @php
                $totalKeluhan = $values->sum();
                $topDefect = $labels->first() ?? 'Tidak ada data';
                $topDefectCount = $values->first() ?? 0;
            @endphp

            <!-- KPI Metric Stats Row -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                    <div class="card card-modern h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-primary-subtle p-3 mr-3 d-flex align-items-center justify-content-center"
                                style="width: 54px; height: 54px; background: #eff6ff; color: #2563eb;">
                                <i class="fas fa-clipboard-list fa-lg"></i>
                            </div>
                            <div>
                                <small class="text-muted font-weight-bold text-uppercase d-block">Total Keluhan</small>
                                <h3 class="mb-0 font-weight-bold text-dark">{{ $totalKeluhan }}</h3>
                                <small class="text-primary font-weight-bold">Tahun {{ $tahun }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                    <div class="card card-modern h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle p-3 mr-3 d-flex align-items-center justify-content-center"
                                style="width: 54px; height: 54px; background: #fef2f2; color: #dc2626;">
                                <i class="fas fa-exclamation-triangle fa-lg"></i>
                            </div>
                            <div>
                                <small class="text-muted font-weight-bold text-uppercase d-block">Penyebab Tertinggi</small>
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
                                <small class="text-muted font-weight-bold text-uppercase d-block">Filter Aktif</small>
                                <div class="mt-1">
                                    <span class="badge-code mr-1">Tahun {{ $tahun }}</span>
                                    @if(strtolower($kategori) == 'eksternal')
                                        <span class="badge-kategori-ext"><i class="fas fa-globe-americas"></i> Eksternal</span>
                                    @elseif(strtolower($kategori) == 'internal')
                                        <span class="badge-kategori-int"><i class="fas fa-industry"></i> Internal</span>
                                    @else
                                        <span class="badge-kategori-general"><i class="fas fa-layer-group"></i> Semua Kategori</span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('data.detail') }}" class="btn-modern-secondary btn-sm text-nowrap">
                                <i class="fas fa-table mr-1"></i> Data Detail
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
                            <span class="badge badge-light border text-muted">Tahun {{ $tahun }}</span>
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
                            <i class="fas fa-chart-pie fa-3x"></i>
                        </div>
                    </div>
                    <h4 class="font-weight-bold text-dark">Pilih Periode untuk Melihat Grafik</h4>
                    <p class="text-muted mx-auto" style="max-width: 480px;">
                        Tentukan <strong>Tahun</strong> dan <strong>Kategori Keluhan</strong> pada panel pencarian di atas, kemudian klik tombol <strong>Tampilkan Grafik</strong> untuk menganalisis tren data.
                    </p>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@if(isset($labels) && isset($values) && isset($tahun))
@section('tablejs')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Grafik Bulanan (Line Chart)
    @if(isset($bulanLabels) && isset($bulanValues))
    var ctxBulanan = document.getElementById('grafikBulanan').getContext('2d');
    var gradientBulanan = ctxBulanan.createLinearGradient(0, 0, 0, 300);
    gradientBulanan.addColorStop(0, 'rgba(59, 130, 246, 0.35)');
    gradientBulanan.addColorStop(1, 'rgba(59, 130, 246, 0.0)');

    new Chart(ctxBulanan, {
        type: 'line',
        data: {
            labels: @json($bulanLabels),
            datasets: [{
                label: 'Jumlah Keluhan Tahun ' + @json($tahun),
                data: @json($bulanValues),
                backgroundColor: gradientBulanan,
                borderColor: '#2563eb',
                borderWidth: 2.5,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#2563eb',
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
@endsection
@endif
