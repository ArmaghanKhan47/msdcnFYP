@extends('layouts.app')
@section('content')
    @include('navbars.navbar2')
    <div class="row">
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
            </div>
        </div>
        <div class="col-md-6">
            <div class="jumbotron p-1">
                <div id="card-cod" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="h5">Cash on Delivery</span>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <input id="radio-input-cod" type="radio" class="float-right form-check-input">
                            </div>
                        </div>
                    </div>
                    <div id="card-body-cod" class="card-body d-none">
                        <form method="POST" action="/ordercheckout" id="form-cod">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="retailerid" value="{{$data[1]->RetailerShopId}}">
                            <input id="shipping-cod" type="hidden" name="shippingAddress" value="">
                            <input type="hidden" name="paymentMethod" value="0">

                            <button type="button" class="btn btn-primary btn-block mt-2">
                                <span class="float-left">Final Payment</span>
                                <span class="float-right">{{$data[0]->sum('totalprice')}} PKR</span>
                            </button>

                            <button id="submit-btn-cod" type="submit" class="btn btn-success btn-block mt-2">Proceed</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Credit Card Start --}}
            <div class="jumbotron p-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="h5">Credit Card Details</span>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <input id="radio-input-credit" type="radio" class="float-right form-check-input">
                            </div>
                        </div>
                    </div>
                    <div id="card-body-credit" class="card-body d-none">
                        <form method="POST" action="/ordercheckout" id="form-credit">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="retailerid" value="{{$data[1]->RetailerShopId}}">
                            <input id="shipping-credit" type="hidden" name="shippingAddress" value="">
                            <input type="hidden" name="paymentMethod" value="1">

                            <label for="holdername">Card Holder Name</label>
                            <input type="text" class="form-control" name="holdername" id="holdername" value="@if($data[2]){{$data[2]->CardHolderName}}@endif" required>

                            @error('holdername')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="cardnumber" class="mt-2">Card Number</label>
                            <input type="text" class="form-control" name="cardnumber" id="cardnumber" max="16" pattern="[0-9]{16}" required value="@if($data[2]){{$data[2]->CardNumber}}@endif">

                            @error('cardnumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="mt-2" for="expirydate">Expiry Date</label>
                            <div class="input-group" id="expirydate">
                                <input class="form-control" type="text" name="expirymonth" id="expirymonth" placeholder="mm" max="2" pattern="[0-9]{2}" required value="@if($data[2]){{$data[2]->ExpiryMonth}}@endif">
                                <input class="form-control" type="text" name="expiryyear" id="expiryyear" placeholder="yy" max="2" pattern="[0-9]{2}" required value="@if($data[2]){{$data[2]->ExpiryYear}}@endif">
                            </div>

                            @error(['expirymonth', 'expiryyear'])
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="mt-2" for="cvv">CVV Code</label>
                            <input class="form-control" type="text" name="cvv" id="cvv" placeholder="0000" max="4" pattern="[0-9]{4}" required value="@if($data[2]){{$data[2]->cvv}}@endif">

                            @error('cvv')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <button type="button" class="btn btn-primary btn-block mt-2">
                                <span class="float-left">Final Payment</span>
                                <span class="float-right">{{$data[0]->sum('totalprice')}} PKR</span>
                            </button>

                            <button id="submit-btn-credit" type="submit" class="btn btn-success btn-block mt-2">Pay</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Credit Card End --}}
        </div>
    </div>
    <script>
        window.onload = function()
        {
            //Custom JQuery Start

            $('#radio-input-cod').change(function(){
                //Cash on Delievery
                $('#radio-input-credit').prop('checked', false);
                $('#submit-btn-credit').addClass('disabled');
                $('#submit-btn-cod').removeClass('disabled');
                $('#card-body-credit').fadeOut().removeClass('d-block').addClass('d-none');
                $('#card-body-cod').fadeIn().addClass('d-block').removeClass('d-none');

                $('#submit-btn-cod').click(function(event){
                    event.preventDefault();
                    $('#shipping-cod').val($('#shipping1').val());
                    $('#form-cod').submit();
                });
            });

            $('#radio-input-credit').change(function(){
                //Credit Card
                $('#radio-input-cod').prop('checked', false);
                $('#submit-btn-cod').addClass('disabled');
                $('#submit-btn-credit').removeClass('disabled');
                $('#card-body-cod').fadeOut().removeClass('d-block').addClass('d-none');
                $('#card-body-credit').fadeIn().addClass('d-block').removeClass('d-none');

                $('#submit-btn-credit').click(function(event){
                    event.preventDefault();
                    $('#shipping-credit').val($('#shipping1').val());
                    $('#form-credit').submit();
                });
            });

            //Custom JQuery End
        }
    </script>
@endsection
