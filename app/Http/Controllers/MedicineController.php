<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function show($id)
    {
        //$id = Medicine Id
        $data = Medicine::find($id);
        // return $data;
        return view('testingViews.medicinedetail')->with('data', $data);
    }
}
