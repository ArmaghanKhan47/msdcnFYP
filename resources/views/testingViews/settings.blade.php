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
                    <input id="email-input" type="text" class="form-control" value="{{$user->email}}" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary disabled"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
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
                    <input type="text" class="form-control" value="{{$shop->ContactNumber}}" readonly>
                    <div class="input-group-append">
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
                    <input type="text" class="form-control" value="{{$shop->shopAddress}}" readonly>
                    <div class="input-group-append">
                        <input type="hidden" name="link" value="/settings/shopaddress">
                        <button class="btn btn-outline-secondary disabled"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
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
                    <input type="text" class="form-control" value="@if($card){{$card->CardHolderName}}@endif" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary disabled"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
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
                    <input type="text" class="form-control" value="@if($card){{$card->CardNumber}}@endif" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary disabled"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
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
                    <input type="text" class="form-control" value="@if($card){{$card->ExpiryMonth}}/{{$card->ExpiryYear}}@endif" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary disabled"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
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
<script>
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

        //Custom JQuery End
    }
</script>
@endsection
