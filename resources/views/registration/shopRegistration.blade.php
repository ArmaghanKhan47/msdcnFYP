@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-4">
            <div class="jumbotron p-4" style="height: 100%">
                <span class="h1 d-block">Information</span>
                <ul>
                    <li>Enter your <strong>Original Shop Name</strong></li>
                    <li>Enter your <strong>Valid Liscence Number</strong></li>
                    <li>Select your <strong>Region</strong></li>
                    <li>Enter Valid <strong>Phone Number</strong> (e.g 03331234567)</li>
                </ul>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="jumbotron p-4" style="height: 100%">
                <span class="h1 d-block">
                    {{$type}} Shop Registration
                </span>
                <form method="POST" action="{{route('shopregistration.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="shopname" class="col-md-4 col-form-label text-md-right">Shop Name</label>

                        <div class="col-md-6">
                            <input id="shopname" type="text" class="form-control @error('shopname') is-invalid @enderror" name="shopname" value="{{ old('shopname') }}" required autofocus>

                            @error('shopname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="liscenceno" class="col-md-4 col-form-label text-md-right">Liscence No</label>

                        <div class="col-md-6">
                            <input id="liscencno" type="text" maxlength="13" pattern="[0-9]+" class="form-control @error('liscenceno') is-invalid @enderror" name="liscenceno" value="{{ old('liscenceno') }}" required>

                            @error('liscencno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="region" class="col-md-4 col-form-label text-md-right">{{ __('Region') }}</label>

                        <div class="col-md-6">
                            <select id="region" class="form-select form-control" name="region">
                                <option value="Hazara" selected>Hazara</option>
                                <option value="Rawalpindhi">Rawalpindhi</option>
                              </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contactnumber" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                        <div class="col-md-6">
                            <input type="tel" id="contactnumber" name="contactnumber" class="form-control @error('contactnumber') is-invalid @enderror" required maxlength="11" minlength="11">
                            @error('liscencno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lispic" class="col-md-4 col-form-label text-md-right">{{ __('Liscence Picture') }}</label>

                        <div class="col-md-6">
                            <input type="file" id="lispic" name="lispic" class="form-control @error('lispic') is-invalid @enderror" required>
                            <label class="text-muted">Max image size:1.9 MB | Supported formats: jpeg,jpg,png</label>
                            @error('liscencno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Optional Mobile Account for Only Distributor Start--}}
                    @user('Distributor')
                        <div class="form-group row">
                            <label for="mobile-bank-account-provider" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Bank Account(Optional)') }}</label>

                            <div class="col-md-6">
                                <select id="mobile-bank-account-provider" name="mobilebankaccountprovider" class="form-select form-control">
                                    <option value="0">EasyPaisa</option>
                                    <option value="1">JazzCash</option>
                                </select>

                                <span class="text-muted">QR Code</span>
                                <input type="file" id="qrcode" name="qrcode" class="form-control @error('qrcode') is-invalid @enderror">
                                <label class="text-muted">Max image size:1.9 MB | Supported formats: jpeg,jpg,png</label>
                                @error('liscencno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @enduser
                    {{-- Optional Mobile Account for Only Distributor End --}}


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register Shop') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
