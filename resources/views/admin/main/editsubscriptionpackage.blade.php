@extends('layouts.app')

@section('content')
<div class="jumbotron p-3 mb-3">
    <span class="h1 d-block">Edit Subscription Package</span>
</div>
<div class="container-fluid p-3 overflow-auto">
        <div class="row mb-2">
                <div class="col-md-6 pr-0">
                    <form id="form1" method="POST" action="{{route('admin.subscription.edit', $package->PackageId)}}">
                        @csrf
                        <div class="jumbotron p-2">
                            <label for="pkgname">Package Name</label>
                            <input type="text" id="medname" name="pkgname" class="form-control" value="{{$package->PackageName}}">

                            <label class="mt-2" for="pkgprice">Package Price</label>
                            <input type="number" min="0" pattern="[0-9]+" step="0.5" id="medcompany" name="pkgprice" class="form-control" value="{{$package->PackagePrice}}">

                            <label class="mt-2" for="pkgduration">Package Duration</label>
                            <input type="number" min="0" pattern="[0-9]+" id="medcompany" name="pkgduration" class="form-control" value="{{$package->PackageDuration}}">

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
