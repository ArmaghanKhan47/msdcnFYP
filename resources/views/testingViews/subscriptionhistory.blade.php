@extends('layouts.app')
@section('content')
<p class="display-4">Subscription History</p>
<table class="table table-striped">
    <tr>
        <td>Package Name</td>
        <td>Package Price</td>
        <td>Package Duration</td>
        <td>Start Date</td>
        <td>End Date</td>
    </tr>
    @if (count($data) > 0)
        @foreach ($data as $row)
            <tr>
                <td>{{$row->package->PackageName}}</td>
                <td>{{$row->package->PackagePrice}}</td>
                <td>{{$row->package->PackageDuration}} Months</td>
                <td>{{$row->startDate}}</td>
                <td>{{date('Y-m-d', strtotime($row->startDate . "+".(string)$row->package->PackageDuration." months"))}}</td>
            </tr>
        @endforeach
    @else
        <p>No Record Found</p>
        <p>Click <a class="btn btn-success" href="{{route('subscription.index')}}">Here</a> to view offers and subscribe</p>
    @endif
</table>
@endsection
