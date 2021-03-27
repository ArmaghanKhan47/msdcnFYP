@extends('layouts.app2')
@section('content')
    <div class="row">
        <div class="col-md-6">
            {{-- Package Details --}}
            <div class="jumbotron">
                <span class="h3 d-block">{{$package[0]->PackageName}}</span>
                <span class="h6 d-block text-muted">{{$package[0]->PackagePrice}} PKR</span>
                <span class="h6 d-block text-muted">Last {{$package[0]->PackageDuration}} Month(s)</span>
                <hr>
                <div>
                    <ul>
                        <li>Your Credit Card info will be saved</li>
                        <li>Credit Card detail will automatically filled up if exist</li>
                        <li>Enter 16 digit Credit Card Number</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            {{-- Credit Card Info --}}
            <div class="jumbotron p-1">
                <div class="card">
                    <div class="card-header">
                        <span class="h5">Credit Card Details</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('subscription.update', [$package[0]->PackageId])}}">
                            @csrf
                            @method('PUT')
                            <label for="holdername">Card Holder Name</label>
                            <input type="text" class="form-control" name="holdername" id="holdername" value="{{Auth::user()->name}}">

                            @error('holdername')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="cardnumber" class="mt-2">Card Number</label>
                            <input type="text" class="form-control" name="cardnumber" id="cardnumber" max="16" pattern="[0-9]{16}" required value="@if($package[1]){{$package[1]->CardNumber}}@endif">

                            @error('cardnumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="mt-2" for="expirydate">Expiry Date</label>
                            <div class="input-group" id="expirydate">
                                <input class="form-control" type="text" name="expirymonth" id="expirymonth" placeholder="mm" max="2" pattern="[0-9]{2}" required value="@if($package[1]){{$package[1]->ExpiryMonth}}@endif">
                                <input class="form-control" type="text" name="expiryyear" id="expiryyear" placeholder="yy" max="2" pattern="[0-9]{2}" required value="@if($package[1]){{$package[1]->ExpiryYear}}@endif">
                            </div>

                            @error(['expirymonth', 'expiryyear'])
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="mt-2" for="cvv">CVV Code</label>
                            <input class="form-control" type="text" name="cvv" id="cvv" placeholder="0000" max="4" pattern="[0-9]{4}" required value="@if($package[1]){{$package[1]->cvv}}@endif">

                            @error('cvv')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <button type="button" class="btn btn-primary btn-block mt-2">
                                <span class="float-left">Final Payment</span>
                                <span class="float-right">{{$package[0]->PackagePrice}} PKR</span>
                            </button>

                            <button type="submit" class="btn btn-success btn-block mt-2">Pay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
