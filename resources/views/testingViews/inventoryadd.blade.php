@extends('layouts.app')
@section('content')
<div class="row text-white justify-content-center">
    <span class="h1 d-block">Add New Medicine</span>
</div>

<div class = "p-1 border-danger linear-gradient"></div>

    <form method="POST" action="{{route('inventory.store')}}">
        @csrf
        <div class="row justify-content-center mt-3 ">
            <div class="col-md-6 jumbotron p-3 jumbotron_apnd text-white">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Medicine</label>
                    </div>
                    <select id="medicine" name="medicineid" class="form-control">
                        @foreach ($medicines as $key => $medicine)
                            <option disabled>{{$key}}</option>
                            @foreach ($medicine as $item)
                                <option value="{{$item->MedicineId}}">{{$item->MedicineName}} - {{$item->MedicineCompany}} - {{$item->MedicineType}}</option>
                            @endforeach
                            <option disabled>----------------------------------------------------------------</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach
    </form>
@endsection

@section('scripts')
    <script>
        window.onload = function()
        {
            //Write Custom Jquery here

            var item_list = {};

            function addToList(ref)
            {
                var parent2 = $(ref).parent().parent();
                var key = parent2.find('input[name=id]').val();
                var quantity = parent2.find('input[name=quantity]').val();
                var unitprice = parent2.find('input[name=unitprice]').val();
                var item = [
                    quantity > 0 ? quantity : 0,
                    unitprice > 0 ? unitprice : 0
                ];
                item_list[key] = item;
            }

                <div class="input-group mt-2">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Quantity</label>
                    </div>
                    <input type="number" name="quantity" class="form-control" pattern="[0-9]+" min="0">
                </div>

                <div class="input-group mt-2">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Unit Price</label>
                    </div>
                    <input type="number" name="unitprice" class="form-control" pattern="[0-9]+" min="0" step="any">
                </div>

                <button class="btn btn-danger mt-2 btn-block" type="submit">Add Item</button>
            </div>
        </div>
    </form>
@endsection
