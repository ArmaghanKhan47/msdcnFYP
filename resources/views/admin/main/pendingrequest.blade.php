@extends('layouts.app')

@section('content')
    <div class="jumbotron p-3">
        <span class="h1 d-block">Pending Requests</span>
    </div>
    @if ($pendings->count() != 0)

        @foreach ($pendings as $pending)
            <div class="jumbotron p-3 mb-1">
                <div class="row">
                    <div class="col-md-2">
                        <span class="h5 d-block">{{$pending->id}}</span>
                        <span class="h6 d-block text-muted">User Id</span>
                    </div>
                    <div class="col-md-2">
                        <span class="h5 d-block">{{$pending->name}}</span>
                        <span class="h6 d-block text-muted">User Name</span>
                    </div>
                    <div class="col-md-3">
                        <span class="h5 d-block">{{$pending->email}}</span>
                        <span class="h6 d-block text-muted">User Email</span>
                    </div>
                    <div class="col-md-2">
                        <span class="h5 d-block">{{$pending->AccountStatus}}</span>
                        <span class="h6 d-block text-muted">Status</span>
                    </div>
                    <div class="col-md-2">
                        <span class="h5 d-block">{{$pending->created_at}}</span>
                        <span class="h6 d-block text-muted">Account Created</span>
                    </div>
                    <div class="col-md-1">
                        <div class="row d-block d-md-none">
                            {{-- It will display on small screens --}}
                            <div class="col-sm-12">
                                <form class="float-right" method="POST" action="#">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" href="#nolink"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg></button>
                                </form>
                                <form method="POST" action="{{route('admin.request.accepte', [$pending->id])}}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary" href="#nolink">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="row text-right d-none d-md-block">
                            {{-- It will display on screens from md to xxl --}}
                            <div class="col-md-12">
                                <form class="d-inline" method="POST" action="{{route('admin.request.rejected', [$pending->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" href="#nolink"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg></button>
                                    </form>
                            </div>
                        </div>
                        <div class="row text-right mt-1 d-none d-md-block">
                            {{-- It will display on screens from md to xxl --}}
                            <div class="col-md-12">
                                <form class="d-inline" method="POST" action="{{route('admin.request.accepte', [$pending->id])}}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary" href="#nolink">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                        </svg>
                                    </button>
                                    </form>
                            </div>
                        </div>
                </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <button class="btn btn-secondary btn-block" id="detailbtn-{{$pending->id}}">Show Details</button>
                    </div>
                </div>
                <div class="row mt-2 d-none" id="list-{{$pending->id}}">
                    <div class="col-md-6">
                        <div class="jumbotron p-2 text-center">
                            <img class="d-block" src="/storage/cnic/front/{{$pending->CnicFrontPic}}" alt="No Image Found">
                            <span class="h5">Cnic Front Pic</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($pending->UserType == 'Retailer')
                            <div class="jumbotron p-2 text-center">
                                <img class="d-block" src="/storage/retailer/liscence/{{$pending->retailershop->LiscenceFrontPic}}" alt="No Image Found">
                                <span class="h5">Liscence Pic</span>
                            </div>
                        @elseif($pending->UserType == 'Distributor')
                            <div class="jumbotron p-2 text-center">
                                <img class="d-block" src="/storage/distributor/liscence/{{$pending->distributorshop->LiscenceFrontPic}}" alt="No Image Found">
                                <span class="h5">Liscence Pic</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <hr class="divider bg-danger">
                        <span class="h3 d-block text-center">Details</span>
                        <hr class="divider">
                        <span class="d-block">
                            <span class="h4">Cnic#</span>
                            <span class="h5 float-right">{{$pending->CnicCardNumber}}</span>
                            <hr class="divider">
                        </span>
                        @if ($pending->UserType == 'Retailer')
                            <span class="d-block">
                                <span class="h4">Liscence#</span>
                                <span class="h5 float-right">{{$pending->retailershop->LiscenceNo}}</span>
                                <hr class="divider">
                            </span>

                            <span class="d-block">
                                <span class="h4">Shop Name: </span>
                                <span class="h5 float-right">{{$pending->retailershop->RetailerShopName}}</span>
                                <hr class="divider">
                            </span>

                            <span class="d-block">
                                <span class="h4">Shop Address: </span>
                                <span class="h5 float-right">{{$pending->retailershop->shopAddress}}</span>
                                <hr class="divider">
                            </span>

                            <span class="d-block">
                                <span class="h4">Contact# </span>
                                <span class="h5 float-right">{{$pending->retailershop->ContactNumber}}</span>
                            </span>
                        @elseif($pending->UserType == 'Distributor')
                            <span class="d-block">
                                <span class="h4">Liscence#</span>
                                <span class="h5 float-right">{{$pending->distributorshop->LiscenceNo}}</span>
                                <hr class="divider">
                            </span>

                            <span class="d-block">
                                <span class="h4">Shop Name: </span>
                                <span class="h5 float-right">{{$pending->distributorshop->RetailerShopName}}</span>
                                <hr class="divider">
                            </span>

                            <span class="d-block">
                                <span class="h4">Shop Address: </span>
                                <span class="h5 float-right">{{$pending->distributorshop->shopAddress}}</span>
                                <hr class="divider">
                            </span>

                            <span class="d-block">
                                <span class="h4">Contact# </span>
                                <span class="h5 float-right">{{$pending->distributorshop->ContactNumber}}</span>
                            </span>
                        @endif
                    </div>
                </div>
                <script>
                    window.onload = function(){
                        //Custom JQuery Start

                        $('#detailbtn-{{$pending->id}}').click(function(){
                            var list = $('#list-{{$pending->id}}');
                            if(list.hasClass('d-none'))
                            {
                                list.removeClass('d-none').addClass('d-flex');
                            }
                            else if (list.hasClass('d-flex'))
                            {
                                list.removeClass('d-flex').addClass('d-none');
                            }
                        });

                        //Custom JQuery End
                    }
                </script>
            </div>
        @endforeach
    @else
        <div class="jumbotron p-3 text-center">
            <span class="d-block h4">No Requests</span>
        </div>
    @endif
@endsection
