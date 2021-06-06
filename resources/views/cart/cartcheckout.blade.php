@extends('layouts.app')
@section('content')
    @include('navbars.navbar2')
    <div class="row m-0">
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
<<<<<<< HEAD
            {{-- Cash On Delivery Start --}}
            <div class="jumbotron p-1">

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
                'finalpayment' => $data[0]->sum('totalprice'),
                'formroute' => route('order.checkout')
            ])

        </div>
        {{-- Right Block End --}}
    </div>
@endsection
