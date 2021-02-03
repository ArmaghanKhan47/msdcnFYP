<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @auth
            <ul class="navbar-nav mr-auto d-block d-md-none">
                <div class="list-group list-group-flush border">
                    <a href="/home" class="list-group-item list-group-item-action bg-light">Dashboard</a>
                    <a href="/inventory" class="list-group-item list-group-item-action bg-light">Inventory</a>
                    <a href="#" class="list-group-item list-group-item-action bg-light disabled">Sales</a>
                    @if (Auth::user()->UserType == 'Retailer')
                        <a href="/onlineorder" class="list-group-item list-group-item-action bg-light">Online Order</a>
                    @elseif(Auth::user()->UserType == 'Distributor')
                        <a href="#" class="list-group-item list-group-item-action bg-light disabled">Orders</a>
                    @endif
                    <a href="#" class="list-group-item list-group-item-action bg-light disabled">Reports</a>
                    <a href="/order/history" class="list-group-item list-group-item-action bg-light disabled">Order History</a>
                    <a href="/subscriptionhistory" class="list-group-item list-group-item-action bg-light">Subscription History</a>
                    <a href="#" class="list-group-item list-group-item-action bg-light disabled">Settings</a>
                  </div>
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

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->UserType == 'Retailer')
                                <a class="dropdown-item" href="/cart">Cart <span class="badge badge-success">@if (session('cart')){{session('cart')->count()}}@endif</span></a>
                                <hr class="dropdown-divider">
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
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
