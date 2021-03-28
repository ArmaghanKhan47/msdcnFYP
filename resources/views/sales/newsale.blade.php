@extends('layouts.app')
@section('content')
    {{-- Heading --}}
    <div class="jumbotron p-3">
        <span class="h1 d-block">New Sale</span>
    </div>

    {{-- Sale Item List --}}
    <div class="container-fluid p-0">
        {{-- Top Search Bar --}}
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Quantity</span>
                        </div>
                        <input id="quantity" class="form-control" type="number" pattern="[0-9]+">
                    </div>
                </div>
                <div class="col-md-6">
                        <div class="input-group">
                            <input id="searchinput" type="text" class="form-control" list="searchresults" inventoryid='0'>
                            <div class="input-group-append">
                                <button id="btnadd" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                      </svg>
                                </button>
                            </div>
                        </div>
                        <datalist id="searchresults">
                            {{-- Show Search Results Here --}}
                        </datalist>
                </div>
            </div>
        </div>

        <hr>
        {{-- Item List --}}
        <div id="item-list" class="container-fluid p-0">
        </div>

        <hr>
        {{-- Bill Payment Info --}}
        <div class="container">
            <div class="jumbotron p-2 mb-1">
                {{-- Total Row --}}
                <div class="row">
                    <div class="col-md-6 h5">Total</div>
                    <div class="col-md-6 h5 text-right" id="total"></div>
                </div>

                <div class="row">
                    <div class="col-md-6 h5">G.S.T 16%</div>
                    <div class="col-md-6 h5 text-right" id="gst"></div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-6 h5">Total</div>
                    <div class="col-md-6 h5 text-right" id="total2"></div>
                </div>

                {{-- Discount Row --}}
                <div class="row">
                    <div class="col-md-6 h5">Discount</div>
                    <div class="col-md-6 h5 text-right" id="discount">
                    </div>
                </div>

                <hr>
                {{-- Grand Total Row --}}
                <div class="row">
                    <div class="col-md-6 h5">Grand Total</div>
                    <div class="col-md-6 h5 text-right" id="grandtotal"></div>
                </div>
            </div>
            <button id="checkout" class="btn btn-success btn-block">Checkout</button>
        </div>
        <form id="hidden-form" class="d-none" action="{{route('sales.newsale')}}" method="POST">
            @csrf
            <input type="hidden" name="total">
            <input type="hidden" name="discount">
            <input type="hidden" name="grandtotal">
            <input type="hidden" name="medicine">
        </form>
        <script>

            function discountFunction(){
                var value = parseInt($(this).text());
                var input = document.createElement('input');
                $(input).addClass('form-control').val(value);
                $(this).html(input);
                $(this).unbind('click');

                $(input).change(function(){
                    var value = $(this).val();
                    $(this).remove();
                    $('#discount').html(value).bind('click', discountFunction);

                    var total2 = parseFloat($('#total2').html());
                    $('#grandtotal').html(total2 - value);
                });
            }

            window.onload = function(){
                //Custom JQuery Start

                $('#discount').click(discountFunction);

                //Custom JQuery End
            }

            function calculatePrice(item_list)
            {
                var childs = $(item_list).find('span.h5.d-block');
                var totalprice = 0;
                for (var i = 3; i < childs.length; i = i + 4)
                {
                    totalprice = totalprice + parseInt($(childs[i]).text());
                }
                var gst = (totalprice * (16/100)).toFixed(2);
                var total2 = totalprice + parseFloat(gst);
                var discount = 0;
                var grandtotal = (total2 - discount).toFixed(2);

                //put values in their places
                $('div#total').text(totalprice);
                $('div#gst').text(gst);
                $('div#total2').text(total2);
                $('div#discount').text(discount);
                $('div#grandtotal').text(grandtotal);
            }

            function populateDataList(parent, medicineid, unitprice, name, company, inventoryid)
            {
                //Function to populate datalist or select menu
                var option = document.createElement('option');
                $(option).attr({'unitprice': unitprice, 'medicineid':medicineid, 'company':company, 'value':name, 'inventoryid': inventoryid});
                $(option).text(name);
                $(parent).append(option);
            }

            function createItem(name, company, unitprice, medicineid, inventoryid)
            {
                //check that same item already exit or not
                var el;
                if($('div[medicineid = ' + medicineid +']').length)
                {
                    //update its quantity and subtotal price
                    var childs = $('div[medicineid = ' + medicineid +']').find('div.col-md-3');
                    var quantity = $(childs[1]).find('span.h5.d-block');
                    var subtotal = $(childs[3]).find('span.h5.d-block');
                    quantity.text(parseInt(quantity.text()) + parseInt($('input#quantity').val()));
                    subtotal.text(parseInt(quantity.text()) * unitprice );
                }
                else
                {
                    //creating main jumbotron
                    var div_jumbotron_p_2 = document.createElement('div');
                    $(div_jumbotron_p_2).addClass('jumbotron p-2 mb-1').attr({'medicineid': medicineid, 'inventoryid': inventoryid});
                    $(div_jumbotron_p_2).click(function(){
                        $(this).remove();
                        calculatePrice($('#item-list'));
                    });

                    //creating row div
                    var div_row = document.createElement('div');
                    $(div_row).addClass('row text-center');

                    var values = [name, $('input#quantity').val(), unitprice, ($('input#quantity').val() * unitprice)];
                    var keys = [company, 'Quantity', 'Unit Price', 'Subtotal'];
                    for (var i = 0; i < values.length; i++)
                    {
                        //creating column div
                        var div_col_md_3 = document.createElement('div');
                        $(div_col_md_3).addClass('col-md-3');

                        var span_h5 = document.createElement('span');
                        $(span_h5).addClass('h5 d-block').text(values[i]);

                        var span_h6 = document.createElement('span');
                        $(span_h6).addClass('h6 text-muted').text(keys[i]);
                        $(div_col_md_3).append([span_h5, span_h6]);

                        $(div_row).append(div_col_md_3);
                    }
                    $(div_jumbotron_p_2).append(div_row);
                    return div_jumbotron_p_2;
                }
            }

            var searchtext = document.getElementById('searchinput');
            searchtext.addEventListener('input', function(){
                var q = searchtext.value;
                if (q == '')
                {
                    alert('Please Enter medicine name');
                    abort();
                }
                var ques = q.trim().toLowerCase();
                var httpobj = new XMLHttpRequest();
                httpobj.onreadystatechange = function()
                {
                    if (this.status == 200 && this.readyState == 4)
                    {
                        var arr = JSON.parse(this.responseText);
                        var datalist = document.getElementById('searchresults');
                        datalist.innerHTML = '';
                        try{
                            arr.forEach(function(element){
                            populateDataList(datalist, element['medicine']['MedicineId'], element['UnitPrice'], element['medicine']['MedicineName'], element['medicine']['MedicineCompany'], element['InventoryId']);
                        });
                        }
                        catch(TypeError)
                        {
                            var s = Object.values(arr)
                            $('input#quantity').attr({'value':1, 'max':s[0]['Quantity']});
                            populateDataList(datalist, s[0]['medicine']['MedicineId'], s[0]['UnitPrice'], s[0]['medicine']['MedicineName'], s[0]['medicine']['MedicineCompany'], s[0]['InventoryId']);
                        }
                    }
                };

                httpobj.open("POST", "{{route('inventory.search.retailer')}}", true);
                httpobj.setRequestHeader("X-CSRF-TOKEN",  "{{ csrf_token() }}");
                httpobj.setRequestHeader("accept",  "application/json");
                httpobj.setRequestHeader("query",  ques);
                httpobj.send();
            });

            document.getElementById('btnadd').addEventListener('click', function(){
                if (searchtext.value.trim() != '')
                {
                    var val = $('option[value=\"' + searchtext.value + '\"]');
                    var company = val.attr('company');
                    var name = val.attr('value');
                    var unitprice = val.attr('unitprice');
                    var medicineid = val.attr('medicineid');
                    var inventoryid = val.attr('inventoryid');

                    //getting item list
                    $('#item-list').append(createItem(name, company, unitprice, medicineid, inventoryid));
                    //Calculate Price
                    calculatePrice($('#item-list'));
                }
                else
                {
                    alert('Please select medicine');
                }
            });

           document.getElementById('checkout').addEventListener('click', function(event){
               //get medicine list
               var medicines = [];
               var list = $('div#item-list').children();
               if (list.length != 0)
               {
                   for(var i = 0; i < list.length; i++)
                   {
                       var medicineid = $(list[i]).attr('medicineid');
                       var inventoryid = $(list[i]).attr('inventoryid');
                       var spans = $(list[i]).find('span.h5.d-block');
                       var medicine = {'inventoryid' : inventoryid, 'medicineid' : medicineid, 'quantity' : $(spans[1]).text(), 'subtotal' : $(spans[3]).text()};
                       medicines.push(medicine);
                   }

                   //Filling the hidden form
                   $('form#hidden-form input[name=total]').val($('div#total2').text());
                   $('form#hidden-form input[name=discount]').val($('div#discount').text());
                   $('form#hidden-form input[name=grandtotal]').val($('div#grandtotal').text());
                   $('form#hidden-form input[name=medicine]').val(JSON.stringify(medicines));

                   //submitting the hidden form
                   $('form#hidden-form').submit();
               }
               else
               {
                    alert('Please Enter Items');
               }
           });
        </script>
    </div>
@endsection
