<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;

class MedicineController extends Controller
{

    public function __construct()
    {
        //Appling default middleware to only Show
        $this->middleware('auth')->only('show');
        //Appling Admin Auth to function except Show
        $this->middleware('auth:admin')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $medicines = Medicine::get();
        return view('admin.main.allmedicines', compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //For Admin
        return view('admin.main.addmedicine');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $distributorid)
    {
        ////$id = Medicine Id
        $data = Medicine::with(['inventorydistributor' => function($query) use ($distributorid)
        {
            $query->where('DistributorShopId', $distributorid);
        }, 'inventorydistributor.distributor:DistributorShopId,DistributorShopName'])->find($id);
        return view('testingViews.medicinedetail')->with('data', $data);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
