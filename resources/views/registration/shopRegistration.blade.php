@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-4 text-white">
            <div class="jumbotron p-4 jumbotron_apnd" >
                <span class="h1 d-block">Information</span>
                <ul>
                    <li>Enter your <strong>Original Shop Name</strong></li>
                    <li>Enter your <strong>Valid Liscence Number</strong></li>
                    <li>Select your <strong>Region</strong></li>
                    <li>Enter Valid <strong>Phone Number</strong> (e.g 03331234567)</li>
                </ul>
            </div>
        </div>
        <div class="col-xl-8 text-white">
            <div class="jumbotron p-4 jumbotron_apnd">
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
                            <input id="liscencno" type="text" class="form-control @error('liscenceno') is-invalid @enderror" name="liscenceno" value="{{ old('liscenceno') }}" required>

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
                            <input type="tel" id="contactnumber" name="contactnumber" class="form-control @error('contactnumber') is-invalid @enderror" required max="11" min="11">
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
                            <input type="file" id="lispic" name="lispic" class="form-control @error('contactnumber') is-invalid @enderror" required>
                            <label class="text-muted">Max image size:1.9 MB | Supported formats: jpeg,jpg,png</label>
                            @error('liscencno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-danger">
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
