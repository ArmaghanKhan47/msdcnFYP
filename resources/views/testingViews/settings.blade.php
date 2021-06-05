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
                <input id="email-input" type="text" class="form-control" value="{{$user->email}}" disabled>
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
                <img class="rounded" src="{{asset('storage/cnic/front/' . $user->CnicFrontPic)}}" height="200px" width="100%">
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
                <img class="rounded" src="{{asset('storage/cnic/back/' . $user->CnicBackPic)}}" height="200px" width="100%">
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
                    <input type="text" class="form-control" pattern="[0-9]" maxlength="11" value="@user('Retailer'){{$user->retailershop->ContactNumber}}@elseuser('Distributor'){{$user->distributorshop->ContactNumber}}@enduser" readonly>
                    <div class="input-group-append">
                        <input type="hidden" name="link" value="{{route('setting.contactnumber')}}">
                        <button class="btn btn-outline-secondary disabled"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
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
                    <input type="text" class="form-control" value="@user('Retailer'){{$user->retailershop->shopAddress}}@elseuser('Distributor'){{$user->distributorshop->shopAddress}}@enduser" readonly>
                    <div class="input-group-append">
                        <input type="hidden" name="link" value="{{route('setting.shopaddress')}}">
                        <button class="btn btn-outline-secondary disabled"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
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
                <img class="rounded" src="@user('Retailer'){{asset('storage/retailer/liscence/' . $user->retailershop->LiscenceFrontPic)}}@elseuser('Distributor'){{asset('storage/distributor/liscence/' . $user->distributorshop->LiscenceFrontPic)}}@enduser" height="200px" width="100%">
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
                <input type="text" class="form-control" value="@if($user->creditcard){{$user->creditcard->CardHolderName}}@endif" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Card#</strong></span>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="@if($user->creditcard){{$user->creditcard->CardNumber}}@endif" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Expiry Date (mm/yy)</strong></span>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="@if($user->creditcard){{$user->creditcard->ExpiryMonth}}/{{$user->creditcard->ExpiryYear}}@endif" disabled>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <button id="credit-card-show-form-btn" class="btn btn-success float-left">@if($user->creditcard){{__('Update')}}@else{{__('Add New')}}@endif</button>
                <form action="{{route('settings.creditcard')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger float-right" type="submit">Remove</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Form for uploading Credit Card Info Start --}}
