@extends('layouts.guest')

@section('content')
<div class="container overflow-show py-1">
    <div class="row justify-content-center">
        <div class="col-xl-4">
            <div class="border border-danger rounded p-4" style="height: 100%">
                <span class="h1 d-block">Information</span>
                <ul>
                    <li>Enter your <strong>Original Name</strong></li>
                    <li>Enter your <strong>Valid Email Address</strong></li>
                    <li>Enter <strong>Strong Password</strong></li>
                    <li>Select your type <strong>Retailer</strong> or <strong>Distributor</strong></li>
                    <li>Enter your <strong>CNIC Number</strong> (13-digit number)</li>
                    <li>Click <strong>Register</strong> Button</li>
                    <li>By clicking <strong>Register</strong> Button you will be redirect to next page, where you enter your shop details</li>
                </ul>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="p-5 border border-danger rounded" style="height: 100%">
                <span class="h1 d-block">{{ __('Register') }}</span>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- Name --}}
                    <div class="form-group px-5 d-flex flex-column align-items-center justify-content-center py-1 my-1">
                        <input
                            id="name"
                            type="text"
                            class="form-control w-75 @error('name') is-invalid @enderror"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            autofocus
                            placeholder="Name"
                        >

                        @error('name')
                            <span class="invalid-feedback w-75" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group px-5 d-flex flex-column align-items-center justify-content-center py-1 my-1">
                        <input
                            id="email"
                            type="email"
                            class="form-control w-75 @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            placeholder="Email"
                        >

                        @error('email')
                            <span class="invalid-feedback w-75" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-group px-5 d-flex flex-column align-items-center justify-content-center py-1 my-1">
                        <input
                            id="password"
                            type="password"
                            class="form-control w-75 @error('password') is-invalid @enderror"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Password"
                        >

                        @error('password')
                            <span class="invalid-feedback w-75" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="form-group px-5 d-flex justify-content-center py-1 my-1">
                        <input
                            id="password-confirm"
                            type="password"
                            class="form-control w-75"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm Password"
                        >
                    </div>

                    {{-- Cnic Number --}}
                    <div class="form-group px-5 d-flex justify-content-center py-1 my-1">
                        <input
                            type="text"
                            pattern="[0-9]+"
                            id="cnicnumber"
                            name="cnicnumber"
                            class="form-control w-75"
                            required
                            maxlength="13"
                            minlength="13"
                            autocomplete="false"
                            placeholder="CNIC Number"
                        >
                    </div>

                    {{-- Cnic Front Pic File` --}}
                    <div class="form-group px-5 d-flex justify-content-center py-1 my-1">
                        <div class="d-flex flex-column w-75">
                            <label
                                for="cnicfront"
                                class="col-form-label text-md-right fw-bold"
                            >
                                {{ __('CNIC Front Pic') }}
                            </label>

                            <input
                                type="file"
                                id="cnicfront"
                                name="cnicfrontpic"
                                class="form-control @error('cnicfrontpic'){{'is-invalid'}}@enderror"
                                required
                                accept="image/jpeg, image/jpg, image/png, image/webp"
                            >
                            <label class="text-muted">Max image size:1.9 MB | Supported formats: jpeg,jpg,png,webp</label>
                        </div>
                    </div>

                    {{-- Cnic Back Pic File --}}
                    <div class="form-group px-5 d-flex justify-content-center py-1 my-1">
                        <div class="d-flex flex-column w-75">
                            <label
                                for="cnicback"
                                class="col-form-label text-md-right fw-bold"
                            >
                                {{ __('CNIC Back Pic') }}
                            </label>

                            <input
                                type="file"
                                id="cnicback"
                                name="cnicbackpic"
                                class="form-control @error('cnicfrontpic'){{'is-invalid'}}@enderror"
                                required
                                accept="image/jpeg, image/jpg, image/png, image/webp"
                            >
                            <label class="text-muted">Max image size:1.9 MB | Supported formats: jpeg,jpg,png,webp</label>
                        </div>
                    </div>

                    {{-- Register Button --}}
                    <div class="form-group px-5 d-flex justify-content-center py-1 my-1">
                        <button type="submit" class="btn btn-primary w-75">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
