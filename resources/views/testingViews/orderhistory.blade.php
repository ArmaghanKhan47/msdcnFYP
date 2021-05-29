@extends('layouts.app')
@section('content')
<div class="jumbotron p-3 mb-1">
    <span class="h1 d-block">Order History</span>
</div>
<div class="jumbotron p-3">
    <button id="btn-all" class="btn btn-primary d-inline">All</button>
    <button id="btn-completed" class="btn btn-secondary d-inline">Completed</button>
    <button id="btn-pending" class="btn btn-secondary d-inline">Pending</button>
    <button id="btn-cancelled" class="btn btn-secondary d-inline">Cancelled</button>
</div>
{{-- To Display All type of Orders Start --}}
<div id="all" class="container-fluid p-0 d-block">
    @foreach ($orders as $order)
        {{-- Order Template Start --}}
        <div class="jumbotron p-3 mb-2">
            {{-- Order Basic Info Stat --}}
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
            {{-- Order Basic Info End --}}

            {{-- Order Transaction Info Stat --}}
            @if(strstr($order->PaymentMethod, 'Mobile Payment'))
                <div class="row p-1 justify-content-center">
                    <div class="col-md-6 text-center">
                        <span class="h5 d-block">{{$order->mobilePaymentTransactionId}}</span>
                        <span class="h6 d-block text-muted">Mobile Payment - Transaction Id</span>
                    </div>
                </div>
            @endif
            {{-- Order Transaction Info End --}}

            {{-- Button to Show / Hide Order Item List --}}
            <button id="buttton-{{$order->OrderId}}" class="btn btn-secondary btn-block" type="button">Items<span class="p-1"><i id="caret-{{$order->OrderId}}" class="bi bi-caret-down-fill" style="font-size: 1em"></i></span></button>

            {{-- Order Item List Start --}}
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
            {{-- Order ITem List End --}}

            {{-- Order Status Controlls Start --}}
                @if (strstr($order->OrderStatus, 'Pending'))
                    {{-- If Order is pending show these functions --}}
                    <div class="mt-2">
                        {{-- @user('Retailer')
                            <button class="btn btn-info btn-block">Pending</button>
                                <form class="d-block mt-2" method="POST" action="/order/status">
                                    @csrf
                                    <input type="hidden" name="orderid" value="{{$order->OrderId}}">
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </form>
                        @enduser --}}

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
<<<<<<< HEAD
                            <form method="POST" action="/order/status">
                                @csrf
                                <input type="hidden" name="orderid" value="{{$order->OrderId}}">
                                <input type="hidden" name="status" value="dispatched">
                                <button type="submit" class="btn btn-primary mt-2">Dispatch</button>
                            </form>
=======
                            @if (strstr($order->OrderStatus, 'Unpayed'))
                                <form method="POST" action="/order/status">
                                    @csrf
                                    <input type="hidden" name="orderid" value="{{$order->OrderId}}">
                                    <input type="hidden" name="status" value=4>
                                    <button type="submit" class="btn btn-primary mt-2">Payment Confirmed</button>
                                </form>
                            @else
                                <form method="POST" action="/order/status">
                                    @csrf
                                    <input type="hidden" name="orderid" value="{{$order->OrderId}}">
                                    <input type="hidden" name="status" value=2>
                                    <button type="submit" class="btn btn-primary mt-2">Dispatch</button>
                                </form>
                            @endif
>>>>>>> master
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
            {{-- Order Status Controlls End --}}
            <script>
                // Custom JS to hide or show Order Items
                document.getElementById("buttton-{{$order->OrderId}}").addEventListener('click', function(){
                    var el = $('#items-{{$order->OrderId}}');
                    var caret = $('#caret-{{$order->OrderId}}');
                    var attri = el.attr('class');
                    if (attri == 'd-none')
                    {
                        el.attr({'class' : 'd-block'});
                        caret.attr({'class' : 'bi bi-caret-up-fill'});
                    }
                    else if (attri == 'd-block')
                    {
                        el.attr({'class' : 'd-none'});
                        caret.attr({'class' : 'bi bi-caret-down-fill'});
                    }
                });
            </script>
        </div>
        {{-- Order Template End --}}
    @endforeach
