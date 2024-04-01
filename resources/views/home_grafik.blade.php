@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container"><br>

        <form action="{{ route('data.search') }}" method="POST">
            @csrf
            <label for="tahun">Tahun:</label>
            <input type="text" id="tahun" name="tahun" required value="{{ $tahun ?? old('tahun') }}">
            <label for="kategori">Kategori Keluhan :</label>
            <select id="kategori" name="kategori">
                <option value="Semua" {{ (isset($kategori) && $kategori=='Semua' ) ? 'selected' : '' }}>Semua</option>
                <option value="eksternal" {{ (isset($kategori) && $kategori=='eksternal' ) ? 'selected' : '' }}>
                    Eksternal</option>
                <option value="internal" {{ (isset($kategori) && $kategori=='internal' ) ? 'selected' : '' }}>Internal
                </option>
            </select>
            <button type="submit">Cari</button>
        </form><br>
        @if(isset($labels) && isset($values) && isset($tahun))
        <canvas id="grafikBulanan"></canvas>
        <hr>
        @else
        <p>Data tidak tersedia atau belum dipilih tahunnya.</p>
        @endif
        <canvas id="grafikPenjualan"></canvas>


    </div>
</div>

@if(isset($labels) && isset($values) && isset($tahun))
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('grafikPenjualan').getContext('2d');
    var grafikPenjualan = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Penyebab Masalah ' + @json($kategori) + ' ' + @json ($tahun),
                data: @json($values),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
});
</script>
@endif

@if(isset($bulanLabels) && isset($bulanValues) && isset($tahun))
<script>
    // Pastikan script ini ada di dalam event DOMContentLoaded atau setelahnya
    var ctxBulanan = document.getElementById('grafikBulanan').getContext('2d');
    var grafikBulanan = new Chart(ctxBulanan, {
        type: 'line',
        data: {
            labels: @json($bulanLabels),
            datasets: [{
                label: 'Jumlah Keluhan per Bulan, Tahun ' + @json($tahun),
                data: @json($bulanValues),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endif

@endsection