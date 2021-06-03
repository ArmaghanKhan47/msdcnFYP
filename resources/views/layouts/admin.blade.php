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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script> --}}
</head>
<body style="overflow: hidden">
    <div id="app">
        @include('navbars.adminmainhorizontalbar')
        <div class="row justifiy-content-center">
              <div class="bg-dark border-right col-md-2">
                <div class="list-group list-group-flush d-none d-md-block">
                    {{-- If user is admin --}}
                    <a href="{{route('admin.dashboard')}}" class="list-group-item list-group-item-action bg-dark text-white">Dashboard</a>
                    <a href="{{route('admin.pending.index')}}" class="list-group-item list-group-item-action bg-dark text-white">Pending Requests @if(session('pendingcount') > 0)<span class="badge badge-success">{{session('pendingcount')}}</span>@endif</a>
                    <a href="{{route('admin.feedback.index')}}" class="list-group-item list-group-item-action bg-dark text-white">Feedbacks @if(session('feedbackcount') > 0)<span class="badge badge-success">{{session('feedbackcount')}}</span>@endif</a>
                    <a href="{{route('admin.medicine.index')}}" class="list-group-item list-group-item-action bg-dark text-white">Medicine</a>
                    <a href="{{route('admin.subscription.index')}}" class="list-group-item list-group-item-action bg-dark text-white">Subscription Packages</a>
                    <a href="{{route('admin.settings.index')}}" class="list-group-item list-group-item-action bg-dark text-white">Settings</a>
                  {{-- end --}}
                </div>
            </div>
            <div class="col-md-10">
                <div class="container-fluid mt-xl-3 overflow-auto" style="height: 38.5em;">
                    @include('inc.message')
                    @yield('content')
                    <div class="jumbotron p-0 m-1 bg-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
