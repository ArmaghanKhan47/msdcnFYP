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

    <!-- Bootstrap Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="grad1" id="app">
        @auth
            @include('navbars.mainhorizontalbar')
        @endauth

        @guest
            @include('navbars.transparent')
        @endguest
        <div class="row justifiy-content-center m-0">
            <div class="col-xl-12 m-0">
                <div class="container mt-md-3">
                    @include('inc.message')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <div class = "p-1 border-danger linear-gradient"></div>

    <!-- footer -->
    @include('navbars.footer')



</body>
</html>
