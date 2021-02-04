@extends('layouts.app')
@section('content')
    @include('navbars.navbar2')

    <div class="container" id="orderDisplay">
        <div class="container">
            <span class="h5">Records Found: {{count($data)}}</span>
        </div>
        @foreach ($data->chunk(4) as $row)
            <div class="row mt-5">
            @foreach ($row as $item)
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <span class="h5 d-block">{{$item->medicine->MedicineName}}</span>
                            <span class="h6 text-muted d-block">By {{$item->medicine->MedicineCompany}}</span>
                            <span class="h6 text-muted d-block">{{$item->distributor->DistributorShopName}}</span>
                        </div>
                        <img src="/storage/img/default.jpg" alt="https://www.w3schools.com/bootstrap4/img_avatar1.png" class="card-img-top">
                        <div class="card-body">
                                <span>
                                    <strong>{{$item->UnitPrice . ' PKR'}}</strong>
                                </span>
                                <span class="float-right border">
                                    <a class="btn btn-primary" href="/medicine/{{$item->medicine->MedicineId}}/detail/{{$item->distributor->DistributorShopId}}">Details</a>
                                </span>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endforeach
    </div>
@endsection
