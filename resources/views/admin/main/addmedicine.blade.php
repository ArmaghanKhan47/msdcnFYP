@extends('layouts.app')

@section('content')
    <div class="jumbotron p-3">
        <span class="h1 d-block">Add New Medicine</span>
    </div>
    <div class="container border border-secondary rounded p-3 pb-0">
        <form method="POST" action="{{route('admin.medicine.create')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group m-0">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Medicine Name</span>
                    </div>
                    <input type="text" name="medname" class="form-control @error('medname'){{'is-invalid'}}@enderror" value="{{old('medname')}}">
                </div>

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Medicine Company</span>
                    </div>
                    <input type="text" name="medcompany" class="form-control @error('medcompany'){{'is-invalid'}}@enderror" value="{{old('medcompany')}}">
                </div>

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Medicine Type</span>
                    </div>
                    <select name="medtype" class="form-control custom-select @error('medtype'){{'is-invalid'}}@enderror" value="{{old('medtype')}}">
                        <option value="0">Vial</option>
                        <option value="1">Tablets</option>
                        <option value="2">Syrup</option>
                        <option value="3">Drips</option>
                        <option value="4">Cream</option>
                        <option value="5">Gel</option>
                        <option value="6">Elixir</option>
                    </select>
                </div>

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Formula</span>
                    </div>
                    <input type="text" name="medformula" class="form-control @error('medformula'){{'is-invalid'}}@enderror" placeholder="separate each element by ," value="{{old('medformula')}}">
                </div>

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Medicine Picture</span>
                    </div>
                    <input type="file" name="coverimg" class="form-control @error('coverimg'){{'is-invalid'}}@enderror" placeholder="fuck">
                </div>
                <label class="text-muted">Maximium image size: 1.9MB | Supported formats: jpg, png, jpeg</label>

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Discription</span>
                    </div>
                    <textarea rows="6" name="meddiscription" class="form-control @error('meddiscription'){{'is-invalid'}}@enderror" value="{{old('meddiscription')}}"></textarea>
                </div>

                <button type="submit" class="btn btn-success btn-block">Create Medicine</button>
            </div>
        </form>
    </div>
@endsection
