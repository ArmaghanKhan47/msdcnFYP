@extends('layouts.admin')

@section('content')
<div class="jumbotron p-3">
    <span class="h1 d-block">Admin Dashboard</span>
</div>

<div class="container p-0 m-0">
    <div class="row m-0">
        <div class="col-md-4">
            <div class="jumbotron text-center p-3">
                <span class="d-block h3">{{session('pendingcount')}}</span>
                <span class="d-block h4 text-muted">Pending Requests</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="jumbotron text-center p-3">
                <span class="d-block h3">{{$medicines}}</span>
                <span class="d-block h4 text-muted">Medicines Exist</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="jumbotron text-center p-3">
                <span class="d-block h3">{{$retailers + $distributors}}</span>
                <span class="d-block h4 text-muted">Registered Users</span>
            </div>
        </div>
    </div>

    <div class="row m-0">
        <div class="col-md-4">
            <div class="jumbotron text-center p-3">
                <span class="d-block h3">{{$retailers}}</span>
                <span class="d-block h4 text-muted">Retailers</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="jumbotron text-center p-3">
                <span class="d-block h3">{{$distributors}}</span>
                <span class="d-block h4 text-muted">Distributors</span>
            </div>
        </div>
    </div>
</div>
@endsection
