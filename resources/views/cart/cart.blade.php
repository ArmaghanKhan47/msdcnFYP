@extends('layouts.app')
@section('content')
    <span class="h1 d-block">Shopping Cart ({{$cart->count()}})</span>
    <div class="row">
        <div class="col-md-8 overflow-scroll order-md-1 order-2">
            @foreach ($cart as $key => $item)
                <div class="jumbotron p-4 mb-1">
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
                            <div class="text-right">
                                <form method="POST" action="{{route('cart.remove', [$key])}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="key" value="{{$key}}">
                                    <button type="submit" class="btn btn-outline-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                          </svg>
                                        </button>
                                </form>
                            </div>
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
            <a class="btn btn-success btn-block align-bottom @if($cart->count() == 0){{'disabled'}}@endif" href="/ordercheckout">Checkout</a>
        </div>
    </div>
@endsection
