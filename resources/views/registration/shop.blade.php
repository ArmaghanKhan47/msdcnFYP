@extends('layouts.guest')

@section('content')
<div class="container overflow-show py-1 border border-danger">
    <div class="row justify-content-center">
        <div class="col-xl-4">
            <div class="border border-danger rounded p-4" style="height: 100%">
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
            <div class="border border-danger rounded p-5" style="height: 100%">
                <span class="h1 d-block">
                    Shop Registration
                </span>
                <form method="POST" action="{{route('shop-registration.store')}}" enctype="multipart/form-data">
                    @csrf
                    {{-- Shop Name --}}
                    <div class="form-group px-5 d-flex flex-column align-items-center justify-content-center py-1 my-1">
                        <input
                            id="shopname"
                            type="text"
                            class="form-control w-75 @error('shopname') is-invalid @enderror"
                            name="shopname"
                            value="{{ old('shopname') }}"
                            required
                            autofocus
                            placeholder="Shop Name"
                        >

                        @error('shopname')
                            <span class="invalid-feedback w-75" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>

                    {{-- Liscence No --}}
                    <div class="form-group px-5 d-flex flex-column align-items-center justify-content-center py-1 my-1">
                        <input
                            id="liscencno"
                            type="text"
                            maxlength="13"
                            pattern="[0-9]+"
                            class="form-control w-75 @error('liscenceno') is-invalid @enderror"
                            name="liscenceno"
                            value="{{ old('liscenceno') }}"
                            required
                            placeholder="Liscence Number"
                        >

                        @error('liscencno')
                            <span class="invalid-feedback w-75" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Region --}}
                    <div class="form-group px-5 d-flex flex-column align-items-center justify-content-center py-1 my-1">
                        <select id="region" class="form-select w-75 form-control" name="region">
                            <option selected disabled>Select Region</option>
                            @foreach ($regions as $index => $region)
                                <option value="{{ $index }}">{{ ucwords($region) }}</option>
                            @endforeach
                            {{-- <option value="Rawalpindhi">Rawalpindhi</option> --}}
                        </select>
                    </div>

                    {{-- Role --}}
                    <div class="form-group px-5 d-flex flex-column align-items-center justify-content-center py-1 my-1">
                        <select id="role" class="form-select w-75 form-control" name="role">
                            <option selected disabled>Select Role</option>
                            <option value="0">Retailer</option>
                            <option value="1">Distributor</option>
                            {{-- <option value="Rawalpindhi">Rawalpindhi</option> --}}
                        </select>
                    </div>

                    {{-- Contact Number --}}
                    <div class="form-group px-5 d-flex flex-column align-items-center justify-content-center py-1 my-1">
                        <input
                            type="tel"
                            id="contactnumber"
                            name="contactnumber"
                            class="form-control w-75 @error('contactnumber') is-invalid @enderror"
                            required
                            maxlength="11"
                            minlength="11"
                            placeholder="Contact Number"
                        >

                        @error('liscencno')
                            <span class="invalid-feedback w-75" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Liscence Pic File --}}
                    <div class="form-group px-5 py-1 my-1 d-flex justify-content-center">
                        <div class="d-flex flex-column w-75">
                            <label
                                for="lispic"
                                class="col-form-label text-md-right fw-bold"
                            >
                                {{ __('Liscence Picture') }}
                            </label>

                            <input
                                type="file"
                                id="lispic"
                                name="lispic"
                                class="form-control @error('lispic') is-invalid @enderror"
                                required
                                accept="image/jpeg, image/jpg, image/png, image/webp"

                            >

                            <label class="text-muted text-wrap">Max image size:1.9 MB | Supported formats: jpeg, jpg, png, webp</label>
                            @error('liscencno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group px-5 py-1 my-1 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-75">
                            {{ __('Register Shop') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
