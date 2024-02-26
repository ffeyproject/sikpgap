@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container"><br>

        <form action="{{ route('data.search') }}" method="POST">
            @csrf
            <label for="tahun">Tahun:</label>
            <input type="text" id="tahun" name="tahun" required>
            <button type="submit">Cari</button>
        </form>
        @if(isset($labels) && isset($values) && isset($tahun))
        <canvas id="grafikPenjualan"></canvas>
        @else
        <p>Data tidak tersedia atau belum dipilih tahunnya.</p>
        @endif
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
                label: 'Penyebab Masalah ' + @json($tahun),
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

@endsection