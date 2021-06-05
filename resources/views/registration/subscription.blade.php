@extends('layouts.app2')
@section('content')
    <div class="row">
        @if (count($data) > 0)
            @foreach ($data as $package)
                <div class="col-md-4 justify-content-center">
                        <div class="jumbotron jumbotron_apnd text-white justify-content-center">
                            <span class="h3 d-block text-white">{{$package->PackageName}}</span>
                            <hr>
                            <span class="h6 d-block text-white ">{{$package->PackagePrice}} PKR</span>
                            <span class="h6 d-block text-white">Last {{$package->PackageDuration}} Month(s)</span>
                            <span class="h6 d-block text-white">Mobile App: @if($package->supportApi){{"YES"}}@else{{"NO"}}@endif</span>
                            <a class="btn btn-danger" href="{{route('subscription.show', [$package->PackageId])}}">Subscribe</a>
                        </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
