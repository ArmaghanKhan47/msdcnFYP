@extends('layouts.app')
@section('content')
<div class="jumbotron p-3">
    <span class="h1 d-block">Settings</span>
</div>
<div class="jumbotron p-3 mb-3">
    <span class="h2 d-block">Personal Info</span>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Name</strong></span>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="{{$user->name}}" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Email</strong></span>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" value="{{$user->email}}" disabled>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>CNIC#</strong></span>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="{{$user->CnicCardNumber}}" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Type</strong></span>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="{{$user->UserType}}" disabled>
            </div>
        </div>
    </div>
</div>
<div class="jumbotron p-3 mb-3">
    <span class="h2 d-block">Shop Info</span>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Shop Name</strong></span>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="@user('Retailer'){{$shop->RetailerShopName}}@elseuser('Distributor'){{$shop->DistributorShopName}}@enduser" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Liscence#</strong></span>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="{{$shop->LiscenceNo}}" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Region</strong></span>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="{{$shop->Region}}" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Contact#</strong></span>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" value="{{$shop->ContactNumber}}" disabled>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Shop Address</strong></span>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" value="{{$shop->shopAddress}}" disabled>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="jumbotron p-3 mb-3">
    <span class="h2 d-block">Credit Card Info</span>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Card Holder Name</strong></span>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" value="{{$card->CardHolderName}}" disabled>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Card#</strong></span>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" value="{{$card->CardNumber}}" disabled>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Expiry Date (mm/yy)</strong></span>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" value="{{$card->ExpiryMonth}}/{{$card->ExpiryYear}}" disabled>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12 pl-4">
                <button class="btn btn-danger float-right disabled">Remove</button>
            </div>
        </div>
    </div>
</div>

<div class="jumbotron p-3 mb-3">
    <span class="h2 d-block">Account Settings</span>

    <div class="jumbotron p-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span class="d-block p-2"><strong>Account Status</strong></span>
                </div>
                <div class="col-md-6">
                    @if ($user->AccountStatus == "ACTIVE")
                        <span class="btn btn-success disabled">{{$user->AccountStatus}}</span>
                    @elseif ($user->AccountStatus == "DEACTIVE")
                    <span class="btn btn-danger disabled">{{$user->AccountStatus}}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron p-2 border border-danger">
        <span class="h4 d-block text-danger">Danger Zone</span>

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span class="d-block p-2"><strong>Account Deletion</strong></span>
                </div>
                <div class="col-md-6">
                    <span class="d-block"><strong>What happens when you delete your account?</strong></span>

                    <ul>
                        <li>Your & Shop Info will be deleted</li>
                        <li>Your Order, Sale History will be deleted</li>
                        <li>You can't recover your Account</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-danger float-right disabled">Delete My Account</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
