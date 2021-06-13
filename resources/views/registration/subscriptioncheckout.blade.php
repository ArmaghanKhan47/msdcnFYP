@extends('layouts.app2')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                {{-- Package Details --}}
                <div class="jumbotron jumbotron_apnd text-white">
                    <span class="h3 d-block">{{$package[0]->PackageName}}</span>
                    <hr>
                    <span class="h6 d-block ">{{$package[0]->PackagePrice}} PKR</span>
                    <span class="h6 d-block ">Last {{$package[0]->PackageDuration}} Month(s)</span>
                    <span class="h6 d-block ">Mobile App: @if($package[0]->supportApi){{"YES"}}@else{{"NO"}}@endif</span>
                    <hr>
                    <div>
                        <ul>
                            <li>Your Credit Card info will be saved</li>
                            <li>Credit Card detail will automatically filled up if exist</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 jumbotron_apnd">

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
    </div>
@endsection
