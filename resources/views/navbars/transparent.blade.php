<nav class="navbar navbar-expand-md navbar-dark bg-transparent shadow-sm ">
    <div class="container">
        <a class="navbar-brand" href="/" style="margin-right: 0px;">

            <!--{{ config('app.name', 'Laravel') }} -->

            <img src="/storage/img/log.png" style="width: 150px; height: 50px" >
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-dark navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto d-block d-md-none">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="btn btn-danger" id="loginBtnHome" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    {{--@if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-danger" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    --}}
                @endguest
            </ul>
        </div>
    </div>
</nav>
