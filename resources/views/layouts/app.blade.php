<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    {{-- Chart.js CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</head>
<body style="overflow: hidden ">
    <div id="app">
        @include('navbars.mainhorizontalbar')
        <div class="row justifiy-content-center">
            <div class="bg-dark border-right col-md-2">
                <div class="list-group list-group-flush d-none d-md-block">
                    @auth('web')
                        {{-- If user is normal --}}
                        <a href="/home" class="list-group-item list-group-item-action bg-dark text-white">Dashboard</a>
                        <a href="/inventory" class="list-group-item list-group-item-action bg-dark text-white">Inventory</a>
                        @user ('Retailer')
                            <a href="{{route('sales.index')}}" class="list-group-item list-group-item-action bg-dark text-white">Sales</a>
                            <a href="/onlineorder" class="list-group-item list-group-item-action bg-dark text-white">Online Order</a>
                        @elseuser('Distributor')
                        <a href="/order/history" class="list-group-item list-group-item-action bg-dark text-white">Orders</a>
                        @enduser
                        <a href="{{route('report.index')}}" class="list-group-item list-group-item-action bg-dark text-white">Reports</a>
                        @user ('Retailer')
                        <a href="/order/history" class="list-group-item list-group-item-action bg-dark text-white">Order History</a>
                        @enduser
                        <a href="/subscriptionhistory" class="list-group-item list-group-item-action bg-dark text-white">Subscription History</a>
                        <a href="{{route('notification.index')}}" class="list-group-item list-group-item-action bg-dark text-white">Notifications @if(session('notificationscount') > 0)<span class="badge badge-success">{{session('notificationscount')}}</span>@endif</a>
                        <a href="/settings" class="list-group-item list-group-item-action bg-dark text-white">Settings</a>
                    @endauth
                  {{-- end --}}
                </div>
            </div>
            <div class="col-md-10 " style="background-color: #d9d9d9">
                <div class="container-fluid mt-xl-3 overflow-auto" style="height: 41em;">
                    @include('inc.message')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
