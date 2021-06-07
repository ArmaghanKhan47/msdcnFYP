@extends('layouts.app2')
@section('content')
    <div class="container">
        <div class="row">
            @if (count($data) > 0)
                @foreach ($data as $package)
                    <div class="col-md-4">
                            <div class="jumbotron">
                                <span class="h3 d-block">{{$package->PackageName}}</span>
                                <hr>
                                <span class="h6 d-block text-muted">{{$package->PackagePrice}} PKR</span>
                                <span class="h6 d-block text-muted">Last {{$package->PackageDuration}} Month(s)</span>
                                <span class="h6 d-block text-muted">Mobile App: @if($package->supportApi){{"YES"}}@else{{"NO"}}@endif</span>
                                <a class="btn btn-secondary" href="{{route('subscription.show', [$package->PackageId])}}">Subscribe</a>
                            </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
