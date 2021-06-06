@extends('layouts.app2')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-6">
            <div class="jumbotron jumbotron_apnd text-white" >
                <span class="d-block text-center mb-2">
                    <span class="h1 mb-4">{{ __('Admin Login') }}</span>
                </span>
                    <form method="POST" action="{{ route('admin.login') }}" class="justify-content-center">
                        @csrf

                        <div class="form-group row justify-content-center">


                            <div class="col-md-6">
                                <br>

                                <input placeholder="Email" type="email" class="d-block form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="form-group row justify-content-center" >


                            <div class="col-md-6">
                                <input placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row justify-content-center" >
                            <div class="col-md-7 justify-content-center text-center">
                                <button type="submit" class="btn btn-danger d-inline">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

@endsection
