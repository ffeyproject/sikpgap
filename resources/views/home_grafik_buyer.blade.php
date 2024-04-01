@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container"><br>

        <form action="{{ route('data.search.buyer') }}" method="POST">
            @csrf
            <label for="tahun">Tahun (Opsional):</label>
            <input type="text" id="tahun" name="tahun" value="{{ $tahun ?? old('tahun') }}">

            <label for="tanggal_mulai">Tanggal Mulai:</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                value="{{ old('tanggal_mulai', $tanggalMulai ?? '') }}">

            <label for="tanggal_akhir">Tanggal Akhir:</label>
            <input type="date" id="tanggal_akhir" name="tanggal_akhir"
                value="{{ old('tanggal_akhir', $tanggalAkhir ?? '') }}">

            <label for="kategori">Kategori Keluhan :</label>
            <select id="kategori" name="kategori" class="select2">
                <option value="Semua" {{ (isset($kategori) && $kategori=='Semua' ) ? 'selected' : '' }}>Semua</option>
                <option value="eksternal" {{ (isset($kategori) && $kategori=='eksternal' ) ? 'selected' : '' }}>
                    Eksternal</option>
                <option value="internal" {{ (isset($kategori) && $kategori=='internal' ) ? 'selected' : '' }}>Internal
                </option>
            </select>

            <select id="buyer" name="buyer" class="select2">
                <option value="">Pilih Buyer</option>
                @foreach($buyer as $b)
                <option value="{{ $b->id }}" {{ (isset($selectedBuyer) && $selectedBuyer->id == $b->id) ? 'selected' :
                    '' }}>{{
                    $b->nama_buyer }}</option>
                @endforeach
            </select>
            <button type="submit">Cari</button>
        </form><br>
        {{-- @if(!is_null($selectedBuyer))
        <h3> {{ $selectedBuyer->nama_buyer }}</h3>
        @endif --}}
        @if(isset($labels) && isset($values) && isset($tahun))
        <canvas id="grafikBulanan"></canvas>
        <hr>
        @else
        <p>Data tidak tersedia atau belum dipilih tahunnya.</p>
        @endif
        <canvas id="grafikPenjualan"></canvas>


    </div>
</div>

@if(isset($labels) && isset($values))
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var labelSuffix = '';
    @if(isset($tahun))
    labelSuffix = 'Tahun ' + @json($tahun);
    @elseif(isset($tanggal_mulai) && isset($tanggal_akhir))
    labelSuffix = 'Dari ' + @json($tanggal_mulai) + ' sampai ' + @json($tanggal_akhir);
    @endif

    var ctx = document.getElementById('grafikPenjualan').getContext('2d');
    var grafikPenjualan = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Penyebab Masalah ' + @json($kategori) + ' ' + labelSuffix,
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

@if(isset($bulanLabels) && isset($bulanValues))
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var labelSuffix = '';
    @if(isset($tahun))
    labelSuffix = 'Tahun ' + @json($tahun);
    @elseif(isset($tanggal_mulai) && isset($tanggal_akhir))
    labelSuffix = 'Dari ' + @json($tanggal_mulai) + ' sampai ' + @json($tanggal_akhir);
    @endif

    var ctxBulanan = document.getElementById('grafikBulanan').getContext('2d');
    var grafikBulanan = new Chart(ctxBulanan, {
        type: 'line',
        data: {
            labels: @json($bulanLabels),
            datasets: [{
                label: 'Jumlah Keluhan per Bulan, ' + labelSuffix,
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
});
</script>
@endif

@endsection

@section('tablejs')

<script>
    $(document).ready(function() {
    $('#buyer').select2({
        placeholder: "Pilih Nama Buyer",
        allowClear: true,
        width: '30%'
    });
});
</script>
<script>
    $(document).ready(function() {
    $('#kategori').select2({
        allowClear: true,
        width: '10%'
    });
});
</script>
@endsection