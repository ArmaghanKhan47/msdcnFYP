<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            {{ config('app.name', 'Laravel') }} | Admin Panel
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @auth
            <ul class="navbar-nav mr-auto d-block d-md-none">
                    @auth('admin')
                        <li class="nav-item"><a href="{{route('admin.dashboard')}}" class="nav-link disables">Dashboard</a></li>
                        <li class="nav-item"><a href="{{route('admin.pending.index')}}" class="nav-link">Pending Requests @if(session('pendingcount') > 0)<span class="badge badge-success">{{session('pendingcount')}}</span>@endif</a></li>
                        <li class="nav-item"><a href="{{route('admin.feedback.index')}}" class="nav-link">Feedbacks @if(session('feedbackcount') > 0)<span class="badge badge-success">{{session('feedbackcount')}}</span>@endif</a></li>
                        <li class="nav-item"><a href="{{route('admin.medicine.index')}}" class="nav-link">Medicine</a></li>
                        <li class="nav-item"><a href="{{route('admin.subscription.index')}}" class="nav-link">Subscription Packages</a></li>
                        <li class="nav-item"><a href="{{route('admin.settings.index')}}" class="nav-link">Settings</a></li>
                    @endauth
            </ul>
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdown">
                            @user ('Retailer')
                                <a class="dropdown-item bg-dark text-white" href="/cart">Cart @if(session('cart'))<span class="badge badge-success">@if (session('cart')->count() > 0){{session('cart')->count()}}@endif</span>@endif</a>
                                <hr class="dropdown-divider">
                            @enduser
                            <a class="dropdown-item bg-dark text-white" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
