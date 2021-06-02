@extends('layouts.admin')

@section('content')
<div class="jumbotron p-3 mb-3">
    <span class="h1 d-block">Edit Medicine</span>
</div>

<div class="container-fluid p-3 overflow-auto">
        <div class="row mb-2">
                <div class="col-md-6 pl-0">
                    <img class="rounded" src="/storage/medicines/{{$medicine->MedicinePic}}" height="300px" width="400px">
                </div>
                <div class="col-md-6 pr-0">
                    <form id="form1" method="POST" action="{{route('admin.medicine.edit', [$medicine->MedicineId])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="jumbotron p-2">
                            <label for="medname">Medicine Name</label>
                            <input id="medname" name="medname" class="form-control" value="{{$medicine->MedicineName}}">

                            <label class="mt-2" for="medcompnay">Company Name</label>
                            <input id="medcompany" name="medcompany" class="form-control" value="{{$medicine->MedicineCompany}}">

                            <label class="mt-2" for="medtype">Company Type</label>
                            <select id="medtype" name="medtype" class="form-control custom-select @error('medtype'){{'is-invalid'}}@enderror" value="{{old('medtype')}}">
                                <option value="Vial" @if($medicine->MedicineType == 'Vial'){{'selected'}}@endif>Vial</option>
                                <option value="Tablets" @if($medicine->MedicineType == 'Tablets'){{'selected'}}@endif>Tablets</option>
                                <option value="Syrup" @if($medicine->MedicineType == 'Syrup'){{'selected'}}@endif>Syrup</option>
                                <option value="Drips" @if($medicine->MedicineType == 'Drips'){{'selected'}}@endif>Drips</option>
                            </select>

                            <label class="mt-2" for="medformula">Formula</label>
                            <input id="medformula" class="form-control" name="medformula" value="{{implode(',', json_decode($medicine->MedicineFormula))}}">

                            <label class="mt-2" for="medpic">Picture</label>
                            <input id="medpic" type="file" name="coverimg" class="form-control">

                            <input type="hidden" name="meddiscription" value="" id="hiddendiscription">
                        </div>
                    </form>
                </div>
        </div>

        <div class="row">
            <div class="col-md-12 p-0">
                <div class="jumbotron p-3">
                    <span class="h1 d-block">Discription</span>
                    <textarea id="discription" class="form-control" rows="1">{{$medicine->MedicineDiscription}}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 p-0">
                <button id="submitbtn" class="btn btn-success">Save Changes</button>
                <a href="{{route('admin.medicine.index')}}" class="btn btn-danger float-right">Discard</a>
            </div>
        </div>
</div>
<script>
    document.getElementById('submitbtn').addEventListener('click', function(){
        var disel = document.getElementById('discription').value;
        document.getElementById('hiddendiscription').value = disel;
        document.getElementById('form1').submit();
    });
</script>
@endsection
