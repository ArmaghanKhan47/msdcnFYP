@extends('layouts.app')

@section('content')
<div class="jumbotron p-3 row">
    <span class="col-md-10 h2 pt-2 d-block"><strong>DASHBOARD</strong></span>
    <span class="col-md-2 pt-3">
        <a class="m-0 float-right btn btn-danger p-1" href="{{route('sales.newsale')}}">Make a Sale</a>
    </span>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-3 pr-1">
            <div class="jumbotron p-3 row">
                <div class="col-md-8">
                    <span class="h2 d-block"><strong>Total Sale</strong></span>
                    <span class="d-block">
                        @if($sales and $sales->count() > 0)
                        <span><strong>@user('Retailer'){{$sales->sum('Payed')}}@elseuser('Distributor'){{$sales->sum('PayableAmount')}}@enduser PKR</strong></span>
                    @else
                        <span class="d-block text-center">N/A</span>
                    @endif
                    </span>
                </div>
                <div class="p-0 pt-1 pl-3 col-md-4 ">
                    <span class='text-danger'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z"/>
                          </svg>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        @user('Retailer')
            <div class="col-md-3 pr-1">
                <div class="jumbotron p-3 row">
                    <div class="col-md-8">
                        <span class="h2 d-block"><strong>Item Sold</strong></span>
                        <span class="d-block">
                            @if($sales and $sales->count() > 0)
                            <span><strong>{{$sales->sum(function($sale){
                                return $sale->saleitems->sum(function($item){
                                    return $item->Quantity;
                                });
                            })}}</strong></span>
                        @else
                            <span class="d-block text-center">N/A</span>
                        @endif
                        </span>
                    </div>
                    <div class="p-0 pt-1 pl-3 col-md-4 ">
                        <span class='text-success'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z"/>
                              </svg>
                        </span>
                    </div>
                </div>
            </div>
        @enduser
        <div class="col-md-1"></div>
        <div class="col-md-3 pr-1">
            <div class="jumbotron p-3 row">
                <div class="col-md-8">
                    <span class="h2 d-block"><strong>Last Sale</strong></span>
                    <span class="d-block">
                        @if($sales and $sales->count() > 0)
                        <span><strong>@user('Retailer'){{$sales->last()->Payed}}@elseuser('Distributor'){{$sales->last()->PayableAmount}}@enduser</strong></span>
                    @else
                        <span class="d-block text-center">N/A</span>
                    @endif
                    </span>
                </div>
                <div class="p-0 pt-1 pl-3 col-md-4 ">
                    <span class='text-primary'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z"/>
                          </svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
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
