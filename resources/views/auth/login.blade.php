@extends('layouts.app2')

@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-6">
            <div class="jumbotron jumbotron_apnd text-center">
                <span class="h1 text-white">{{ __('Login') }}</span>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row justify-content-center">


                            <div class="col-md-6">
                                <input type="email" placeholder="Email" class="mt-3 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                {{-- <input id="email" placeholder="Email" type="email" class="form-control"> --}}

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row justify-content-center">


                            <div class="col-md-6">
                                <input placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row justify-content-center ">
                            <div class="col-md-6  justify-content-center ">
                                <div class="form-check ">
                                    <input class="form-check-input " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-white" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                        <div class="form-group row justify-content-center ">
                            <div class="col-md-8 justify-content-center">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Login') }}
                                </button>


                            </div>
                        </div>

                        <div class=" form-group row justify-content-center">
                            <div class="col-md-8 justify-content-center text-center ">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class=" form-group row justify-content-center">
                            <div class="col-md-8 justify-content-center text-center ">

                                    <a class="btn btn-link" href="{{ route('register') }}">
                                        {{ __('Get Started!') }}
                                    </a>

                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

@endsection
