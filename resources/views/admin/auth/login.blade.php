@extends('layouts.guest')

@section('content')
    <div class="container p-3">
        <div class="row justify-content-center">
            <div class="col-md-6 border border-secondary rounded my-2 pt-2">
                <span class="h1 m-0">{{ __('Admin Login') }}</span>
                <div class="container m-0">
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <div class="form-group px-5 d-flex flex-column align-items-center justify-content-center py-1 my-1">
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

                        <div class="form-group px-5 d-flex flex-column align-items-center justify-content-center py-1 my-1">
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

                        <div class="form-group px-5 d-flex flex-column align-items-center justify-content-center py-1 my-1r">
                            <button type="submit" class="btn w-100 btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row justify-content-center border border-primary">
            <div class="col-md-6 pt-2">
                <div class="jumbotron p-4 m-0">
                    <span class="h1">Copyright</span>
                    <p>Armaghan Hasan (FA17-BSE-045)</p>
                    <p>Abdullah Iqbal (FA17-BSE-030)</p>
                    <p>Majid Durrani (FA17-BSE-021)</p>
                </div>
            </div>
        </div>
    </div>
@endsection
