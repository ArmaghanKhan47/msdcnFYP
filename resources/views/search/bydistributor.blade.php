<div class="container">
    <span class="h5">Records Found: {{count($data->inventories)}}</span>
</div>
    @foreach ($data->inventories->chunk(4) as $row)
        <div class="row mt-5">
        @foreach ($row as $item)
            <div class="col-xl-3">
                <ul class="list-group">
                    <li class="list-group-item active">Medicine Name: {{$item->medicine->MedicineName}}</li>
                    <li class="list-group-item">Company Name: {{$item->medicine->MedicineCompany}}</li>
                    <li class="list-group-item">Distributor Name: {{$data->DistributorShopName}}</li>
                    <li class="list-group-item">Formula:
                        @foreach (json_decode($item->medicine->MedicineFormula) as $tag)
                            <button class="btn btn-info disabled">{{$tag}}</button>
                        @endforeach
                    </li>
                    <li class="list-group-item">Price: {{$item->UnitPrice . ' PKR'}}</li>
                    <li class="list-group-item">
                        <a class="btn btn-primary" href="/medicine/{{$item->MedicineId}}/detail/{{$data->DistributorShopId}}">View Details</a>
                    </li>
                </ul>
            </div>
        @endforeach
        </div>
    @endforeach
