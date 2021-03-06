<?php

namespace App\Http\Controllers;

use App\Events\QrCodeEvent;
use App\Models\RetailerShop;
use App\Models\DistributorShop;
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
        $data = Auth::user()->UserType;
        return view('registration.shopRegistration')->with('type', $data);
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
            'shopname' => 'required|string',
            'region' => 'required|string',
            'liscenceno' => 'required|string',
            'contactnumber' => 'required|string|min:11|max:11',
            'lispic' => 'required|image|mimes:jpg,png,jpeg|max:1999',
            'mobilebankaccountprovider' => 'numeric|min:0|max:1',
            'qrcode' => 'image|mimes:jpg,png,jpeg|max:1999'
        ]);

        $filename = 'liscence_pic_' . str_replace(" ", "_", $request->input('shopname')) . '_' . Auth::user()->UserType . "_" . $request->input('region') . "_" . time(). '.' . $request->file('lispic')->getClientOriginalExtension();

        if ($request->hasFile('qrcode'))
        {
            $user = User::find(Auth::id());
            event(new QrCodeEvent($request->file('qrcode'), $user, [$request->input('mobilebankaccountprovider'), $request->input('shopname'), $request->input('region')]));
        }

        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $request->file('lispic')->storePubliclyAs('public/retailer/liscence', $filename);
                //If user is Retailer
                RetailerShop::create([
                    'RetailerShopName' => $request->input('shopname'),
                    'LiscenceNo' => $request->input('liscenceno'),
                    'ContactNumber' => $request->input('contactnumber'),
                    'Region' => $request->input('region'),
                    'LiscenceFrontPic' => $filename,
                    'UserId' => Auth::id(),
                ]);
                break;

            case 'Distributor':
                $request->file('lispic')->storePubliclyAs('public/distributor/liscence', $filename);
                //If user is Distributor
                DistributorShop::create([
                    'DistributorShopName' => $request->input('shopname'),
                    'LiscenceNo' => $request->input('liscenceno'),
                    'ContactNumber' => $request->input('contactnumber'),
                    'Region' => $request->input('region'),
                    'LiscenceFrontPic' => $filename,
                    'UserId' => Auth::id()
                ]);
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
