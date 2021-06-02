@extends('layouts.admin')

@section('content')
<div class="jumbotron p-3 mb-3">
    <span class="h1 d-block">Edit Subscription Package</span>
</div>
<div class="container-fluid p-3 overflow-auto">
        <div class="row mb-2 justify-content-center">
                <div class="col-md-6 pr-0">
                    <form id="form1" method="POST" action="{{route('admin.subscription.edit', $package->PackageId)}}">
                        @csrf
                        <input type="hidden" name="supportapi" value="0">

                        <div class="jumbotron p-2 bg-transparent border border-secondary">
                            <span class="d-block h5">Basic Details</span>
                            <hr>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Package Name</span>
                                </div>
                                <input type="text" id="medname" name="pkgname" class="form-control" value="{{$package->PackageName}}">
                            </div>

                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Package Price</span>
                                </div>
                                <input type="number" min="0" pattern="[0-9]+" step="0.5" id="medcompany" name="pkgprice" class="form-control" value="{{$package->PackagePrice}}">
                            </div>

                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Package Duration</span>
                                </div>
                                <input type="number" min="0" pattern="[0-9]+" id="medcompany" name="pkgduration" class="form-control" value="{{$package->PackageDuration}}">
                            </div>

                            <span class="d-block h5 mt-3">Options</span>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="float-left h6">Support API</span>
                                    <span class="float-right">
                                        <input type="checkbox" name="supportapi" value="1" @if($package->supportApi){{"checked"}}@endif>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>

        <div class="row">
            <div class="col-md-12 p-0">
                <button id="submitbtn" class="btn btn-success">Save Changes</button>
                <a href="{{route('admin.subscription.index')}}" class="btn btn-danger float-right">Discard</a>
            </div>
        </div>
</div>
<script>
    document.getElementById('submitbtn').addEventListener('click', function(){
        document.getElementById('form1').submit();
    });
</script>
@endsection
