@extends('layouts.admin')

@section('content')
<div class="container overflow-show py-1 p-0">
    <div class="border border-secondary p-3 rounded my-2">
        <span class="h1 d-block m-0">{{ $type }} ({{ $users->count() }})</span>
    </div>

    @if ($users->isEmpty())
        @include('svgarts.empty')
    @endif

    <div class="container p-0">
        @foreach ($users as $user)
            <div class="border border-secondary rounded p-3 my-1">
                <div class="row text-center">
                    <div class="col-md-2">
                        <span class="fs-5 d-block">{{$user->id}}</span>
                        <span class="fs-6 d-block text-muted">User Id</span>
                    </div>
                    <div class="col-md-2">
                        <span class="h5 d-block">{{$user->name}}</span>
                        <span class="h6 d-block text-muted">User Name</span>
                    </div>
                    <div class="col-md-3">
                        <span class="h5 d-block">{{$user->email}}</span>
                        <span class="h6 d-block text-muted">User Email</span>
                    </div>
                    <div class="col-md-2">
                        <span class="h5 d-block">
                            @if ($user->account_status === App\Enums\AccountStatus::$PENDING)
                            <span class="badge bg-info text-dark">
                                {{$user->account_status}}
                            </span>
                            @elseif ($user->account_status === App\Enums\AccountStatus::$ACTIVE)
                            <span class="badge bg-success text-dark">
                                {{$user->account_status}}
                            </span>
                            @elseif ($user->account_status === App\Enums\AccountStatus::$DEACTIVE)
                            <span class="badge bg-danger text-dark">
                                {{$user->account_status}}
                            </span>
                            @endif
                        </span>
                        <span class="h6 d-block text-muted">Status</span>
                    </div>
                    <div class="col-md-2">
                        <span class="h5 d-block">{{date('d/m/Y', strtotime($user->created_at))}}</span>
                        <span class="h6 d-block text-muted">Account Created</span>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection
