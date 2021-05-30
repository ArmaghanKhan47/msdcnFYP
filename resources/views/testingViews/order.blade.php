@extends('layouts.app')
@section('content')
    @include('navbars.navbar2')

    <div class="container" id="orderDisplay">
        <div class="container">
            <span class="h5">Records Found: {{count($data)}}</span>
        </div>
        @if (!count($data))
            <div class="jumbotron p-2 text-center">
                <span class="h5">It seems no medicine is available in your region</span>
            </div>
        @endif
        @foreach ($data->chunk(4) as $row)
            <div class="row mt-1 mt-md-5">
            @foreach ($row as $item)
                <div class="col-xl-3 m-1 m-md-0">
                    <div class="card">
                        <div class="card-body">
                            <span class="h5 d-block">{{$item->medicine->MedicineName}}</span>
                            <span class="h6 text-muted d-block">By {{$item->medicine->MedicineCompany}}</span>
                            <span class="h6 text-muted d-block">{{$item->distributor->DistributorShopName}}</span>
                        </div>
                        <img src="/storage/medicines/{{$item->medicine->MedicinePic}}" alt="https://www.w3schools.com/bootstrap4/img_avatar1.png" class="card-img-top">
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
