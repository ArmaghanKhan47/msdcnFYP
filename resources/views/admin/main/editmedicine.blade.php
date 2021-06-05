@extends('layouts.admin')

@section('content')
<div class="jumbotron p-3 mb-3">
    <span class="h1 d-block">Edit Medicine</span>
</div>

<div class="container-fluid p-3 overflow-auto">
    <div class="row justify-content-center">
        <div class="col-md-6 pr-0">
            <form method="POST" action="{{route('admin.medicine.edit', [$medicine->MedicineId])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="jumbotron p-2 bg-transparent border border-secondary">
                    <span class="d-block h5">Basic Details</span>
                    <hr>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Medicine Name</span>
                        </div>
                        <input type="text" name="medname" class="form-control @error('medname'){{'is-invalid'}}@enderror" value="{{$medicine->MedicineName}}">
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Medicine Company</span>
                        </div>
                        <input type="text" name="medcompany" class="form-control @error('medcompany'){{'is-invalid'}}@enderror" value="{{$medicine->MedicineCompany}}">
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Medicine Type</span>
                        </div>
                        <select name="medtype" class="form-control custom-select @error('medtype'){{'is-invalid'}}@enderror" value="{{$medicine->MedicineType}}">
                            <option value="0" @if($medicine->MedicineType == 'Vial'){{'selected'}}@endif>Vial</option>
                            <option value="1" @if($medicine->MedicineType == 'Tablets'){{'selected'}}@endif>Tablets</option>
                            <option value="2" @if($medicine->MedicineType == 'Syrup'){{'selected'}}@endif>Syrup</option>
                            <option value="3" @if($medicine->MedicineType == 'Drips'){{'selected'}}@endif>Drips</option>
                            <option value="4" @if($medicine->MedicineType == 'Cream'){{'selected'}}@endif>Cream</option>
                            <option value="5" @if($medicine->MedicineType == 'Gel'){{'selected'}}@endif>Gel</option>
                            <option value="6" @if($medicine->MedicineType == 'Elixir'){{'selected'}}@endif>Elixir</option>
                        </select>
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Formula</span>
                        </div>
                        <input type="text" name="medformula" class="form-control @error('medformula'){{'is-invalid'}}@enderror" placeholder="separate each element by ," value="{{implode(',', json_decode($medicine->MedicineFormula))}}">
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
                        <textarea rows="6" name="meddiscription" class="form-control @error('meddiscription'){{'is-invalid'}}@enderror" value="">{{$medicine->MedicineDiscription}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Update Medicine</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
