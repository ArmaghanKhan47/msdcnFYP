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
            <div class="col-xl-12">
                <div class="container mt-xl-3 overflow-hidden" style="height: 42em">
                    @include('inc.message')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
