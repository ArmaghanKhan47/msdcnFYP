@extends('layouts.admin')

@section('content')
    <div class="jumbotron p-3">
        <div class="row">
            <div class="col-md-10">
                <span class="h1 d-block">Medicines</span>
            </div>
            <div class="p-2 col-md-2 d-flex align-items-middle justify-content-end">
                <span>
                    <a href="{{route('admin.medicine.create')}}" class="btn btn-success">Add New Medicine</a>
                </span>
            </div>
        </div>
    </div>

    @include('svgarts.empty', ['count' => !count($medicines)])

    <div class="container p-0">
        @foreach ($medicines as $medicine)
            <div class="jumbotron p-3 mb-1">
                <div class="row">
                    <div class="col-md-2">
                        <span class="h5 d-block">{{$medicine->MedicineId}}</span>
                        <span class="h6 d-block text-muted">Medicine Id</span>
                    </div>
                    <div class="col-md-2">
                        <span class="h5 d-block">{{$medicine->MedicineName}}</span>
                        <span class="h6 d-block text-muted">Medicine Name</span>
                    </div>
                    <div class="col-md-2">
                        <span class="h5 d-block">{{$medicine->MedicineCompany}}</span>
                        <span class="h6 d-block text-muted">Company</span>
                    </div>
                    <div class="col-md-2">
                        <span class="h5 d-block">{{$medicine->MedicineType}}</span>
                        <span class="h6 d-block text-muted">Type</span>
                    </div>
                    <div class="col-md-2">
                        <span class="h5 d-block">{{implode(',', json_decode($medicine->MedicineFormula))}}</span>
                        <span class="h6 d-block text-muted">Formula/Contains</span>
                    </div>
                    <div class="col-md-2">
                          <form class="d-none" method="POST" action="{{route('admin.medicine.delete', [$medicine->MedicineId])}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger float-right mt-2" href="#nolink"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                              </svg></button>
                          </form>
                          <a class="btn btn-primary float-right mr-2 mt-2" href="{{route('admin.medicine.edit', [$medicine->MedicineId])}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                          </svg></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
