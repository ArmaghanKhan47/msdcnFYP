@extends('layouts.app')
@section('content')
    <div class="jumbotron p-3">
        <span class="h1 d-block">Reports</span>
    </div>
    <div class="jumbotron p-3 mb-1">
        <span class="h2 d-block">Sales Graph<span id="graph-heading" class="text-muted"> - Daily</span></span>
            <canvas width="100" height="35px" id="salegraph">
                <p>No Record to show</p>
            </canvas>
            <hr class="divider">
            <div class="container p-0 m-0 d-flex align-items-center">
                <div class="btn-group">
                    <button id="btn-daily" class="btn btn-primary">D</button>
                    <button id="btn-weekly" class="btn btn-secondary">W</button>
                    <button id="btn-monthly" class="btn btn-secondary">M</button>
                    <button id="btn-yearly" class="btn btn-secondary">Y</button>
                </div>
            </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 p-0 pr-1">
                <div class="jumbotron p-3">
                        <span class="h2 d-block text-center"> PKR</span>
                        <span class="h2 d-block text-center">N/A</span>
                    <span class="h5 d-block text-center text-muted">Total Sale</span>
                </div>
            </div>
                <div class="col-md-4 p-0 pr-1">
                    <div class="jumbotron p-3">
                        <span class="h2 d-block text-center"></span>
                        <span class="h5 d-block text-center text-muted">Medicine Sold</span>
                    </div>
                </div>
            <div class="col-md-4 p-0">
                <div class="jumbotron p-3">
                        <span class="h2 d-block text-center"> PKR</span>
                        <span class="h2 d-block text-center">N/A</span>
                    <span class="h5 d-block text-center text-muted">Last Sale</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.onload = function(){
            //Write Custom JQuery Here
            $('#btn-daily').click(function(){
                $(this).removeClass('btn-secondary').addClass('btn-primary');
                $('#btn-weekly').removeClass('btn-primary').addClass('btn-secondary');
                $('#btn-monthly').removeClass('btn-primary').addClass('btn-secondary');
                $('#btn-yearly').removeClass('btn-primary').addClass('btn-secondary');
                $('#graph-heading').text(' - Daily');
                //Create AJAX Call for data retrieval
                $.post({
                    "headers" : {
                        "X-CSRF-TOKEN" : "{{ csrf_token() }}"
                    },
                    "url" : "/reports/daily",
                }, function(data){
                    console.log(data);
                    createGraph(data[1], data[0], chart);
                });
            });

            $('#btn-weekly').click(function(){
                $(this).removeClass('btn-secondary').addClass('btn-primary');
                $('#btn-daily').removeClass('btn-primary').addClass('btn-secondary');
                $('#btn-monthly').removeClass('btn-primary').addClass('btn-secondary');
                $('#btn-yearly').removeClass('btn-primary').addClass('btn-secondary');
                $('#graph-heading').text(' - Weekly');
                //Create AJAX Call for data retrieval
                $.post({
                    "headers" : {
                        "X-CSRF-TOKEN" : "{{ csrf_token() }}"
                    },
                    "url" : "/reports/weekly",
                }, function(data){
                    console.log(data);
                    createGraph(data[1], data[0], chart);
                });
            });

            $('#btn-monthly').click(function(){
                $(this).removeClass('btn-secondary').addClass('btn-primary');
                $('#btn-daily').removeClass('btn-primary').addClass('btn-secondary');
                $('#btn-weekly').removeClass('btn-primary').addClass('btn-secondary');
                $('#btn-yearly').removeClass('btn-primary').addClass('btn-secondary');
                $('#graph-heading').text(' - Monthly');
                //Create AJAX Call for data retrieval
                $.post({
                    "headers" : {
                        "X-CSRF-TOKEN" : "{{ csrf_token() }}"
                    },
                    "url" : "/reports/monthly",
                }, function(data){
                    createGraph(data[1], data[0], chart);
                });
            });

            $('#btn-yearly').click(function(){
                $(this).removeClass('btn-secondary').addClass('btn-primary');
                $('#btn-weekly').removeClass('btn-primary').addClass('btn-secondary');
                $('#btn-monthly').removeClass('btn-primary').addClass('btn-secondary');
                $('#btn-daily').removeClass('btn-primary').addClass('btn-secondary');
                $('#graph-heading').text(' - Yearly');
                //Create AJAX Call for data retrieval
                $.post({
                    "headers" : {
                        "X-CSRF-TOKEN" : "{{ csrf_token() }}"
                    },
                    "url" : "/reports/yearly",
                }, function(data){
                    createGraph(data[1], data[0], chart);
                });
            });

            //For Graphing
            var label = [
            ];
            var data = [
            ];
            //Plant Graph
            var ctx = $('#salegraph');
            var chart = new Chart(ctx,{
                type : 'line',
                data : {
                    labels : label,
                    datasets: [{
                        label: 'Sales',
                        data: data,
                        backgroundColor: 'rgba(117, 1, 254, 0.4)',
                        borderColor: 'rgba(110, 0, 255, 1)',
                        borderWidth: 2
                    }]
                },
                options : {
                    responsive : true,
                    scales : {
                        yAxes : [{
                            ticks : {
                                beginAtZero : true
                            }
                        }]
                    }
                }
            });

            //Custom JQuery End
        }

        function createGraph(data, label, chart)
        {
            //Graph Creation
            chart.data.labels = label;
            chart.data.datasets.forEach((dataset) => {
                dataset.data = data;
            });
            chart.update();
        }
    </script>
@endsection
