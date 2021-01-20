@extends('layouts.app')
@section('content')
    @include('testingViews.navbar2')
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="jumbotron p-1">
                    <ul class="list-group bg-light list-group-flush">
                        <li class="list-group-item">Medicine Name: {{$data->MedicineName}}</li>
                        <li class="list-group-item">Company Name: {{$data->MedicineCompany}}</li>
                        <li class="list-group-item">Distributor Name: {{$data->inventorydistributor->distributor->DistributorShopName}}</li>
                        <li class="list-group-item">Formula:
                            @foreach (json_decode($data->MedicineFormula) as $item)
                                <button class="btn btn-info disabled">{{$item}}</button>
                            @endforeach
                        </li>
                        <li class="list-group-item">Medicine Type: {{$data->MedicineType}}</li>
                        <li class="list-group-item">Unit Price: <span id="unitprice">{{$data->inventorydistributor->UnitPrice}}</span>{{' PKR'}}</li>
                        <li class="list-group-item">Available Stock: {{$data->inventorydistributor->Quantity}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="jumbotron p-5">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Quantity</span>
                            </div>
                            <input id="quantity" type="number" class="form-control" min="1" max="{{$data->inventorydistributor->Quantity}}" value="1">
                          </div>

                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">Total Price</span>
                              </div>
                              <input id="totalprice" type="number" class="form-control" readonly value="{{$data->inventorydistributor->UnitPrice}}">
                          </div>

                          <input id="btnaddtocart" type="button" value="Add to Cart" class="form-control btn btn-success">
                    </div>
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
        <script>
            document.getElementById('quantity').addEventListener('change', function(){
                var quantity = document.getElementById('quantity').value;
                var unitprice = document.getElementById('unitprice').innerText;
                document.getElementById('totalprice').value = (quantity * unitprice).toFixed(2);
            });

            document.getElementById('btnaddtocart').addEventListener('click', function(){
                alert('Functionality To Be Added');
            });
        </script>
    </div>
@endsection
