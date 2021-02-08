@extends('layouts.app2')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-6">
            <div class="jumbotron" style="height: 100%">
                <span class="d-block text-center mb-2">
                    <span class="h1 mb-4">{{ __('Admin Login') }}</span>
                </span>
                    <form method="POST" action="{{ route('admin.login') }}">
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

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
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
