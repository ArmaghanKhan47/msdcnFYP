<html>
    <head>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div>
            <h4>Retailer Info</h4>
            <p>Retailer Name: {{$retailerInfo->RetailerName}}</p>
            <p>Shop Name: {{$retailerInfo->RetailerShopName}}</p>
            <p>Contact Number: {{$retailerInfo->ContactNumber}}</p>
            <p>Region: {{$retailerInfo->Region}}</p>
            <p>Account Status: {{$retailerInfo->AccountStatus}}</p>
        </div>
        <table>
            <tr>
                <td>Medicine Name</td>
                <td>Medicine Formula</td>
                <td>Medicine Company</td>
                <td>Medicine Type</td>
                <td>Quantity</td>
                <td>Unit Price</td>
            </tr>
            @if (true)
                @foreach ($retailerInfo->inventories as $row)
                    <tr>
                    <td>{{$row->medicine->MedicineName}}</td>
                    <td>{{$row->medicine->MedicineFormula}}</td>
                    <td>{{$row->medicine->MedicineCompany}}</td>
                    <td>{{$row->medicine->MedicineType}}</td>
                    <td>{{$row->Quantity}}</td>
                    <td>{{$row->UnitPrice}}</td>
                    </tr>
                @endforeach
            @else
                <p>No Record Found</p>
            @endif
        </table>
    </body>
</html>
