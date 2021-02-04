@extends('layouts.app')
@section('content')
    @include('navbars.navbar2')
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="jumbotron p-1">
                    <div class="card">
                        <img src="/storage/img/default.jpg">
                        <div class="card-body">
                            <span class="h5 d-block">{{$data->MedicineName}} - {{$data->MedicineType}}</span>
                            <span class="h6 d-block text-muted">By {{$data->MedicineCompany}}</span>
                            <span class="h6 d-block text-muted">{{$data->inventorydistributor->distributor->DistributorShopName}}</span>
                            <span class="h6 d-block text-muted">
                                Contains
                                @foreach (json_decode($data->MedicineFormula) as $item)
                                    {{$item}},
                                @endforeach
                            </span>
                            <div>
                                <span><span id="unitprice">{{$data->inventorydistributor->UnitPrice}}</span>{{' PKR'}}</span>
                                <span class="float-right">In Stock {{$data->inventorydistributor->Quantity}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="jumbotron p-4">
                    <form method="POST" action="/cart">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="medicineid" value="{{$data->MedicineId}}">
                        <input type="hidden" name="distributorid" value="{{$data->inventorydistributor->distributor->DistributorShopId}}">
                        <input type="hidden" name="unitprice" value="{{$data->inventorydistributor->UnitPrice}}">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Quantity</span>
                            </div>
                            <input id="quantity" name="quantity" type="number" class="form-control" min="1" max="{{$data->inventorydistributor->Quantity}}" value="1" required>
                          </div>

                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">Total Price</span>
                              </div>
                              <input id="totalprice" name="totalprice" type="number" class="form-control" readonly value="{{$data->inventorydistributor->UnitPrice}}" required>
                          </div>

                          <input id="btnaddtocart" type="submit" value="Add to Cart" class="form-control btn btn-success">
                    </div>
                    </form>
                </div>
                <div class="jumbotron p-4">
                    <span class="h1">Discription</span>
                    <p>{{$data->MedicineDiscription}}</p>
                </div>
            </div>
        </div>
        <script>
            //Custom JS to update total price as Quantity Increases or Decreases
            document.getElementById('quantity').addEventListener('change', function(){
                var quantity = document.getElementById('quantity').value;
                var unitprice = document.getElementById('unitprice').innerText;
                document.getElementById('totalprice').value = (quantity * unitprice).toFixed(2);
            });
        </script>
    </div>
@endsection
