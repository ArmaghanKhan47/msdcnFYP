@extends('layouts.app2')

@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="jumbotron" style="height: 100%">
                <span class="h1">About</span>
                <p>
                    The Medical Store Distributor Consumer Network (MSDCN) is a website which allows the user to maintain their inventory and to sell their stock, which will be used by Medical store and Pharmaceutical Distributors. This website will store details of medicine purchase and selling w.r.t Retailer and Distributor. The website will also consist of Billing generation, Reporting module, Transection and Medicine shortage notification module
                </p>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="jumbotron" style="height: 100%">
                <span class="h1">{{ __('Login') }}</span>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    <div class="row mt-xl-3">
        <div class="col-xl-12">
            <div class="jumbotron p-4">
                <span class="h1">Copyright</span>
                <p>Armaghan Hasan (FA17-BSE-045)</p>
                <p>Abdullah Iqbal (FA17-BSE-030)</p>
                <p>Majid Durrani (FA17-BSE-021)</p>
            </div>
        </div>
    </div>
@endsection
