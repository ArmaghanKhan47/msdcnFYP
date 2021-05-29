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
            {{-- Cash On Delivery End --}}

            {{-- Credit Card Start --}}
            <div class="jumbotron p-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="h5">Credit Card Payment</span>
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

                            <button id="submit-btn-credit" type="submit" class="btn btn-success btn-block mt-2">Pay</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Credit Card End --}}

            {{-- Mobile Account Payment Start --}}
            <div class="jumbotron p-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="h5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                                      </svg>
                                    Mobile Account Payment</span>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <input id="radio-input-mobile" type="radio" class="float-right form-check-input">
                            </div>
                        </div>
                    </div>
                    <div id="card-body-mobile" class="card-body d-none">
                        <form method="POST" action="/ordercheckout" id="form-mobile">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="retailerid" value="{{$data[1]->RetailerShopId}}">
                            <input id="shipping-mobile" type="hidden" name="shippingAddress" value="">
                            <input type="hidden" name="paymentMethod" value="2">
                            <input type="hidden" id="transactions-ids" name="transactions-ids">

                            {{-- TODO: Show QRCode for All The Distributors --}}
                            {{-- Per Distributor QRCode will be shown and Transaction Id Input Text will be shown --}}

                            {{-- QrCode Template --}}
                            @foreach ($data[3] as $qrcode)
                                <div class="container p-0">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <span class="h5 mb-1">{{ $qrcode->distributorshopname }}</span>
                                            <img class="d-block m-auto rounded" src="{{asset('storage/mobilebank/qrcode/' . $qrcode->mobilebank->qr_code)}}" alt="No Image Found" height="200px" width="400px">
                                            <span class="h6 mt-1 text-muted">Scan the QR Code on {{$qrcode->mobilebank->acount_provider}}</span>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-outline-primary btn-block">
                                                <span class="float-left">Payment</span>
                                                <span class="float-right">{{$qrcode->amount}} PKR</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">

                                                    <span class="input-group-text">Transaction ID</span>
                                                </div>
                                                <input type="hidden" value="{{$qrcode->distributorshopid}}">
                                                <input type="text" class="form-control input-transactions-id" pattern="[0-9]{11}" maxlength="11" placeholder="Enter 11 digit id">
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mb-3">
                                </div>
                            @endforeach

                            <button type="button" class="btn btn-warning btn-block mt-2">
                                Please Don't Select this, Work in Progress
                            </button>

                            <button type="button" class="btn btn-primary btn-block mt-2">
                                <span class="float-left">Final Payment</span>
                                <span class="float-right">{{$data[0]->sum('totalprice')}} PKR</span>
                            </button>

                            <button id="submit-btn-mobile" type="submit" class="btn btn-success btn-block mt-2">Proceed</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Mobile Account Payment End --}}
        </div>
        {{-- Right Block End --}}
    </div>
    <script>
        window.onload = function()
        {
            //Custom JQuery Start

            $('#radio-input-cod').change(function(){
                //Cash on Delievery
                $('#radio-input-credit').prop('checked', false);
                $('#radio-input-mobile').prop('checked', false);

                $('#submit-btn-credit').addClass('disabled');
                $('#submit-btn-mobile').addClass('disabled');
                $('#submit-btn-cod').removeClass('disabled');

                $('#card-body-credit').fadeOut().removeClass('d-block').addClass('d-none');
                $('#card-body-mobile').fadeOut().removeClass('d-block').addClass('d-none');
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
                $('#radio-input-mobile').prop('checked', false);

                $('#submit-btn-cod').addClass('disabled');
                $('#submit-btn-mobile').addClass('disabled');
                $('#submit-btn-credit').removeClass('disabled');

                $('#card-body-cod').fadeOut().removeClass('d-block').addClass('d-none');
                $('#card-body-mobile').fadeOut().removeClass('d-block').addClass('d-none');
                $('#card-body-credit').fadeIn().addClass('d-block').removeClass('d-none');

                $('#submit-btn-credit').click(function(event){
                    event.preventDefault();
                    $('#shipping-credit').val($('#shipping1').val());
                    $('#form-credit').submit();
                });
            });

            $('#radio-input-mobile').change(function(){
                //Mobile Payment
                $('#radio-input-cod').prop('checked', false);
                $('#radio-input-credit').prop('checked', false);

                $('#submit-btn-cod').addClass('disabled');
                $('#submit-btn-credit').addClass('disabled');
                $('#submit-btn-mobile').removeClass('disabled');

                $('#card-body-cod').fadeOut().removeClass('d-block').addClass('d-none');
                $('#card-body-credit').fadeOut().removeClass('d-block').addClass('d-none');
                $('#card-body-mobile').fadeIn().addClass('d-block').removeClass('d-none');

                $('#submit-btn-mobile').click(function(event){
                    event.preventDefault();
                    $('#shipping-mobile').val($('#shipping1').val());

                    //get TransactionsId
                    let transactions_id = $('.input-transactions-id');
                    let transactions_data = {};
                    transactions_id.each(function(){
                        let transaction_id = $(this).val();
                        let distributor_id = $(this).prev().val();
                        transactions_data[distributor_id] = transaction_id;
                    });
                    $('#transactions-ids').val(JSON.stringify(transactions_data));
                    $('#form-mobile').submit();
                });
            });

            //Custom JQuery End
        }
    </script>
@endsection
