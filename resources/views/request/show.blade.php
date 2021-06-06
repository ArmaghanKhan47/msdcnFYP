@extends((Auth::guard('web')->check()) ? 'layouts.app' : 'layouts.admin')

@section('content')
    <div class="jumbotron p-3">
        <div class="row">
            <div class="col-md-6">
                <span class="h1 d-block">{{json_decode($request->message)->title}} - #{{$request->id}}</span>
            </div>
            <div class="p-2 col-md-6 d-flex align-items-middle justify-content-end">
                <span class="mr-2">
                    @auth('admin')
                        <form method="POST" action="{{route('admin.feedback.completed', $request->id)}}">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-success">{{$request->status}}</button>
                        </form>
                    @endauth

                    @auth('web')
                        <button class="btn btn-success">{{$request->status}}</button>
                    @endauth
                </span>
            </div>
        </div>
    </div>

    {{-- Message Area Start --}}
    <div class="container overflow-scroll h-50">
        @foreach (json_decode($request->message)->comments as $item)
            @if ($item[2] == 'admin')
                <div class="row mb-1 @auth('admin'){{'justify-content-end'}}@endauth">
                    <div class="col-md-6 p-1 jumbotron m-0">
                        <span class="d-block h5">{{$item[0]}}</span>
                        <span class="d-block text-muted h6 m-0">{{$item[1]}}</span>
                    </div>
                </div>
            @elseif($item[2] == 'user')
            <div class="row mb-1 @auth('web'){{'justify-content-end'}}@endauth">
                <div class="col-md-6 p-1 jumbotron m-0">
                    <span class="d-block h5">{{$item[0]}}</span>
                    <span class="d-block text-muted h6 m-0">{{$item[1]}}</span>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    {{-- Message Area End --}}

    @if ($request->status == 'Active')
        <div class="container">
            <form method="POST" action="@auth('admin'){{route('admin.feedback.update', $request->id)}}@endauth @auth('web'){{route('request.update', $request->id)}}@endauth">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-11 p-0">
                        <input name="comment" type="text" class="form-control">
                    </div>
                    <div class="col-1 p-0 pl-md-3">
                        <button class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4.5 5.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif

@endsection