<div id="credit-card-upload-settings" class="jumbotron p-3 mb-3 d-none">
    <span class="h2 d-block">@if($user->creditcard){{__('Update')}}@else{{__('Add')}}@endif Credit Card Info</span>

    <form method="POST" action="{{route('settings.creditcard')}}">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span class="d-block p-2"><strong>Card Holder Name</strong></span>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="holdername" maxlength="26" value="@if($user->creditcard){{$user->creditcard->CardHolderName}}@endif">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <span class="d-block p-2"><strong>Card#</strong></span>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" pattern="[0-9]{16}" maxlength="16" name="cardnumber" value="@if($user->creditcard){{$user->creditcard->CardNumber}}@endif">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <span class="d-block p-2"><strong>Expiry Month (mm)</strong></span>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" pattern="[0-9]{2}" maxlength="2" name="expirymonth" value="@if($user->creditcard){{$user->creditcard->ExpiryMonth}}@endif">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <span class="d-block p-2"><strong>Expiry Year (yy)</strong></span>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" pattern="[0-9]{2}" maxlength="2" name="expiryyear" value="@if($user->creditcard){{$user->creditcard->ExpiryYear}}@endif">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <span class="d-block p-2"><strong>CVV Code</strong></span>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" pattern="[0-9]{4}" maxlength="4" name="cvv" value="@if($user->creditcard){{$user->creditcard->cvv}}@endif">
                </div>
            </div>
        </div>

        <div class="container mt-3">
            <div class="row mt-2">
                <div class="col-md-12">
                    <button class="btn btn-success float-left" type="submit">Save</button>
                    <button id="credit-card-discard-btn" class="btn btn-danger float-right" type="button">Discard</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Form for uploading Credit Card Info End --}}
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
                    <img class="rounded" src="@if($user->mobilebank){{asset('storage/mobilebank/qrcode/' . $user->mobilebank->qr_code)}}@endif" alt="Opps! No Pic Found" height="200px" width="100%">
                </div>
            </div>
            {{-- QR Code Pic End --}}

            <div class="row mt-2">
                <div class="col-md-12">
                    <button id="mobile-account-show-form-btn" class="btn btn-success float-left">@if($user->mobilebank){{__('Update')}}@else{{__('Add New')}}@endif</button>
                    <form action="{{route('setting.mobileaccountsave')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger float-right" type="submit">Remove</button>
                    </form>
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
                        <button id="mobile-account-discard-btn" class="btn btn-danger float-right" type="button">Discard</button>
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
                        <form class="d-inline" action="{{route('settings.reapply')}}" method="POST">
                            @csrf
                            <button class="btn btn-outline-primary" title="Reapply">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                    <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                    <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                  </svg>
                            </button>
                        </form>
                    @elseif($user->AccountStatus == 'PENDING')
                        <span class="btn btn-warning disabled">{{$user->AccountStatus}}</span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <span class="d-block p-2"><strong>API Token</strong></span>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" id="apiShowBtn" title="Click to make API Token Visible">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                              </svg>
                        </button>
                        <input id="apiKey" type="text" class="form-control d-none" value="@if($user->api_token){{$user->api_token}}@endif" disabled>
                        <div class="input-group-append d-none" id="apiReBtn">
                            <form action="{{route('api.token.regenerate')}}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-outline-secondary" title="Regenerate API Token">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                        <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                        <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                      </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Change Password Start --}}
    <div class="jumbotron p-2">
        <div class="row">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Change Password</strong></span>
            </div>
            <div class="col-md-6">
                <form action="{{route('settings.changepassword')}}" method="POST">
                    @csrf
                    <input type="password" class="form-control mb-1 @error('currentpassword'){{ 'is-invalid' }}@enderror" name="currentpassword" placeholder="Current Password">
                    <input type="password" class="form-control mb-1 @error('newpassword1'){{ 'is-invalid' }}@enderror" name="newpassword1" placeholder="New Password - Can contains alpha, numerics, dashes, underscores">
                    <input type="password" class="form-control mb-1 @error('newpassword2'){{ 'is-invalid' }}@enderror" name="newpassword2" placeholder="Re-type New Password">
                    <button class="btn btn-success float-right" type="submit">Change Password</button>
                </form>
            </div>
        </div>
    </div>
    {{-- Change Password End --}}

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
{{-- Account Settings Block End --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        window.onload = function(){
            //Write Custom JQuery Here

            $(':input').click(function(){
                $(this).removeAttr('readonly');
                $(this).next().children('button').removeClass('disabled').click(function(){
                    if(!$(this).hasClass('disabled'))
                    {
                        $(this).addClass('disabled');
                        $(this).parent().prev().attr('readonly', 'true');
                        //Ajax Call will be created
                        $.post({
                            "headers" : {
                                "X-CSRF-TOKEN" : "{{ csrf_token() }}"
                            },
                            "url" : $(this).prev().val(),
                            "data" : {
                                "value" : $(this).parent().prev().val()
                            },
                            "success" : function(data){
                            alert(data);
                            }
                        });
                    }
                });

            });



            $('#apiShowBtn').click(function(){
                $('#apiShowBtn').addClass('d-none');
                $('#apiKey').removeClass('d-none');
                $('#apiReBtn').removeClass('d-none');
            });

            $('.pictures').click(function(){
                let el = $(this).children().last();
                switch(el.hasClass('d-none'))
                {
                    case true:
                        el.fadeIn('slow').addClass('d-block').removeClass('d-none');
                        break;

                    case false:
                        el.fadeOut('slow').removeClass('d-block').addClass('d-none');
                        break;
                }
            });

            $('#mobile-account-show-form-btn').click(function(){
                $('#mobile-account-upload-settings').fadeIn().removeClass('d-none').addClass('d-block');
            });

            $('#mobile-account-discard-btn').click(function(){
                $('#mobile-account-upload-settings').fadeOut().removeClass('d-block').addClass('d-none');
            });

            $('#credit-card-show-form-btn').click(function(){
                $('#credit-card-upload-settings').fadeIn().removeClass('d-none').addClass('d-block');
            });

            $('#credit-card-discard-btn').click(function(){
                $('#credit-card-upload-settings').fadeOut().removeClass('d-block').addClass('d-none');
            });

            //Custom JQuery End
        }
    </script>
@endsection
