@extends('layouts.app')
@section('content')
<div class="jumbotron p-3">
    <span class="h1 d-block">Settings</span>
</div>

{{-- Personal Info Block Start --}}
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

    <div class="container mt-3">
        {{-- Cnic Front Pic Start --}}
        <div class="row pictures">
            <div class="col-md-6">
                <span class="d-block p-2">
                    <strong class="d-block">CNIC Front Picture</strong>
                    <span class="text-muted">Click to show/hide picture</span>
                </span>
            </div>
            <div class="col-md-6 d-none">
                <img class="rounded" src="{{asset('storage/cnic/front/' . $user->CnicFrontPic)}}" height="200px" width="400px">
            </div>
        </div>
        {{-- Cnic Front Pic End --}}

        {{-- Cnic Back Pic Start --}}
        <div class="row mt-2 pictures">
            <div class="col-md-6">
                <span class="d-block p-2">
                    <strong class="d-block">CNIC Back Picture</strong>
                    <span class="text-muted">Click to show/hide picture</span>
                </span>
            </div>
            <div class="col-md-6 d-none">
                <img class="rounded" src="{{asset('storage/cnic/back/' . $user->CnicBackPic)}}" height="200px" width="400px">
            </div>
        </div>
        {{-- Cnic Back Pic End --}}
    </div>
</div>
{{-- Personal Info Block End --}}

{{-- Shop Info Block Start --}}
<div class="jumbotron p-3 mb-3">
    <span class="h2 d-block">Shop Info</span>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Shop Name</strong></span>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="@user('Retailer'){{$user->retailershop->RetailerShopName}}@elseuser('Distributor'){{$user->distributorshop->DistributorShopName}}@enduser" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Liscence#</strong></span>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="@user('Retailer'){{$user->retailershop->LiscenceNo}}@elseuser('Distributor'){{$user->distributorshop->LiscenceNo}}@enduser" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Region</strong></span>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="@user('Retailer'){{$user->retailershop->Region}}@elseuser('Distributor'){{$user->distributorshop->Region}}@enduser" disabled>
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

    <div class="container mt-3">
        {{-- Liscenc Pic Start --}}
        <div class="row mt-2 pictures">
            <div class="col-md-6">
                <span class="d-block p-2">
                    <strong class="d-block">Liscence Picture</strong>
                    <span class="text-muted">Click to show/hide picture</span>
                </span>
            </div>
            <div class="col-md-6 d-none">
                <img class="rounded" src="@user('Retailer'){{asset('storage/retailer/liscence/' . $user->retailershop->LiscenceFrontPic)}}@elseuser('Distributor'){{asset('storage/distributor/liscence/' . $user->distributorshop->LiscenceFrontPic)}}@enduser" height="200px" width="400px">
            </div>
        </div>
        {{-- Liscence Pic End --}}
    </div>
</div>
{{-- Shop Info Block End --}}

{{-- Credit Card Info Block Start --}}
<div class="jumbotron p-3 mb-3">
    <span class="h2 d-block">Credit Card Info</span>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Card Holder Name</strong></span>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" value="@if($card){{$card->CardHolderName}}@endif" disabled>
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
                    <input type="text" class="form-control" value="@if($card){{$card->CardNumber}}@endif" disabled>
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
                    <input type="text" class="form-control" value="@if($card){{$card->ExpiryMonth}}/{{$card->ExpiryYear}}@endif" disabled>
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
{{-- Credit Card Info Block End --}}

{{-- Only For Distributor --}}
{{-- Mobile Account Info Block Start--}}
@user('Distributor')
    {{-- Show Mobile Account Info Start --}}
    <div class="jumbotron p-3 mb-3">
        <span class="h2 d-block">Mobile Account Info</span>

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span class="d-block p-2"><strong>Mobile Account</strong></span>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" value="@if($user->mobilebank){{$user->mobilebank->acount_provider}}@endif" disabled>
                </div>
            </div>
        </div>

        <div class="container mt-3">
            {{-- QR Code Pic Start --}}
            <div class="row mt-2 pictures">
                <div class="col-md-6">
                    <span class="d-block p-2">
                        <strong class="d-block">QR Code Picture</strong>
                        <span class="text-muted">Click to show/hide picture</span>
                    </span>
                </div>
                <div class="col-md-6 d-none">
                    <img class="rounded" src="@if($user->mobilebank){{asset('storage/mobilebank/qrcode/' . $user->mobilebank->qr_code)}}@endif" alt="Opps! No Pic Found" height="200px" width="400px">
                </div>
            </div>
            {{-- QR Code Pic End --}}

            <div class="row mt-2">
                <div class="col-md-12">
                    <button id="mobile-account-show-form-btn" class="btn btn-success float-left">@if($user->mobilebank){{__('Update')}}@else{{__('Add New')}}@endif</button>
                    <button class="btn btn-danger float-right disabled" disabled>Remove</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Show Mobile Account Info End --}}

    {{-- Form for uploading Mobile Account Info Start --}}
    <div id="mobile-account-upload-settings" class="jumbotron p-3 mb-3 d-none">
        <span class="h2 d-block">@if($user->mobilebank){{__('Update')}}@else{{__('Add')}}@endif Mobile Account Info</span>

        <form method="POST" action="{{route('setting.mobileaccountsave')}}" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <span class="d-block p-2"><strong>Mobile Account</strong></span>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" name="mobileaccountprovider" required>
                            <option value="0" @if($user->mobilebank)@if($user->mobilebank->acount_provider == 0){{'selected'}}@endif @endif>EasyPaisa</option>
                            <option value="1" @if($user->mobilebank)@if($user->mobilebank->acount_provider == 1){{'selected'}}@endif @endif>JassCash</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="container mt-3">
                {{-- QR Code Pic Start --}}
                <div class="row mt-2">
                    <div class="col-md-6">
                        <span class="d-block p-2">
                            <strong class="d-block">QR Code Picture</strong>
                            <span class="text-muted"></span>
                        </span>
                    </div>
                    <div class="col-md-6">
                        {{-- Upload Picture --}}
                        <input type="file" id="qrcode" name="qrcode" class="form-control @error('qrcode') is-invalid @enderror" required>
                        <label class="text-muted">Max image size:1.9 MB | Supported formats: jpeg,jpg,png</label>
                    </div>
                </div>
                {{-- QR Code Pic End --}}

                <div class="row mt-2">
                    <div class="col-md-12">
                        <button class="btn btn-success float-left" type="submit">Save</button>
                        <button id="mobile-account-discard-btn" class="btn btn-danger float-right">Discard</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- Form for uploading Mobile Account Info End --}}
@enduser
{{-- Mobile Account Info Block End --}}

{{-- Account Settings Block Start --}}
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
                    @elseif($user->AccountStatus == 'PENDING')
                        <span class="btn btn-warning disabled">{{$user->AccountStatus}}</span>
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