</div>
{{-- To Display All type of Orders End --}}

{{-- To Display Completed type of Orders Start --}}
<div id="completed" class="container-fluid p-0 d-none">
    @foreach ($orders as $order)
        @if(explode('|', $order->OrderStatus)[0] == 'Completed')
            <div class="jumbotron p-3 mb-2">
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
                <button id="buttton-completed-{{$order->OrderId}}" class="btn btn-secondary btn-block" type="button">Items<span class="p-1"><i id="caret-completed-{{$order->OrderId}}" class="bi bi-caret-down-fill" style="font-size: 1em"></i></span></button>
                <div class="d-none" id="items-completed-{{$order->OrderId}}">
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
                    <div class="mt-2">
                        {{-- If order is preparing show this as a status of accepted order --}}
                        <button class="btn btn-success btn-block">Completed</button>
                    </div>
                <script>
                    // Custom JS to hide or show Order Items
                    document.getElementById("buttton-completed-{{$order->OrderId}}").addEventListener('click', function(){
                        var el = $('#items-completed-{{$order->OrderId}}');
                        var caret = $('#caret-completed-{{$order->OrderId}}');
                        var attri = el.attr('class');
                        if (attri == 'd-none')
                        {
                            el.attr({'class' : 'd-block'});
                            caret.attr({'class' : 'bi bi-caret-up-fill'});
                        }
                        else if (attri == 'd-block')
                        {
                            el.attr({'class' : 'd-none'});
                            caret.attr({'class' : 'bi bi-caret-down-fill'});
                        }
                    });
                </script>
            </div>
        @endif
    @endforeach
</div>
{{-- To Display Completed type of Orders End --}}

{{-- To Display Pending type of Orders Start --}}
<div id="pending" class="container-fluid p-0 d-none">
    @foreach ($orders as $order)
        @if(explode('|', $order->OrderStatus)[0] == 'Pending')
            <div class="jumbotron p-3 mb-2">
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
                <button id="buttton-pending-{{$order->OrderId}}" class="btn btn-secondary btn-block" type="button">Items<span class="p-1"><i id="caret-pending-{{$order->OrderId}}" class="bi bi-caret-down-fill" style="font-size: 1em"></i></span></button>
                <div class="d-none" id="items-pending-{{$order->OrderId}}">
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
                        {{-- If Order is pending show these functions --}}
                        <div class="mt-2">
                            @user('Retailer')
                                <button class="btn btn-info btn-block">Pending</button>
                                <div class="d-block mt-2">
                                    <form class="d-block" method="POST" action="/order/status">
                                        @csrf
                                        <input type="hidden" name="orderid" value="{{$order->OrderId}}">
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-danger">Cancel</button>
                                    </form>
                                </div>
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
                <script>
                    // Custom JS to hide or show Order Items
                    document.getElementById("buttton-pending-{{$order->OrderId}}").addEventListener('click', function(){
                        var el = $('#items-pending-{{$order->OrderId}}');
                        var caret = $('#caret-pending-{{$order->OrderId}}');
                        var attri = el.attr('class');
                        if (attri == 'd-none')
                        {
                            el.attr({'class' : 'd-block'});
                            caret.attr({'class' : 'bi bi-caret-up-fill'});
                        }
                        else if (attri == 'd-block')
                        {
                            el.attr({'class' : 'd-none'});
                            caret.attr({'class' : 'bi bi-caret-down-fill'});
                        }
                    });
                </script>
            </div>
        @endif
    @endforeach
</div>
{{-- To Display Pending type of Orders End --}}

