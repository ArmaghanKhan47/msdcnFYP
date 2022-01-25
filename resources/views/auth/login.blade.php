@extends('layouts.guest')

@section('content')
    <div class="container p-4">
        <div class="row">
            <div class="col-md-6">
                <div class="container rounded p-4 h-100 bg-custom-one">
                    <span class="h1">About</span>
                    <p>
                        The Medical Store Distributor Consumer Network (MSDCN) is a website which allows the user to maintain their inventory and to sell their stock, which will be used by Medical store and Pharmaceutical Distributors. This website will store details of medicine purchase and selling w.r.t Retailer and Distributor. The website will also consist of Billing generation, Reporting module, Transection and Medicine shortage notification module
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="container rounded p-4 h-100 bg-custom-one">
                    <span class="h1">{{ __('Login') }}</span>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            {{-- Email --}}
                            <div class="form-group px-5 py-1 my-1 d-flex flex-column align-items-center justify-content-center">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    autofocus
                                    placeholder="Email"
                                >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="form-group px-5 py-1 my-1 d-flex flex-column align-items-center justify-content-center">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Password"
                                >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Login Button --}}
                            <div class="form-group px-5 py-1 my-1">
                                    <button type="submit" class="btn btn-primary d-block w-100">
                                        {{ __('Login') }}
                                    </button>
                            </div>

                            {{-- Extra --}}
                            <div class="form-group px-5 py-1 my-1 d-flex justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <div class="row py-4 px-3">
            <div class="col-md-12 p-3 rounded">
                    <span class="h1">Copyright</span>
                    <p>Armaghan Hasan (FA17-BSE-045)</p>
                    <p>Abdullah Iqbal (FA17-BSE-030)</p>
                    <p>Majid Durrani (FA17-BSE-021)</p>
            </div>
        </div>
    </div>
@endsection
