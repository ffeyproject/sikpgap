@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container"><br>

        <div class="row"><br>
            {{-- <div class="col-sm-6">
                <h2>Grafik Asal Masalah per Tanggal : {{ $now }}</h2>
            </div> --}}
            <h4>Total Per Tahun {{ Carbon::now()->format('Y') }}</h4>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="mb-3 info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="far fa-paper-plane"></i></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Keluhan</span>
                            <h4><span class="info-box-number">{{ $t_keluhan }}</span></h4>
                        </div>

                    </div>

                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="mb-3 info-box">
                        <span class="info-box-icon bg-success elevation-1"><i
                                class="far fa-building"></i></i></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Asal Masalah</span>
                            <h4><span class="info-box-number">{{ $t_total }}</span></h4>
                        </div>

                    </div>

                </div>
                <hr>
            </div>
            <div class="col-md-10 offset-md-1">

                <div class="panel panel-default">

                    <div class="panel-body">
                        <canvas id="userChart" height="280" width="600"></canvas>
                    </div>

                </div>
                <hr>
                <div class="panel panel-default">

                    <div class="panel-body">
                        <canvas id="defectChart" height="280" width="600"></canvas>
                    </div>

                </div>
            </div>
            <hr>

        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

{{-- <script>
    var year = <?php echo $year; ?>;
    var keluhan = <?php echo $keluhan; ?>;
    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Keluhan',
            backgroundColor: "pink",
            data: keluhan
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#FFFF00',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Data Keluhan'
                }
            }
        });
    };

</script> --}}

<script>
    var ctx = document.getElementById('userChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
        data: {
            labels:  {!!json_encode($chart->labels)!!} ,
            datasets: [
                {
                    label: 'Asal Masalah (Tahun {{ Carbon::now()->format('Y') }})',
                    backgroundColor: {!! json_encode($chart->colours)!!} ,
                    data:  {!! json_encode($chart->dataset)!!} ,
                },
            ]
        },
// Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });
</script>

<script>
    var ww = document.getElementById('defectChart').getContext('2d');
    var ac = new Chart(ww, {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
        data: {
            labels:  {!!json_encode($ac->labels)!!} ,
            datasets: [
                {
                    label: 'Penyebab Masalah (Tahun {{ Carbon::now()->format('Y') }}) ',
                    backgroundColor: {!! json_encode($ac->cc)!!} ,
                    data:  {!! json_encode($ac->dataset)!!} ,
                },
            ]
        },
// Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });
</script>

@endsection