{{-- To Display Cancelled type of Orders Start --}}
<div id="cancelled" class="container-fluid p-0 d-none">
    @foreach ($orders as $order)
        @if(explode('|', $order->OrderStatus)[0] == 'Cancelled')
            <div class="jumbotron p-3 mb-2">
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
                <button id="buttton-cancelled-{{$order->OrderId}}" class="btn btn-secondary btn-block" type="button">Items<span class="p-1"><i id="caret-cancelled-{{$order->OrderId}}" class="bi bi-caret-down-fill" style="font-size: 1em"></i></span></button>
                <div class="d-none" id="items-cancelled-{{$order->OrderId}}">
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
                <div class="mt-2">
                    {{-- If order is cancelled show this as a status of cancelled order --}}
                    <button class="btn btn-danger btn-block">Cancelled</button>
                </div>
                <script>
                    // Custom JS to hide or show Order Items
                    document.getElementById("buttton-cancelled-{{$order->OrderId}}").addEventListener('click', function(){
                        var el = $('#items-cancelled-{{$order->OrderId}}');
                        var caret = $('#caret-cancelled-{{$order->OrderId}}');
                        var attri = el.attr('class');
                        if (attri == 'd-none')
                        {
                            el.attr({'class' : 'd-block'});
                            caret.attr({'class' : 'bi bi-caret-up-fill'});
                        }
                        else if (attri == 'd-block')
                        {
                            el.attr({'class' : 'd-none'});
                            caret.attr({'class' : 'bi bi-caret-down-fill'});
                        }
                    });
                </script>
            </div>
        @endif
    @endforeach
</div>
{{-- To Display Cancelled type of Orders End --}}

<script>
    //Adding event listener to #btn-all
    document.getElementById('btn-all').addEventListener('click', function(){
        //Playing with buttons
        $('#btn-all').removeClass('btn-secondary').addClass('btn-primary');
        $('#btn-pending').removeClass('btn-info').addClass('btn-secondary');
        $('#btn-cancelled').removeClass('btn-danger').addClass('btn-secondary');
        $('#btn-completed').removeClass('btn-success').addClass('btn-secondary');

        //playing with containers
        $('#all').removeClass('d-none').addClass('d-block');
        $('#completed').removeClass('d-block').addClass('d-none');
        $('#pending').removeClass('d-block').addClass('d-none');
        $('#cancelled').removeClass('d-block').addClass('d-none');
    });

    //Adding event listener to #btn-completed
    document.getElementById('btn-completed').addEventListener('click', function(){
        $('#btn-all').removeClass('btn-primary').addClass('btn-secondary');
        $('#btn-pending').removeClass('btn-info').addClass('btn-secondary');
        $('#btn-cancelled').removeClass('btn-danger').addClass('btn-secondary');
        $('#btn-completed').removeClass('btn-secondary').addClass('btn-success');

        //playing with containers
        $('#all').removeClass('d-block').addClass('d-none');
        $('#completed').removeClass('d-none').addClass('d-block');
        $('#pending').removeClass('d-block').addClass('d-none');
        $('#cancelled').removeClass('d-block').addClass('d-none');
    });

    //Adding event listener to #btn-pending
    document.getElementById('btn-pending').addEventListener('click', function(){
        $('#btn-all').removeClass('btn-primary').addClass('btn-secondary');
        $('#btn-pending').removeClass('btn-secondary').addClass('btn-info');
        $('#btn-cancelled').removeClass('btn-danger').addClass('btn-secondary');
        $('#btn-completed').removeClass('btn-success').addClass('btn-secondary');

        //playing with containers
        $('#all').removeClass('d-block').addClass('d-none');
        $('#completed').removeClass('d-block').addClass('d-none');
        $('#pending').removeClass('d-none').addClass('d-block');
        $('#cancelled').removeClass('d-block').addClass('d-none');
    });

    //Adding event listener to #btn-cancelled
    document.getElementById('btn-cancelled').addEventListener('click', function(){
        $('#btn-all').removeClass('btn-primary').addClass('btn-secondary');
        $('#btn-pending').removeClass('btn-info').addClass('btn-secondary');
        $('#btn-cancelled').removeClass('btn-secondary').addClass('btn-danger');
        $('#btn-completed').removeClass('btn-success').addClass('btn-secondary');

        //playing with containers
        $('#all').removeClass('d-block').addClass('d-none');
        $('#completed').removeClass('d-block').addClass('d-none');
        $('#pending').removeClass('d-block').addClass('d-none');
        $('#cancelled').removeClass('d-none').addClass('d-block');
    });
</script>
@endsection
