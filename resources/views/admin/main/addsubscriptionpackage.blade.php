@extends('layouts.app')

@section('content')
    <div class="jumbotron p-3">
        <span class="h1 d-block">Add New Subscription Package</span>
    </div>
    <div class="container border border-secondary rounded p-3 pb-0">
        <form method="POST" action="{{route('admin.subscription.create')}}">
            @csrf
            <div class="form-group m-0">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Package Name</span>
                    </div>
                    <input type="text" name="pkgname" class="form-control @error('pkgname'){{'is-invalid'}}@enderror" value="{{old('pkgname')}}">
                </div>

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Package Price</span>
                    </div>
                    <input type="text" name="pkgprice" class="form-control @error('pkgprice'){{'is-invalid'}}@enderror" value="{{old('pkgprice')}}" pattern="[0-9]+">
                </div>

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Package Duration</span>
                    </div>
                    <input type="text" name="pkgduration" class="form-control @error('pkgduration'){{'is-invalid'}}@enderror" value="{{old('pkgduration')}}" pattern="[0-9]+">
                </div>

                <button type="submit" class="btn btn-success btn-block">Create Package</button>
            </div>
        </form>
    </div>
@endsection
