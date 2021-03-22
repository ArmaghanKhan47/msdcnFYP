@extends('layouts.app')

@section('content')
<div class="jumbotron p-3">
    <span class="h1 d-block">Dashboard</span>
</div>
<div class="jumbotron p-3 mb-1">
    <span class="h2 d-block">Sales Graph</span>
    @if($sales and $sales->count() > 0)
    <canvas width="100" height="40px" id="salegraph">
        <p>No Record to show</p>
    </canvas>
    @else
        <span class="h3 d-block text-center">No Record to Show</span>
    @endif
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 p-0 pr-1">
            <div class="jumbotron p-3">
                <span class="h2 d-block text-center">Total Sale</span>
                @if($sales and $sales->count() > 0)
                    <span class="d-block text-center">@user('Retailer'){{$sales->sum('Payed')}}@elseuser('Distributor'){{$sales->sum('PayableAmount')}}@enduser PKR</span>
                @else
                    <span class="d-block text-center">N/A</span>
                @endif
            </div>
        </div>
        @user('Retailer')
            <div class="col-md-3 p-0 pr-1">
                <div class="jumbotron p-3">
                    <span class="h2 d-block text-center">Medicine Sold</span>
                    <span class="d-block text-center">{{$sales->sum(function($sale){
                        return $sale->saleitems->sum(function($item){
                            return $item->Quantity;
                        });
                    })}}</span>
                </div>
            </div>
            <div class="col-md-3 p-0 pr-1">
                <div class="jumbotron p-3">
                    <span class="h2 d-block text-center">Quick Sale</span>
                    <span class="d-block">
                        <a class="btn btn-primary btn-block p-1" href="{{route('sales.newsale')}}">Make a Sale</a>
                    </span>
                </div>
            </div>
        @enduser
        <div class="col-md-3 p-0">
            <div class="jumbotron p-3">
                <span class="h2 d-block text-center">Last Sale</span>
                @if($sales and $sales->count() > 0)
                    <span class="d-block text-center">@user('Retailer'){{$sales->last()->Payed}}@elseuser('Distributor'){{$sales->last()->PayableAmount}}@enduser PKR</span>
                @else
                    <span class="d-block text-center">N/A</span>
                @endif
            </div>
        </div>
    </div>
</div>
@if($sales)
<script>
    var label = [
        @foreach($sales as $sale)
            @user('Retailer')
                '{{$sale->SaleId}}',
            @elseuser('Distributor')
                '{{$sale->OrderId}}',
            @enduser
        @endforeach
    ];

    var data = [
        @foreach($sales as $sale)
            @user('Retailer')
                '{{$sale->Payed}}',
            @elseuser('Distributor')
                '{{$sale->PayableAmount}}',
            @enduser
        @endforeach
    ];

    var ctx = document.getElementById('salegraph');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: label,
        datasets: [{
            label: 'Sales',
            data: data,
            backgroundColor: 'rgba(220, 53, 69, 0.4)',
            borderColor: 'rgba(195, 34, 50, 1)',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
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
