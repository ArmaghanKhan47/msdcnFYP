<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="overflow: hidden">
    <div id="app">
        @include('navbars.mainhorizontalbar')

        <div class="row justifiy-content-center">
              <div class="bg-light border-right col-xl-2">
                <div class="list-group list-group-flush d-none d-md-block">
                  <a href="/home" class="list-group-item list-group-item-action bg-light">Dashboard</a>
                  <a href="/inventory" class="list-group-item list-group-item-action bg-light">Inventory</a>
                  <a href="#" class="list-group-item list-group-item-action bg-light disabled">Sales</a>
                  <a href="/onlineorder" class="list-group-item list-group-item-action bg-light">Online Order</a>
                  <a href="#" class="list-group-item list-group-item-action bg-light disabled">Reports</a>
                  <a href="#" class="list-group-item list-group-item-action bg-light disabled">Transactions</a>
                  <a href="#" class="list-group-item list-group-item-action bg-light disabled">Settings</a>
                </div>
            </div>
            <div class="col-xl-10">
                <div class="container mt-xl-3 overflow-auto" style="height: 42em">
                    @include('inc.message')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
