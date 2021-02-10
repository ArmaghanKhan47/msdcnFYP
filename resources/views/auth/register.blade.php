@extends('layouts.app2')

@section('content')
<div class="container overflow-show">
    <div class="row justify-content-center">
        <div class="col-xl-4">
            <div class="jumbotron p-4" style="height: 100%">
                <span class="h1 d-block">Information</span>
                <ul>
                    <li>Enter your <strong>Original Name</strong></li>
                    <li>Enter your <strong>Valid Email Address</strong></li>
                    <li>Enter <strong>Strong Password</strong></li>
                    <li>Select your type <strong>Retailer</strong> or <strong>Distributor</strong></li>
                    <li>Enter your <strong>CNIC Number</strong> (16-digit number)</li>
                    <li>Click <strong>Register</strong> Button</li>
                    <li>By clicking <strong>Register</strong> Button you will be redirect to next page, where you enter your shop details</li>
                </ul>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="jumbotron p-4" style="height: 100%">
                <span class="h1 d-block">{{ __('Register') }}</span>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>

                        <div class="col-md-6">
                            <select id="usertype" class="form-select form-control" name="usertype">
                                <option value="Retailer" selected>Retailer</option>
                                <option value="Distributor">Distributor</option>
                              </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cnicnumber" class="col-md-4 col-form-label text-md-right">{{ __('CNIC Number') }}</label>

                        <div class="col-md-6">
                            <input type="text" id="cnicnumber" name="cnicnumber" class="form-control" required max="16" min="16">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cnicfront" class="col-md-4 col-form-label text-md-right">{{ __('CNIC Front Pic') }}</label>

                        <div class="col-md-6">
                            <input type="file" id="cnicfront" name="cnicfrontpic" class="form-control @error('cnicfrontpic'){{'is-invalid'}}@enderror" required>
                            <label class="text-muted">Max image size:1.9 MB | Supported formats: jpeg,jpg,png</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cnicback" class="col-md-4 col-form-label text-md-right">{{ __('CNIC Back Pic') }}</label>

                        <div class="col-md-6">
                            <input type="file" id="cnicback" name="cnicbackpic" class="form-control @error('cnicfrontpic'){{'is-invalid'}}@enderror" required>
                            <label class="text-muted">Max image size:1.9 MB | Supported formats: jpeg,jpg,png</label>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
