@extends('layouts.app')
@section('content')
    <span class="h4 d-block">Order History</span>
    @foreach ($orders as $order)
        <div class="jumbotron p-3">
            <div class="row p-1">
                <div class="col-md-2">
                    <span class="h5 d-block">{{$order->OrderId}}</span>
                    <span class="h6 d-block text-muted">Order Id</span>
                </div>
                <div class="col-md-2">
                    <span class="h5 d-block">{{$order->distributor->DistributorShopName}}</span>
                    <span class="h6 d-block text-muted">Distributor</span>
                </div>
                <div class="col-md-2">
                    <span class="h5 d-block">{{$order->OrderStatus}}</span>
                    <span class="h6 d-block text-muted">Order Status</span>
                </div>
                <div class="col-md-2">
                    <span class="h5 d-block">{{$order->PaymentMethod}}</span>
                    <span class="h6 d-block text-muted">Payment Method</span>
                </div>
                <div class="col-md-2">
                    <span class="h5 d-block">{{$order->PayableAmount}}</span>
                    <span class="h6 d-block text-muted">Total</span>
                </div>
                <div class="col-md-2">
                    <span class="h5 d-block">{{$order->OrderPlacingDate}}</span>
                    <span class="h6 d-block text-muted">Order Placed On</span>
                </div>
            </div>
            <button id="buttton-{{$order->OrderId}}" class="btn btn-secondary btn-block" type="button">Items<span class="p-1"><i id="caret-{{$order->OrderId}}" class="bi bi-caret-down-fill" style="font-size: 1em"></i></span></button>
            <div class="d-none" id="items-{{$order->OrderId}}">
                @foreach ($order->orderitems as $item)
                    <div class="jumbotron bg-dark bg-gradient text-white p-4 m-1">
                        <div class="row p-1 justify-content-center">
                            <div class="col-md-2">
                                <span class="h5 d-block">{{$item->medicine->MedicineName}}</span>
                                <span class="h6 d-block">Medicine - {{$item->medicine->MedicineType}}</span>
                            </div>
                            <div class="col-md-2">
                                <span class="h5 d-block">{{$item->Quantity}}</span>
                                <span class="h6 d-block">Quantity</span>
                            </div>
                            <div class="col-md-2">
                                <span class="h5 d-block">{{$item->Subtotal}}</span>
                                <span class="h6 d-block">Sub Total</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <script>
                document.getElementById("buttton-{{$order->OrderId}}").addEventListener('click', function(){
                    var el = document.getElementById('items-{{$order->OrderId}}');
                    var caret = document.getElementById('caret-{{$order->OrderId}}');
                    var attri = el.getAttribute('class');
                    if (attri == 'd-none')
                    {
                        el.setAttribute('class', 'd-block');
                        caret.setAttribute('class', 'bi bi-caret-up-fill');
                    }
                    else if (attri == 'd-block')
                    {
                        el.setAttribute('class', 'd-none');
                        caret.setAttribute('class', 'bi bi-caret-down-fill');
                    }
                });
            </script>
        </div>
    @endforeach
@endsection
