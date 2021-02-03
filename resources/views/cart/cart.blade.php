@extends('layouts.app')
@section('content')
    <span class="h1 d-block">Shopping Cart ({{$cart->count()}})</span>
    <div class="row">
        <div class="col-md-8 overflow-scroll order-md-1 order-2">
            @foreach ($cart as $item)
                <div class="jumbotron p-4">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="/storage/img/default.jpg" height="40px">
                        </div>
                        <div class="col-md-2">
                            <span class="h5 d-block">{{$item->get('medicine')->MedicineName}}</span>
                            <span class="h6 text-muted d-block">By {{$item->get('medicine')->MedicineCompany}}</span>
                            <span class="h6 text-muted d-block">{{$item->get('distributor')->DistributorShopName}}</span>
                        </div>
                        <div class="col-md-2">
                            <span class="h5 d-block">{{$item->get('unitprice') . ' PKR'}}</span>
                            <span class="h6 text-muted d-block">Unit Price</span>
                        </div>
                        <div class="col-md-2">
                            <span class="h5 d-block">{{$item->get('quantity')}}</span>
                            <span class="h6 text-muted d-block">Quantity</span>
                        </div>
                        <div class="col-md-2">
                            <span class="h5 d-block">{{$item->get('totalprice') . ' PKR'}}</span>
                            <span class="h6 text-muted d-block">Total Price</span>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-4 jumbotron p-3 order-md-2 order-1" style="height: 11em">
            <span class="h4 d-block">Invoice</span>
            <hr>
            <div class="container">
                <span class="h5">Grand Total</span>
                <span class="h5 float-right">{{$cart->sum('totalprice') . ' PKR'}}</span>
            </div>
            <a class="btn btn-success btn-block align-bottom" href="/ordercheckout">Checkout</a>
        </div>
    </div>
@endsection
