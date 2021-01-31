@extends('layouts.app2')
@section('content')
    <div class="row">
        @if (count($data) > 0)
            @foreach ($data as $package)
                <div class="col-md-4">
                        <div class="jumbotron">
                            <span class="h3 d-block">{{$package->PackageName}}</span>
                            <span class="h6 d-block text-muted">{{$package->PackagePrice}} PKR</span>
                            <span class="h6 d-block text-muted">Last {{$package->PackageDuration}} Month(s)</span>
                            <a class="btn btn-secondary" href="{{route('subscription.show', [$package->PackageId])}}">Subscribe</a>
                        </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
