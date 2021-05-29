@extends('layouts.app')
@section('content')
    @include('navbars.navbar2')
    <div class="row">
        {{-- Left Block Start --}}
        <div class="col-md-6">
            <div class="jumbotron p-3">
                <span class="h5 d-block">Shipping Address</span>
                <input id="shipping1" class="form-control" type="text" name="shippingAddress" value="@if($data[1]->shopAddress){{$data[1]->shopAddress}}@endif" required>
            </div>
            <div class="jumbotron p-3">
                <span class="h5 d-block">Tips</span>
                <ul>
                    <li>If you change the address, It will also updated in the database</li>
                    <li>Cart is Session Based</li>
                </ul>

                <span class="h5 d-block">Mobile Payment</span>
                <ul>
                    <li>Scan the QR Code on Said App</li>
                    <li>By Scanning you will get the Distributor's account details</li>
                    <li>Pay your bill, and enter the Transaction ID correctly</li>
                    <li><strong>NOTE:</strong> Multiple QR Codes will appear in case multiple distributors involved in the order</li>
                </ul>
            </div>
        </div>
        {{-- Left Block End --}}

        {{-- Right Block Start --}}
        <div class="col-md-6">
            {{-- Cash On Delivery Start --}}
            <div class="jumbotron p-1">
                <div class="card">
                    <div class="card-header">
                        <span class="h5">Credit Card Details</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/ordercheckout" id="form1">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="retailerid" value="{{$data[1]->RetailerShopId}}">
                            <input id="shipping2" type="hidden" name="shippingAddress" value="">
                            <label for="holdername">Card Holder Name</label>
                            <input type="text" class="form-control" name="holdername" id="holdername" value="@if($data[2]){{$data[2]->CardHolderName}}@endif" required>

                            @error('holdername')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="cardnumber" class="mt-2">Card Number</label>
                            <input type="text" class="form-control" name="cardnumber" id="cardnumber" maxlength="16" pattern="[0-9]{16}" required value="@if($data[2]){{$data[2]->CardNumber}}@endif">

                            @error('cardnumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="mt-2" for="expirydate">Expiry Date</label>
                            <div class="input-group" id="expirydate">
                                <input class="form-control" type="text" name="expirymonth" id="expirymonth" placeholder="mm" maxlength="2" pattern="[0-9]{2}" required value="@if($data[2]){{$data[2]->ExpiryMonth}}@endif">
                                <input class="form-control" type="text" name="expiryyear" id="expiryyear" placeholder="yy" maxlength="2" pattern="[0-9]{2}" required value="@if($data[2]){{$data[2]->ExpiryYear}}@endif">
                            </div>

                            @error(['expirymonth', 'expiryyear'])
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="mt-2" for="cvv">CVV Code</label>
                            <input class="form-control" type="text" name="cvv" id="cvv" placeholder="0000" maxlength="4" pattern="[0-9]{4}" required value="@if($data[2]){{$data[2]->cvv}}@endif">

                            @error('cvv')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <button type="button" class="btn btn-primary btn-block mt-2">
                                <span class="float-left">Final Payment</span>
                                <span class="float-right">{{$data[0]->sum('totalprice')}} PKR</span>
                            </button>

                            <button id="submitbtn" type="submit" class="btn btn-success btn-block mt-2">Pay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Right Block End --}}
    </div>
    <script>
        var submitbtn = document.getElementById('submitbtn').addEventListener('click', function(event){
            event.preventDefault();
            document.getElementById('shipping2').value = document.getElementById('shipping1').value;
            document.getElementById('form1').submit();
        });
    </script>
@endsection
