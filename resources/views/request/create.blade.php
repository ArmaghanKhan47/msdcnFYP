@extends('layouts.app')

@section('content')
    <div class="jumbotron p-3">
        <span class="h1 d-block">Request / Feedback</span>
    </div>

    <div class="jumbotron p-2">
        <form method="POST" action="{{route('request.store')}}">
            @csrf
            <input name="title" type="text" class="form-control" placeholder="Title">
            <textarea name="discription" class="form-control mt-1" rows="10" placeholder="Discription"></textarea>
            <button type="submit" class="btn btn-success mt-1">Submit</button>
        </form>
    </div>
@endsection
