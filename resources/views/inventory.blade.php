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
        <p>Retailer Name: {{$data[0]->RetailerName}}</p>
        <p>Shop Name: {{$data[0]->RetailerShopName}}</p>
        <p>Contact Number: {{$data[0]->ContactNumber}}</p>
        <p>Region: {{$data[0]->Region}}</p>
        <p>Account Status: {{$data[0]->AccountStatus}}</p>
        </div>
        <table>
            <tr>
                <td>Medicine Name</td>
                <td>Medicine Formula</td>
                <td>Medicine Company</td>
                <td>Quantity</td>
                <td>Unit Price</td>
            </tr>
            @if (count($data[1]) > 0)
                @foreach ($data[1] as $row)
                    <tr>
                    <td>{{$row->MedicineName}}</td>
                    <td>{{$row->MedicineFormula}}</td>
                    <td>{{$row->MedicineCompany}}</td>
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
