@extends('layouts.app')
@section('content')
    <span class="h4 d-block">Order History</span>
    @foreach ($orders as $order)
        <div class="jumbotron p-3">
            <div class="row p-1">
                <div class="col-md-1">
                    <span class="h5 d-block">{{$order->OrderId}}</span>
                    <span class="h6 d-block text-muted">Order Id</span>
                </div>
                <div class="col-md-2">
                    @user ('Retailer')
                        {{-- Show Distributor name if logged in user is Retailer --}}
                        <span class="h5 d-block">{{$order->distributor->DistributorShopName}}</span>
                        <span class="h6 d-block text-muted">Distributor</span>
                    @elseuser('Distributor')
                        {{-- Show Retailer name id logged in user is Distributor --}}
                        <span class="h5 d-block">{{$order->retailer->RetailerShopName}}</span>
                        <span class="h6 d-block text-muted">Retailer</span>
                    @enduser
                </div>
                <div class="col-md-2">
                    <span class="h5 d-block">{{$order->OrderStatus}}</span>
                    <span class="h6 d-block text-muted">Order Status</span>
                </div>
                <div class="col-md-2">
                    <span class="h5 d-block">{{$order->PaymentMethod}}</span>
                    <span class="h6 d-block text-muted">Payment Method</span>
                </div>
                <div class="col-md-1">
                    <span class="h5 d-block">{{$order->PayableAmount}}</span>
                    <span class="h6 d-block text-muted">Total</span>
                </div>
                <div class="col-md-2">
                    <span class="h5 d-block">{{$order->OrderPlacingDate}}</span>
                    <span class="h6 d-block text-muted">Order Placed On</span>
                </div>
                <div class="col-md-2">
                    <span class="h5 d-block">{{$order->deliveryAddress}}</span>
                    <span class="h6 d-block text-muted">@user('Distributor'){{'Shipping Address'}}@elseuser('Retailer'){{'Delivery Address'}}@enduser</span>
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
                @if (strstr($order->OrderStatus, 'Pending'))
                    {{-- If Order is pending show these functions --}}
                    <div class="mt-2">
                        @user('Retailer')
                            <button class="btn btn-info btn-block">Pending</button>
                        @enduser

                        @user('Distributor')
                            <form class="d-inline" method="POST" action="/order/status">
                                @csrf
                                <input type="hidden" name="orderid" value="{{$order->OrderId}}">
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>
                            <form class="d-inline" method="POST" action="/order/status">
                                @csrf
                                <input type="hidden" name="orderid" value="{{$order->OrderId}}">
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="btn btn-danger float-right">Cancel</button>
                            </form>
                        @enduser
                    </div>
                @elseif(strstr($order->OrderStatus, 'Preparing'))
                    <div class="mt-2">
                        {{-- If order is preparing show this as a status of accepted order --}}
                        <button class="btn btn-success btn-block">Accepted</button>
                        @user('Distributor')
                            <form method="POST" action="/order/status">
                                @csrf
                                <input type="hidden" name="orderid" value="{{$order->OrderId}}">
                                <input type="hidden" name="status" value="dispatched">
                                <button type="submit" class="btn btn-primary mt-2">Dispatch</button>
                            </form>
                        @enduser
                    </div>
                @elseif(strstr($order->OrderStatus, 'Dispatched'))
                    <div class="mt-2">
                        {{-- If order is preparing show this as a status of accepted order --}}
                        <button class="btn btn-primary btn-block">Dispatched</button>
                        @user('Distributor')
                            <form method="POST" action="/order/status">
                                @csrf
                                <input type="hidden" name="orderid" value="{{$order->OrderId}}">
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="btn btn-primary mt-2">Mark as Complete</button>
                            </form>
                        @enduser
                    </div>
                @elseif(strstr($order->OrderStatus, 'Completed'))
                <div class="mt-2">
                    {{-- If order is preparing show this as a status of accepted order --}}
                    <button class="btn btn-success btn-block">Completed</button>
                </div>
                @elseif(strstr($order->OrderStatus, 'Cancelled'))
                    <div class="mt-2">
                        {{-- If order is cancelled show this as a status of cancelled order --}}
                        <button class="btn btn-danger btn-block">Cancelled</button>
                    </div>
                @endif
            <script>
                // Custom JS to hide or show Order Items
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
