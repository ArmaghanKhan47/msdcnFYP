@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-xl-2">
        <div class="card-header">
            <p class="display-4">{{$data->UserType}} Info</p>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">Name: {{$data->name}}</li>
                <li class="list-group-item">Email: {{$data->email}}</li>
                <li class="list-group-item">Account Status:
                    @if ($data->AccountStatus == "ACTIVE")
                        <span class="btn btn-success disabled">{{$data->AccountStatus}}</span>
                    @elseif ($data->AccountStatus == "DEACTIVE")
                    <span class="btn btn-danger disabled">{{$data->AccountStatus}}</span>
                    @endif
                </li>
                <li class="list-group-item">Shop Name: {{$data->retailershop->RetailerShopName}}</li>
                <li class="list-group-item">Liscence No: {{$data->retailershop->LiscenceNo}}</li>
                <li class="list-group-item">Region: {{$data->retailershop->Region}}</li>
                <li class="list-group-item">Contact Number: {{$data->retailershop->ContactNumber}}</li>
                <li class="list-group-item">User Type: {{$data->UserType}}</li>
            </ul>
        </div>
    </div>

    <p class="display-4">Subscription History</p>
<table class="table table-striped">
    <tr>
        <td>Package Name</td>
        <td>Package Price</td>
        <td>Package Duration</td>
        <td>Start Date</td>
        <td>End Date</td>
    </tr>
    @if (count($data->retailershop->subscriptions) > 0)
        @foreach ($data->retailershop->subscriptions as $row)
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
</div>
@endsection
