@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">

        <div class="row">

            <div class="col-md-10 offset-md-1">

                <div class="panel panel-default">

                    <div class="panel-body">

                        <canvas id="canvas" height="280" width="600"></canvas>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
    var year = <?php echo $year; ?>;
    var keluhan = <?php echo $keluhan; ?>;
    var result = <?php echo $result; ?>;
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

</script>

@endsection
