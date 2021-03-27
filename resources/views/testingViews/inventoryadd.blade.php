@extends('layouts.app')
@section('content')
<div class="jumbotron p-3">
    <div class="row">
        <div class="col-md-10">
            <span class="h1 d-block">Add New Medicines</span>
        </div>
        <div class="p-2 col-md-2 d-flex align-items-middle justify-content-end">
            <span>
                <button id="btn-add-medicines" class="btn btn-success">Add Medicines</button>
            </span>
        </div>
    </div>
</div>
    <form method="POST" action="{{route('inventory.store')}}" id="form-main">
        @csrf
        @foreach ($medicines as $key => $medicine)
            <div class="jumbotron p-1 mb-1">
                <div class="card">
                    <div class="card-header h4">
                        <div class="row ">
                            <div class="col-md-6">{{$key}} <span class="num-body d-none">(<span class="num-text">0</span>)</span></div>
                            <div class="col-md-6">
                                <span class="float-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                        <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-none">
                        @foreach ($medicine as $med)
                            <div class="row p-1">
                                <div class="col-md-5">
                                    <span class="d-block h5">{{$med->MedicineName}} - {{$med->MedicineType}}</span>
                                    <span class="d-block h6 text-muted">{{implode(', ', json_decode($med->MedicineFormula))}}</span>
                                    <span class="d-block h6 text-muted">{{$med->MedicineCompany}}</span>
                                </div>
                                <div class="col-md-3">
                                    <input name="quantity" type="number" step="1" class="form-control d-block" placeholder="Quantity" value="0" pattern="[0-9]" min="0">
                                    <span class="d-block h6 text-muted mt-1">Quantity</span>
                                </div>
                                <div class="col-md-3">
                                    <input name="unitprice" type="number" step="0.5" class="form-control" placeholder="Unit Price" value="0" pattern="[0-9]" min="0">
                                    <span class="d-block h6 text-muted mt-1">Unit Price</span>
                                </div>
                                <div class="col-md-1 p-2">
                                    <input class="form-check-input ml-3" type="checkbox">
                                </div>
                                <input type="hidden" name="id" value="{{$med->MedicineId}}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        <button type="button" class="btn btn-dark disabled">Make a Request</button>
        {{-- <div class="row justify-content-center">
            <div class="col-md-6 jumbotron p-3">
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

                <button class="btn btn-success mt-2 btn-block" type="submit">Add Item</button>
            </div>
        </div> --}}
    </form>
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

            function removeFromList(ref)
            {
                var parent2 = $(ref).parent().parent();
                var key = parent2.find('input[name=id]').val();
                delete item_list[key];
            }

            $('div.card-header').click(function(){
                var obj = $(this).next();
                if(obj.hasClass('d-none'))
                {
                    obj.removeClass('d-none').addClass('d-block');
                }
                else if (obj.hasClass('d-block'))
                {
                    obj.removeClass('d-block').addClass('d-none');
                }
            });

            $("input[type='checkbox']").click(function(){
                if($(this).is(':checked'))
                {
                    //Checked
                    var parent = $(this).parentsUntil('div.card')[2];
                    var count = parseInt($(parent).prev().find('span.num-text').text());
                    count += 1;
                    $(parent).prev().find('span.num-text').text(count);
                    var num_body = $(parent).prev().find('span.num-body');
                    if (num_body.hasClass('d-none') || count > 0)
                    {
                        num_body.removeClass('d-none').addClass('d-inline');
                    }
                    addToList(this);
                }
                else
                {
                    //Unchecked
                    var parent = $(this).parentsUntil('div.card')[2];
                    var count = parseInt($(parent).prev().find('span.num-text').text());
                    count -= 1;
                    $(parent).prev().find('span.num-text').text(count);
                    var num_body = $(parent).prev().find('span.num-body');
                    if (count <= 0)
                    {
                        num_body.removeClass('d-inline').addClass('d-none');
                    }
                    removeFromList(this);
                }
            });

            $('input[name=quantity], input[name=unitprice]').change(function(){
                if($(this).parent().parent().find('input[type=checkbox]').is(':checked'))
                {
                    removeFromList(this);
                    addToList(this);
                }
            });

            $('#btn-add-medicines').click(function(){
                if(Object.keys(item_list).length != 0)
                {
                    var form = $('#form-main');
                    var hidden_input = document.createElement('input');
                    $(hidden_input).attr('type', 'hidden').attr('name', 'medicine_list').attr('value', JSON.stringify(item_list));
                    form.append(hidden_input);
                    form.submit();
                }
                else
                {
                    alert('Please Select Medicine');
                }
            });
            //End of Custome JQuery
        }
    </script>
@endsection
