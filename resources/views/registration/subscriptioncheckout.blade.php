@extends('layouts.app2')
@section('content')
    <div class="row">
        <div class="col-md-6">
            {{-- Package Details --}}
            <div class="jumbotron">
                <span class="h3 d-block">{{$package[0]->PackageName}}</span>
                <hr>
                <span class="h6 d-block text-muted">{{$package[0]->PackagePrice}} PKR</span>
                <span class="h6 d-block text-muted">Last {{$package[0]->PackageDuration}} Month(s)</span>
                <span class="h6 d-block text-muted">Mobile App: @if($package[0]->supportApi){{"YES"}}@else{{"NO"}}@endif</span>
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

            @include('paymentmethod.paymentmethods', [
                'purpose' => 'subscriptioncheckout',
                'cod' => false,
                'creditcard' => (object) [
                    'enable' => true,
                    'data' => $package[1]
                ],
                'mobilepayment' => (object) [
                    'enable' => true,
                    'data' => [$package[2]]
                ],
                'finalpayment' => $package[0]->PackagePrice,
                'formroute' => route('subscription.update', [$package[0]->PackageId])
            ])
        </div>
    </div>
@endsection
