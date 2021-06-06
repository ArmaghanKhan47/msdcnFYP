@extends('layouts.app')
@section('content')
<div class="jumbotron p-3 mb-3">
    <div class="row">
        <div class="col-md-10">
            <span class="h1 d-block">Medicine Inventory</span>
        </div>
        <div class="p-2 col-md-2 d-flex align-items-middle justify-content-end">
            <span>
                <a href="{{route('inventory.create')}}" class="btn btn-success">Add Item</a>
            </span>
        </div>
    </div>
</div>

@include('svgarts.empty', ['count' => !count($info->inventories)])

<div class="container-fluid p-0 m-0">
        @foreach ($info->inventories as $row)
            <div class="jumbotron p-2 mb-1">
                <div class="row p-1">
                    <div class="col-md-2">
                        <span class="h5 d-block">{{$row->medicine->MedicineName}}
                            @if ($row->Quantity < 5)
                                @user('Retailer')
                                    <a href="{{route('order.quick', [$row->medicine->MedicineName])}}">
                                        <span class="text-danger" title="Please Restock, Click Me">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                                                <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                                                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                            </svg>
                                        </span>
                                    </a>
                                @elseuser('Distributor')
                                    <span class="text-danger" title="Please Restock">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                                            <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                        </svg>
                                    </span>
                                @enduser
                            @endif
                        </span>
                        <span class="h6 text-muted">Medicine Name</span>
                    </div>
                    <div class="col-md-3">
                        <span class="h5 d-block">{{implode(",", json_decode($row->medicine->MedicineFormula))}}</span>
                        <span class="h6 text-muted">Fomula</span>
                    </div>
                    <div class="col-md-2">
                        <span class="h5 d-block">{{$row->medicine->MedicineCompany}}</span>
                        <span class="h6 text-muted">Company</span>
                    </div>
                    <div class="col-md-1">
                        <span class="h5 d-block">{{$row->medicine->MedicineType}}</span>
                        <span class="h6 text-muted">Type</span>
                    </div>
                    <div class="col-md-1">
                        <span class="h5 d-block">{{$row->Quantity}}</span>
                        <span class="h6 text-muted">Quantity</span>
                    </div>
                    <div class="col-md-1">
                        <span class="h5 d-block">{{$row->UnitPrice}}</span>
                        <span class="h6 text-muted">Unit Price</span>
                    </div>
                    <div class="col-md-2 d-flex align-items-center justify-content-end">
                        <span class="mr-1">
                            <a class="btn btn-primary" href="inventory/{{$row->InventoryId}}/edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                              </svg></a>
                        </span>
                        <span>
                            <form class="d-inline" method="POST" action="{{route('inventory.destroy', [$row->InventoryId])}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" href="#nolink"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                  </svg></button>
                              </form>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
</div>
@endsection
