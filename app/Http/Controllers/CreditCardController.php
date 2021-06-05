<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreditCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         return CreditCard::find(Auth::user()->CreditCardId);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Check if credit card exist
        $card = Auth::user()->CreditCardId;
        if ($card == null)
        {
            //No credit card exist
            return $this->store($request);
        }

        return null;

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
            'holdername' => 'string|required|max:26',
            'expirymonth' => 'string|required|max:2',
            'expiryyear' => 'string|required|max:2',
            'cvv' => 'string|required|max:4',
            'cardnumber' => 'string|required|max:16'
        ]);

        $card = CreditCard::create([
            'CardHolderName' => $request->input('holdername'),
            'ExpiryMonth' => $request->input('expirymonth'),
            'ExpiryYear' => $request->input('expiryyear'),
            'cvv' => $request->input('cvv'),
            'CardNumber' => $request->input('cardnumber'),
        ]);

        return $card->rowId;
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
    public function update(Request $request)
    {
        //This function gonna be used by settings
        $user = User::select('id', 'CreditCardId')->with('creditcard')->find(Auth::id());

        if(!$user->creditcard)
        {
            //Means No Credit Card Exist
            $cardid = $this->store($request);
            $user->CreditCardId = $cardid;
            $user->save();

            return redirect()->back()->with('success', 'Credit Card Saved');
        }

        $this->validate($request, [
            'holdername' => 'string|required|max:26',
            'expirymonth' => 'string|required|max:2',
            'expiryyear' => 'string|required|max:2',
            'cvv' => 'string|required|max:4',
            'cardnumber' => 'string|required|max:16'
        ]);

        $user->creditcard->CardHolderName = $request->holdername;
        $user->creditcard->ExpiryYear = $request->expiryyear;
        $user->creditcard->ExpiryMonth = $request->expirymonth;
        $user->creditcard->cvv = $request->cvv;
        $user->creditcard->CardNumber = $request->cardnumber;
        $user->creditcard->save();

        return redirect()->back()->with('success', 'Credit Card Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        $user = User::select('id', 'CreditCardId')->find(Auth::id());
        $card = CreditCard::find($user->CreditCardId);
        $user->CreditCardId = null;
        $user->save();

        $card->delete();

        return redirect()->back()->with('success', 'Credit Card Deleted');
    }
}
