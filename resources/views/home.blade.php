@extends('layouts.app')

@section('content')
<div class="jumbotron p-3">
    <span class="h1 d-block">@user('Retailer'){{__('Retailer')}}@elseuser('Distributor'){{__('Distributor')}}@enduser Dashboard</span>
</div>
<div class="jumbotron p-3 mb-1">
    <span class="h2 d-block">Sales Graph</span>
    @if($sales and $sales->count() > 0)
    <canvas width="100" height="40px" id="salegraph">
        <p>No Record to show</p>
    </canvas>
    @else
        <div class="jumbotron m-0 p-0 text-center bg-transparent">
            <svg id="fb9e56a7-c7eb-450f-9dbc-3f440cee41b7" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="100%" height="350" viewBox="0 0 816.22047 640.5"><path id="e5b01265-0b4f-4d57-a9fa-5bd80347d7aa" data-name="Path 133" d="M762.25077,420.88246a363.96429,363.96429,0,0,1-17.004,100.61107c-.2298.75594-.48484,1.50053-.733,2.25647h-63.4504c.06662-.67782.13555-1.43391.20224-2.25647,4.23034-48.63622-19.93841-341.12194-49.10262-391.74353C634.71807,133.85636,767.17043,266.34315,762.25077,420.88246Z" transform="translate(-191.88976 -129.75)" fill="#f0f0f0"/><path id="ffdef3f3-76d4-4555-b476-c3b551816dea" data-name="Path 134" d="M757.48951,521.49353c-.53077.75594-1.0823,1.512-1.64758,2.25647H708.23978c.36079-.64346.77894-1.39941,1.26378-2.25647C717.36678,507.302,740.64164,464.87,762.246,420.88246c23.20824-47.27131,44.51843-96.33487,42.7238-114.09253C805.526,310.79264,821.59242,432.8864,757.48951,521.49353Z" transform="translate(-191.88976 -129.75)" fill="#f0f0f0"/><path d="M985.61024,770.25h-586a22.52538,22.52538,0,0,1-22.5-22.5v-284a22.52538,22.52538,0,0,1,22.5-22.5h586a22.52539,22.52539,0,0,1,22.5,22.5v284A22.52539,22.52539,0,0,1,985.61024,770.25Z" transform="translate(-191.88976 -129.75)" fill="#3f3d56"/><rect x="280.76315" y="475" width="438.80322" height="2" fill="#f0f0f0"/><rect x="280.76315" y="515" width="438.80322" height="2" fill="#f0f0f0"/><rect x="280.76315" y="555" width="438.80322" height="2" fill="#f0f0f0"/><g opacity="0.2"><path d="M911.08863,588.46325c-13.02531-14.08411-34.78828-16.73186-53.491-12.46224s-35.4938,14.2598-52.88364,22.36-36.69793,14.48845-55.53654,10.86521c-18.19153-3.49879-33.21915-15.73208-48.82139-25.71924s-34.61163-18.21645-52.25377-12.56592c-21.83727,6.99417-31.899,31.44059-47.58489,48.166a80.69368,80.69368,0,0,1-123.922-7.46944v74.73907H909.9443Z" transform="translate(-191.88976 -129.75)" fill="#1d2124"/></g><rect x="280.76315" y="395" width="438.80322" height="2" fill="#f0f0f0"/><rect x="280.76315" y="435" width="438.80322" height="2" fill="#f0f0f0"/><path d="M475.3002,612.39473c18.69218,25.24477,51.00673,38.20993,81.91642,32.13314a83.66152,83.66152,0,0,0,41.43178-21.4017c10.37985-9.93025,17.51826-22.58477,26.71895-33.5128,4.456-5.29256,9.44009-10.24715,15.444-13.7671a38.96534,38.96534,0,0,1,22.68776-5.127c17.6886,1.28417,32.88145,11.83908,47.13862,21.41117,13.85552,9.30242,28.43661,18.34568,45.52434,19.49492,17.97776,1.20911,35.45823-5.381,51.42117-12.96311,16.33694-7.75978,32.26307-16.99608,50.03455-21.12675,14.47872-3.36532,30.94947-2.72871,43.94441,5.10867a39.85343,39.85343,0,0,1,8.46574,6.87971c1.32523,1.40959,3.44364-.71482,2.12132-2.12132-10.0399-10.679-24.81637-14.95133-39.16035-14.75588-16.73777.22807-32.44429,6.64492-47.30789,13.80359-16.52119,7.957-32.74531,17.10177-50.90124,20.79388a64.41483,64.41483,0,0,1-27.34329.08117c-8.27178-1.91726-15.945-5.67444-23.19837-10.00887-14.59194-8.71977-27.79349-19.75586-43.88756-25.75194-14.79108-5.51063-30.96071-5.6-44.22038,3.73271-11.41534,8.03462-19.01775,20.179-27.21628,31.20075a107.14393,107.14393,0,0,1-14.42552,16.38866,80.33259,80.33259,0,0,1-20.6072,13.23893,78.78048,78.78048,0,0,1-47.362,5.48566,81.16879,81.16879,0,0,1-40.95277-21.85489,77.57829,77.57829,0,0,1-7.67587-8.87578c-1.13629-1.53463-3.7413-.04019-2.59041,1.51415Z" transform="translate(-191.88976 -129.75)" fill="#1d2124"/><circle cx="468.97579" cy="440.28027" r="10" fill="#1d2124"/><circle cx="678.97579" cy="443.28027" r="10" fill="#1d2124"/><circle cx="355.97579" cy="514.28027" r="10" fill="#1d2124"/><path d="M333.18292,343.24581a9.377,9.377,0,0,0-4.285,13.72513l-28.3436,40.49362,8.8891,10.03176,33.02879-47.99312a9.42779,9.42779,0,0,0-9.28933-16.25739Z" transform="translate(-191.88976 -129.75)" fill="#ffb6b6"/><polygon points="162.359 627.135 150.099 627.135 144.267 579.847 162.361 579.848 162.359 627.135" fill="#ffb6b6"/><path d="M357.37525,768.76933l-39.53076-.00147v-.5A15.3873,15.3873,0,0,1,333.231,752.88163h.001l24.144.001Z" transform="translate(-191.88976 -129.75)" fill="#2f2e41"/><path d="M212.85862,764.63491l-1-.23Z" transform="translate(-191.88976 -129.75)" opacity="0.1" style="isolation:isolate"/><path d="M213.51862,764.76491l-.49-.07.54.1Z" transform="translate(-191.88976 -129.75)" opacity="0.1" style="isolation:isolate"/><path d="M199.20862,759.05489Z" transform="translate(-191.88976 -129.75)" opacity="0.1" style="isolation:isolate"/><path d="M199.22863,759.0649Z" transform="translate(-191.88976 -129.75)" opacity="0.1" style="isolation:isolate"/><path d="M213.02862,764.6949h0Z" transform="translate(-191.88976 -129.75)" opacity="0.1" style="isolation:isolate"/><polygon points="131.019 453 143.811 614.39 165.536 614.39 171.531 453 131.019 453" fill="#cacaca"/><polygon points="165.019 285.745 156.362 281.373 126.599 279.435 129.729 264.568 106.249 264.568 97.206 295.765 152.179 305.89 165.019 285.745" fill="#cacaca"/><circle cx="180.89385" cy="237.89146" r="28.93994" fill="#2f2e41"/><ellipse cx="343.84367" cy="345.68703" rx="11.97515" ry="8.98136" transform="translate(-335.61792 214.63358) rotate(-45)" fill="#2f2e41"/><ellipse cx="391.93423" cy="338.14341" rx="8.98136" ry="11.97515" transform="translate(-264.87845 435.98973) rotate(-66.86956)" fill="#2f2e41"/><circle cx="181.81169" cy="244.80009" r="24.56103" fill="#ffb6b6"/><path d="M347.89354,359.10128a33.40487,33.40487,0,0,0,19.09068,5.89985,20.47079,20.47079,0,0,1-8.11361,3.338,67.35875,67.35875,0,0,0,27.514.1546,17.80758,17.80758,0,0,0,5.75978-1.97823,7.28923,7.28923,0,0,0,3.55521-4.75471c.60365-3.44852-2.08348-6.58157-4.876-8.69308a35.96737,35.96737,0,0,0-30.22447-6.03968c-3.37626.87272-6.75852,2.34726-8.9515,5.05866s-2.84257,6.8915-.75322,9.68353Z" transform="translate(-191.88976 -129.75)" fill="#2f2e41"/><polygon points="149.723 534.457 143.168 544.817 100.088 524.463 109.763 509.173 149.723 534.457" fill="#ffb6b6"/><path d="M353.32738,667.91881l-21.1365,33.40553-.42254-.26732a15.3873,15.3873,0,0,1-4.776-21.229l.00052-.00083,12.90953-20.40292Z" transform="translate(-191.88976 -129.75)" fill="#2f2e41"/><path d="M406.28476,402.44857l-58.03335,8.6745-9.97279,23.03184s-22.2116,10.27226-7.44,34.93367l-17.22,62.45624s-80.556,40.875-79.03217,68.2901S318.63862,672.347,318.63862,672.347l11.56862-18.71338-47.67857-47.22867,44.64-14.215,35.21,1.665s38.2542-29.91508,15.49291-79.76l15.69709-46.00081Z" transform="translate(-191.88976 -129.75)" fill="#cacaca"/><path d="M363.59182,544.1951a9.377,9.377,0,0,0,8.81471-11.35962l40.71618-28.02294-4.81907-12.50716-47.72842,33.41015a9.42779,9.42779,0,0,0,3.0166,18.47957Z" transform="translate(-191.88976 -129.75)" fill="#ffb6b6"/><path d="M393.36863,411.82874l11.91613-9.38017s15.78611,11.94506,15.80579,20.87325,2.64274,79.78251,2.64274,79.78251L402.44951,518.3499l-19.90088-12.07577,13.68-17.44925-6.45042-40.71268Z" transform="translate(-191.88976 -129.75)" fill="#cacaca"/><path d="M573.88976,769.75h-381a1,1,0,0,1,0-2h381a1,1,0,0,1,0,2Z" transform="translate(-191.88976 -129.75)" fill="#3f3d56"/></svg>
        </div>
    @endif
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 p-0 pr-1">
            <div class="jumbotron p-3">
                <span class="h2 d-block text-center">Total Sale</span>
                @if($sales and $sales->count() > 0)
                    <span class="d-block text-center">@user('Retailer'){{$sales->sum('Payed')}}@elseuser('Distributor'){{$sales->sum('PayableAmount')}}@enduser PKR</span>
                @else
                    <span class="d-block text-center">N/A</span>
                @endif
            </div>
        </div>
        @user('Retailer')
            <div class="col-md-3 p-0 pr-1">
                <div class="jumbotron p-3">
                    <span class="h2 d-block text-center">Medicine Sold</span>
                    <span class="d-block text-center">{{$sales->sum(function($sale){
                        return $sale->saleitems->sum(function($item){
                            return $item->Quantity;
                        });
                    })}}</span>
                </div>
            </div>
            <div class="col-md-3 p-0 pr-1">
                <div class="jumbotron p-3">
                    <span class="h2 d-block text-center">Quick Sale</span>
                    <span class="d-block">
                        <a class="btn btn-primary btn-block p-1" href="{{route('sales.newsale')}}">Make a Sale</a>
                    </span>
                </div>
            </div>
        @enduser
        <div class="col-md-3 p-0">
            <div class="jumbotron p-3">
                <span class="h2 d-block text-center">Last Sale</span>
                @if($sales and $sales->count() > 0)
                    <span class="d-block text-center">@user('Retailer'){{$sales->last()->Payed}}@elseuser('Distributor'){{$sales->last()->PayableAmount}}@enduser PKR</span>
                @else
                    <span class="d-block text-center">N/A</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if($sales)
<script>
    window.onload = function()
    {
        var label = [
        @foreach($sales as $sale)
            @user('Retailer')
                '{{$sale->SaleId}}',
            @elseuser('Distributor')
                '{{$sale->OrderId}}',
            @enduser
        @endforeach
    ];

    var data = [
        @foreach($sales as $sale)
            @user('Retailer')
                '{{$sale->Payed}}',
            @elseuser('Distributor')
                '{{$sale->PayableAmount}}',
            @enduser
        @endforeach
    ];

    var ctx = document.getElementById('salegraph');

var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: label,
        datasets: [{
            label: 'Sales',
            data: data,
            backgroundColor: 'rgba(117, 1, 254, 0.4)',
            borderColor: 'rgba(110, 0, 255, 1)',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
    }
</script>
@endif
@endsection
