@extends('layouts.app')
@section('content')
    @include('testingViews.navbar2')
    {{-- @foreach ($data as $distributor)
        <div class="container">
            <p class="h3">{{$distributor->DistributorShopName}}</p>
            <table class="table">
                <tr>
                    <th>Medicine Name</th>
                    <th>Medicine Company</th>
                    <th>Medicine Formula</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Action</th>
                </tr>
                @foreach ($distributor->inventories as $item)
                    <tr>
                        <td>{{$item->medicine->MedicineName}}</td>
                        <td>{{$item->medicine->MedicineCompany}}</td>
                        <td>
                            @foreach (json_decode($item->medicine->MedicineFormula) as $formula)
                                <button class="btn btn-info disabled">{{$formula}}</button>
                            @endforeach
                        </td>
                        <td>{{$item->Quantity}}</td>
                        <td>{{$item->UnitPrice}}</td>
                        <td>
                            <a class="btn btn-success" href="#nolink">Add to cart</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endforeach --}}

    <div class="container">
        @foreach ($data->chunk(4) as $row)
            <div class="row mt-5">
            @foreach ($row as $item)
                <div class="col-xl-3">
                    <ul class="list-group">
                        <li class="list-group-item active">Medicine Name: {{$item->medicine->MedicineName}}</li>
                        <li class="list-group-item">Company Name: {{$item->medicine->MedicineCompany}}</li>
                        <li class="list-group-item">Formula:
                            @foreach (json_decode($item->medicine->MedicineFormula) as $tag)
                                <button class="btn btn-info disabled">{{$tag}}</button>
                            @endforeach
                        </li>
                        <li class="list-group-item">Price: {{$item->UnitPrice . ' PKR'}}</li>
                        <li class="list-group-item">
                            <a class="btn btn-primary" href="/medicine/{{$item->medicine->MedicineId}}/detail">View Details</a>
                        </li>
                    </ul>
                </div>
            @endforeach
            </div>
        @endforeach
    </div>
@endsection
