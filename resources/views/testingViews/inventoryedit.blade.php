@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="jumbotron p-1">
                    <ul class="list-group bg-light list-group-flush">
                        <li class="list-group-item">Medicine Name: {{$data->inventories[0]->medicine->MedicineName}}</li>
                        <li class="list-group-item">Company Name: {{$data->inventories[0]->medicine->MedicineCompany}}</li>
                        <li class="list-group-item">Formula:
                            @foreach (json_decode($data->inventories[0]->medicine->MedicineFormula) as $item)
                                <button class="btn btn-info disabled">{{$item}}</button>
                            @endforeach
                        </li>
                        <li class="list-group-item">Medicine Type: {{$data->inventories[0]->medicine->MedicineType}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="jumbotron p-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Quantity</span>
                        </div>
                        <input id="quantity" type="number" class="form-control" min="1" value="{{$data->inventories[0]->Quantity}}" max="1000">
                      </div>

                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">Unit Price</span>
                          </div>
                          <input id="totalprice" type="number" class="form-control" value="{{$data->inventories[0]->UnitPrice}}" min="0" max="10000">
                      </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="jumbotron p-4">
                    <span>Discription</span>
                    <p>{{$data->inventories[0]->medicine->MedicineDiscription}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <a class="btn btn-success">Save Changes</a>
                <a class="btn btn-danger float-right" href="{{url()->previous()}}">Discard</a>
            </div>
        </div>
    </div>
@endsection
