<?php

namespace App\Http\Controllers;

use App\Enums\Regions;
use App\Models\Distributor;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['regions'] = Regions::list();
        return view('registration.shop', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'shopname' => 'required|string|max:191',
            'region' => ['required', 'numeric', 'min:0', 'max:' . (Regions::length() - 1)],
            'role' => 'required|numeric|min:0|max:1',
            'liscenceno' => 'required|string|max:191',
            'contactnumber' => 'required|string|min:11|max:11',
            'lispic' => 'required|image|mimes:jpg,png,jpeg,webp|max:1999',
        ]);

        $file_name = 'liscence_pic_' . str_replace(" ", "_", $request->input('shopname')) . '_' . $request->role . "_" . $request->input('region') . "_" . time(). '.' . $request->file('lispic')->getClientOriginalExtension();

        switch($request->role)
        {
            case 0:
                // Retailer
                $request->file('lispic')->storePubliclyAs('public/retailer/liscence', $file_name);

                $retailer = Retailer::create([
                    'shop_name' => $request->shopname,
                    'liscence_no' => $request->liscenceno,
                    'region' => Regions::list()[$request->region],
                    'contact_no' => $request->contactnumber,
                    'liscence_front_pic' => $file_name
                ]);

                $retailer->user()->save(Auth::user());
                break;

            case 1:
                // Distributor
                $request->file('lispic')->storePubliclyAs('public/distributor/liscence', $file_name);

                $distributor = Distributor::create([
                    'shop_name' => $request->shopname,
                    'liscence_no' => $request->liscenceno,
                    'region' => Regions::list()[$request->region],
                    'contact_no' => $request->contactnumber,
                    'liscence_front_pic' => $file_name
                ]);

                $distributor->user()->save(Auth::user());
                break;
        }

        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
