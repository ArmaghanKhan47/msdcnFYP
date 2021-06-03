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

            @include('paymentmethod.paymentmethods', [
                'purpose' => 'cartcheckout',
                'cod' => true,
                'creditcard' => (object) [
                    'enable' => true,
                    'data' => $data[2]
                ],
                'mobilepayment' => (object) [
                    'enable' => true,
                    'data' => $data[3]
                ],
                'finalpayment' => $data[0]->sum('totalprice')
                'formroute' => route('order.checkout')
            ])

        </div>
        {{-- Right Block End --}}
    </div>
    {{-- <script>
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
    </script> --}}
@endsection
