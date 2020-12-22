@extends('layouts.app')
@section('content')
    @include('testingViews.navbar2')
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="jumbotron p-1">
                    <ul class="list-group bg-light list-group-flush">
                        <img src="asset('storage/img/brufin.jpg')">
                        <li class="list-group-item">Medicine Name: {{$data->MedicineName}}</li>
                        <li class="list-group-item">Company Name: {{$data->MedicineCompany}}</li>
                        <li class="list-group-item">Formula:
                            @foreach (json_decode($data->MedicineFormula) as $item)
                                <button class="btn btn-info disabled">{{$item}}</button>
                            @endforeach
                        </li>
                        <li class="list-group-item">Medicine Type: {{$data->MedicineType}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="jumbotron">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="jumbotron p-4">
                    <span class="h1">Discription</span>
                    <p>{{$data->MedicineDiscription}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
