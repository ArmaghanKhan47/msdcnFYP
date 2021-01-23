@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row p-0">
        <div class="col-xl-6">
            <div class="jumbotron" style="height: 100%">
                <span class="h1">About</span>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore repudiandae, nesciunt tenetur provident unde deleniti ut obcaecati quis distinctio rem accusamus atque. Commodi delectus omnis quia ipsum! Et, dicta possimus?Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore repudiandae, nesciunt tenetur provident unde deleniti ut obcaecati quis distinctio rem accusamus atque. Commodi delectus omnis quia ipsum! Et, dicta possimus?</p>
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
</div>
<footer class="mt-xl-1">
    <div class="jumbotron">
        <span class="h1">Copyright</span>
    </div>
</footer>
@endsection
