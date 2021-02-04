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
                @user ('Retailer')
                    {{-- Show these if logged in user is Retailer --}}
                    <li class="list-group-item">Shop Name: {{$data->retailershop->RetailerShopName}}</li>
                    <li class="list-group-item">Liscence No: {{$data->retailershop->LiscenceNo}}</li>
                    <li class="list-group-item">Region: {{$data->retailershop->Region}}</li>
                    <li class="list-group-item">Contact Number: {{$data->retailershop->ContactNumber}}</li>
                    <li class="list-group-item">User Type: {{$data->UserType}}</li>
                @elseuser ('Distributor')
                    {{-- Show these if logged in user is Distributor --}}
                    <li class="list-group-item">Shop Name: {{$data->distributorshop->DistributorShopName}}</li>
                    <li class="list-group-item">Liscence No: {{$data->distributorshop->LiscenceNo}}</li>
                    <li class="list-group-item">Region: {{$data->distributorshop->Region}}</li>
                    <li class="list-group-item">Contact Number: {{$data->distributorshop->ContactNumber}}</li>
                    <li class="list-group-item">User Type: {{$data->UserType}}</li>
                @enduser
            </ul>
        </div>
    </div>
</div>
@endsection
