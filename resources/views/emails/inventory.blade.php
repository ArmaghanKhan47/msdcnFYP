@component('mail::message')
# Low Inventory


## Details

 Medicine Name | Quantity
:---------------:|:----------:
@foreach ($inventory as $item)
{{$item->medicine->MedicineName}} | {{$item->Quantity}}
@endforeach


<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
