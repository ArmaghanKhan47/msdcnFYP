<div class="container">
    <span class="h5">Records Found: {{count($data->inventorydistributors)}}</span>
</div>
    @foreach ($data->inventorydistributors->chunk(4) as $row)
        <div class="row mt-5">
        @foreach ($row as $item)
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <span class="h5 d-block">{{$item->medicine->MedicineName}}</span>
                        <span class="h6 text-muted d-block">By {{$item->medicine->MedicineCompany}}</span>
                        <span class="h6 text-muted d-block">{{$item->distributor->DistributorShopName}}</span>
                    </div>
                    <img src="/storage/img/default.jpg" alt="https://www.w3schools.com/bootstrap4/img_avatar1.png" class="card-img-top">
                    <div class="card-body">
                            <span>
                                <strong>{{$item->UnitPrice . ' PKR'}}</strong>
                            </span>
                            <span class="float-right border">
                                <a class="btn btn-primary" href="/medicine/{{$item->medicine->MedicineId}}/detail/{{$item->distributor->DistributorShopId}}">Details</a>
                            </span>
                    </div>
                </div>
                {{-- <ul class="list-group">
                    <li class="list-group-item text-white bg-dark">Medicine Name: {{$data->MedicineName}}</li>
                    <li class="list-group-item">Company Name: {{$data->MedicineCompany}}</li>
                    <li class="list-group-item">Distributor Name: {{$item->distributor->DistributorShopName}}</li>
                    <li class="list-group-item">Formula:
                        @foreach (json_decode($data->MedicineFormula) as $tag)
                            <button class="btn btn-info disabled">{{$tag}}</button>
                        @endforeach
                    </li>
                    <li class="list-group-item">Price: {{$item->UnitPrice . ' PKR'}}</li>
                    <li class="list-group-item">
                        <a class="btn btn-primary" href="/medicine/{{$data->MedicineId}}/detail/{{$item->distributor->DistributorShopId}}">View Details</a>
                    </li>
                </ul> --}}
            </div>
        @endforeach
        </div>
    @endforeach
