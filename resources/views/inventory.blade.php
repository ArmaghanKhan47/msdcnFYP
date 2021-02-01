@extends('layouts.app')
@section('content')
<p class="display-4">Medicine Inventory</p>
<table class="table table-striped">
    <tr>
        <th>Medicine Name</th>
        <th>Medicine Formula</th>
        <th>Medicine Company</th>
        <th>Medicine Type</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Action</th>
    </tr>
    @if (count($info->inventories) > 0)
        @foreach ($info->inventories as $row)
            <tr>
                <td>{{$row->medicine->MedicineName}}</td>
                <td>
                    @foreach (json_decode($row->medicine->MedicineFormula) as $item)
                        <button class="btn btn-info disabled">{{$item}}</button>
                    @endforeach
                </td>
                <td>{{$row->medicine->MedicineCompany}}</td>
                <td>{{$row->medicine->MedicineType}}</td>
                <td>{{$row->Quantity}}</td>
                <td>{{$row->UnitPrice}}</td>
                <td>
                    <a class="btn btn-primary" href="inventory/{{$row->InventoryId}}/edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                      </svg></a>
                    <a class="btn btn-danger disabled" href="#nolink"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                      </svg></a>
                </td>
            </tr>
        @endforeach
    @else
        <p>No Record Found</p>
    @endif
</table>
@endsection
