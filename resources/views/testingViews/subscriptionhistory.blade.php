@extends('layouts.app')
@section('content')
<div class="jumbotron p-3">
    <span class="h1 d-block">Subscription History</span>
</div>
    @if (count($data) > 0)
        @foreach ($data as $row)
            <div class="jumbotron p-3 mb-1">
            <div class="row p-1">
                <div class="col-md-3 text-center">
                    <span class="h5 d-block">{{$row->package->PackageName}}</span>
                    <span class="h6 d-block text-muted">Package Name</span>
                </div>
                <div class="col-md-3 text-center">
                    <span class="h5 d-block">{{$row->package->PackageDuration}}</span>
                    <span class="h6 d-block text-muted">Duration (Months)</span>
                </div>
                <div class="col-md-3 text-center">
                    <span class="h5 d-block">{{$row->startDate}}</span>
                    <span class="h6 d-block text-muted">Start Date</span>
                </div>
                <div class="col-md-3 text-center">
                    <span class="h5 d-block">{{date('Y-m-d', strtotime($row->startDate . "+".(string)$row->package->PackageDuration." months"))}}</span>
                    <span class="h6 d-block text-muted">Ending Date</span>
                </div>
            </div>

                </div>
        @endforeach
    @else
        <p>No Record Found</p>
        <p>Click <a class="btn btn-success" href="{{route('subscription.index')}}">Here</a> to view offers and subscribe</p>
    @endif
@endsection
