@extends('layouts.admin')

@section('content')
    <div class="jumbotron p-3">
        <span class="h1 d-block">Feedbacks</span>
    </div>
    @if ($feedbacks->count() != 0)

        @foreach ($feedbacks as $feedback)
        <a href="{{route('admin.feedback.show', [$feedback->id])}}" class="text-reset text-decoration-none">
            <div class="jumbotron p-3 mb-1">
                <div class="row">
                    <div class="col-md-3">
                        <span class="h5 d-block">{{$feedback->id}}</span>
                        <span class="h6 d-block text-muted">Feedback Id</span>
                    </div>
                    <div class="col-md-3">
                        <span class="h5 d-block">{{json_decode($feedback->message)->title}}</span>
                        <span class="h6 d-block text-muted">Title</span>
                    </div>
                    <div class="col-md-3">
                        <span class="h5 d-block">{{$feedback->user->name}}</span>
                        <span class="h6 d-block text-muted">User Name</span>
                    </div>
                    <div class="col-md-3">
                        <span class="h5 d-block">{{$feedback->created_at}}</span>
                        <span class="h6 d-block text-muted">Feedback Submitted</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        <div class="jumbotron p-0 m-0"></div>
    @else
        <div class="jumbotron p-3 text-center">
            <span class="d-block h4">No Feedbacks</span>
        </div>
    @endif
@endsection
