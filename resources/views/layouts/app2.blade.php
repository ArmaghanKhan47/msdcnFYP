<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body style="overflow: hidden">
    <div id="app" class="container-fluid h-100 pb-5 p-0 m-0">
        @include('navbars.mainhorizontalbar')

        <div class="row m-0 h-100 p-0">
            <div class="col-md-12 m-0 p-0 h-100">
                <div class="container-fluid overflow-auto p-1 m-0 h-100">
                    @include('inc.message')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
