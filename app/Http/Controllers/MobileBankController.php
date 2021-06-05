<?php

namespace App\Http\Controllers;

use App\Models\MobileBank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MobileBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MobileBank  $mobileBank
     * @return \Illuminate\Http\Response
     */
    public function show(MobileBank $mobileBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MobileBank  $mobileBank
     * @return \Illuminate\Http\Response
     */
    public function edit(MobileBank $mobileBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MobileBank  $mobileBank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MobileBank $mobileBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MobileBank  $mobileBank
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //Distributor Only
        Gate::authorize('distributorAccessOnly');

        $user = User::select('id', 'mobilebankaccountid')->find(Auth::id());
        $mobile = MobileBank::find($user->mobilebankaccountid);
        Storage::delete('public/mobilebank/qrcode/' . $mobile->qr_code);
        $user->mobilebankaccountid = null;
        $user->save();
        $mobile->delete();

        return redirect()->back()->with('success', 'Mobile Account Deleted');
    }
}
