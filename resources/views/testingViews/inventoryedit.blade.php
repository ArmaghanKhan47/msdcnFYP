@extends('layouts.app')
@section('content')
<div class="jumbotron p-3">
    <span class="h1 d-block">Update Medicine</span>
</div>
<form action="/inventory/{{$data->inventories[0]->InventoryId}}" method="POST">
    @method('PUT')
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="jumbotron p-1">
                    <div class="card">
                        <img src="/storage/medicines/{{$data->inventories[0]->medicine->MedicinePic}}">
                        <div class="card-body">
                            <span class="h5 d-block">{{$data->inventories[0]->medicine->MedicineName}} - {{$data->inventories[0]->medicine->MedicineType}}</span>
                            <span class="h6 d-block text-muted">By {{$data->inventories[0]->medicine->MedicineCompany}}</span>
                            <span class="h6 d-block text-muted">
                                Contains
                                @foreach (json_decode($data->inventories[0]->medicine->MedicineFormula) as $item)
                                    {{$item}},
                                @endforeach
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="jumbotron p-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Quantity</span>
                        </div>
                        <input name="quantity" id="quantity" type="number" class="form-control" min="1" value="{{$data->inventories[0]->Quantity}}" max="1000">
                      </div>

                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">Unit Price</span>
                          </div>
                          <input name="unitprice" id="unitprice" type="number" step="any" class="form-control" value="{{$data->inventories[0]->UnitPrice}}" min="0" max="10000">
                      </div>
                </div>

                <div class="jumbotron p-4">
                    <span class="h1">Discription</span>
                    <p>{{$data->inventories[0]->medicine->MedicineDiscription}}</p>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">

                    <button class="btn btn-success" type="submit">Save Changes</button>

                <a class="btn btn-danger float-right" href="{{url()->previous()}}">Discard</a>
            </div>
        </div>
    </div>
</form>
@endsection
