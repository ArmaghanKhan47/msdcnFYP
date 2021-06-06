@extends('layouts.admin')

@section('content')
    <div class="jumbotron p-3 mb-1">
        <span class="h1 d-block">Feedbacks</span>
    </div>

    <div class="jumbotron p-3">
        <button id="btn-active" class="btn btn-primary d-inline">Active</button>
        <button id="btn-completed" class="btn btn-secondary d-inline">Completed</button>
    </div>

    <div id="active" class="container p-0 d-block">
        @include('svgarts.empty', ['count' => !count($active)])
        @foreach ($active as $feedback)
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
    </div>

    <div id="completed" class="container p-0 d-none">
        @include('svgarts.empty', ['count' => !count($completed)])
        @foreach ($completed as $feedback)
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
    </div>
@endsection

@section('scripts')
    <script>
        window.onload = function(){
            //Custom JQuery Start

            //Adding event listener to #btn-all
            $('#btn-active').click(function(){
                //Playing with buttons
                $('#btn-active').removeClass('btn-secondary').addClass('btn-primary');
                $('#btn-completed').removeClass('btn-success').addClass('btn-secondary');

                //Playing with containers
                $('#active').removeClass('d-none').addClass('d-block');
                $('#completed').removeClass('d-block').addClass('d-none');
            });

            //Adding event listener to #btn-completed
            $('#btn-completed').click(function(){
                //Playing with buttons
                $('#btn-active').removeClass('btn-primary').addClass('btn-secondary');
                $('#btn-completed').removeClass('btn-secondary').addClass('btn-success');

                //Playing with containers
                $('#active').removeClass('d-block').addClass('d-none');
                $('#completed').removeClass('d-none').addClass('d-block');
            });

            //Custom JQuery End
        }
    </script>
@endsection
