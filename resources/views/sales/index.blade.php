@extends('layouts.app')
@section('content')
    {{-- Heading --}}
    <div class="jumbotron p-3">
        <span class="h1 d-block">Sales</span>
    </div>

    {{-- Little Info Tabs --}}
    <div class="container-fluid p-0 text-center mb-1">
        <div class="row">
            <div class="col-md-4">
                <div class="jumbotron p-2">
                    <span class="h4 d-block">@if($sales->count() > 0){{$sales->sum('Payed')}}@else{{'0'}}@endif</span>
                    <span class="h5 text-muted">Today's Total</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron p-2">
                    <span class="h4 d-block">@if($sales->count() > 0){{$sales->first()->Payed}}@else{{'0'}}@endif</span>
                    <span class="h5 text-muted">Today's Last</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron p-2">
                    <span class="h4 d-block">{{$yesterday}}</span>
                    <span class="h5 text-muted">Yesterday's Total</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Make new sale button --}}
    <div class="container-fluid p-0 mt-0">
        <a class="btn btn-success btn-block" href="{{route('sales.newsale')}}">Make a new Sale</a>
    </div>

    {{-- Divider --}}
    <hr>

    {{-- Heading --}}
    <div class="jumbotron p-3">
        <span class="h1 d-block">Today's Sales History</span>
    </div>
    @if ($sales->count() > 0)
        @foreach ($sales as $sale)
            {{-- Sales History Item --}}
            <div class="jumbotron p-3 text-center mb-1">
                <div class="row">
                    <div class="col-md-3">
                        <span class="h5 d-block">{{$sale->SaleId}}</span>
                        <span class="h6 text-muted">Invoice#</span>
                    </div>
                    <div class="col-md-3">
                        <span class="h5 d-block">{{$sale->Total}}</span>
                        <span class="h6 text-muted">Total</span>
                    </div>
                    <div class="col-md-3">
                        <span class="h5 d-block">{{$sale->Discount}}</span>
                        <span class="h6 text-muted">Discount</span>
                    </div>
                    <div class="col-md-3">
                        <span class="h5 d-block">{{$sale->Payed}}</span>
                        <span class="h6 text-muted">Payed</span>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="jumbotron p-3 text-center mb-1">
            <span class="h5 d-block">No Sale Made Today</span>
        </div>
    @endif
@endsection
