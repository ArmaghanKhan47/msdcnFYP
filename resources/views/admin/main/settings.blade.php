@extends('layouts.admin')
@section('content')
<div class="jumbotron p-3">
    <span class="h1 d-block">Settings</span>
</div>

{{-- Show Mobile Account Info Start --}}
<div class="jumbotron p-3 mb-3">
    <span class="h2 d-block">Mobile Account Info</span>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Mobile Account</strong></span>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="{{$user->account_provider}}" disabled>
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
                <img class="rounded" src="{{asset('storage/admin/mobilebank/qrcode/' . $user->qr_code)}}" alt="Opps! No Pic Found" height="200px" width="100%">
            </div>
        </div>
        {{-- QR Code Pic End --}}

        <div class="row mt-2">
            <div class="col-md-12">
                <button id="mobile-account-show-form-btn" class="btn btn-success float-left">@if($user->account_provider){{__('Update')}}@else{{__('Add New')}}@endif</button>
                <button class="btn btn-danger float-right disabled" disabled>Remove</button>
            </div>
        </div>
    </div>
</div>
{{-- Show Mobile Account Info End --}}

{{-- Form for uploading Mobile Account Info Start --}}
<div id="mobile-account-upload-settings" class="jumbotron p-3 mb-3 d-none">
    <span class="h2 d-block">@if($user->account_provider){{__('Update')}}@else{{__('Add')}}@endif Mobile Account Info</span>

    <form method="POST" action="{{route('admin.settings.mobileaccountsave')}}" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span class="d-block p-2"><strong>Mobile Account</strong></span>
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="mobileaccountprovider" required>
                        <option value="0" @if($user->account_provider)@if(strstr($user->account_provider, 'EasyPaisa')){{'selected'}}@endif @endif>EasyPaisa</option>
                        <option value="1" @if($user->account_provider)@if(strstr($user->account_provider, 'JazzCash')){{'selected'}}@endif @endif>JassCash</option>
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

{{-- Account Settings Block Start --}}
<div class="jumbotron p-3 mb-3">
    <span class="h2 d-block">Account Settings</span>

    {{-- Change Password Start --}}
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span class="d-block p-2"><strong>Change Password</strong></span>
            </div>
            <div class="col-md-6">
                <form action="{{route('admin.settings.changepassword')}}" method="POST">
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
</div>
{{-- Account Settings Block End --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        window.onload = function(){
            //Custom JavaScript Start

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

            //Custom JavaScript End
        }
    </script>
@endsection
