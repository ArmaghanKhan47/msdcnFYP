<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Http\Controllers\CreditCardController;
use App\Models\DistributorShop;
use App\Models\RetailerShop;
use App\Models\SubscriptionHistoryDistributor;
use App\Models\SubscriptionHistoryRetailer;
use App\Models\SubscriptionPackage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Pull Subscription Packages
        $data = SubscriptionPackage::get();
        //Display Subscription Page
        return view('registration.subscription')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //This is for admin to create new Subscription Packages
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //This is for admin
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
        $details = SubscriptionPackage::find($id);
        $test = new CreditCardController();
        $card = $test->index();
        // return $card;
        return view('registration.subscriptioncheckout')->with('package', [$details, $card]);
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
        //Temporarly used for saving credit card details, later will move to separate controller specific for this purpose
        // $this->validate($request, [
        //     'holdername' => 'string|required|max:26',
        //     'expirymonth' => 'string|required|max:2',
        //     'expiryyear' => 'string|required|max:2',
        //     'cvv' => 'string|required|max:4',
        //     'cardnumber' => 'string|required|max:16'
        // ]);

        // $card = CreditCard::create([
        //     'CardHolderName' => $request->input('holdername'),
        //     'ExpiryMonth' => $request->input('expirymonth'),
        //     'ExpiryYear' => $request->input('expiryyear'),
        //     'cvv' => $request->input('cvv'),
        //     'CardNumber' => $request->input('cardnumber'),
        // ]);

        $test = new CreditCardController();
        $cardid = $test->create($request);

        $user = User::find(Auth::id());
        if ($cardid != null)
        {
            $user->CreditCardId = $cardid;
        }
        $user->AccountStatus = 'ACTIVE';
        $user->save();

        //now check that user is a Retailer or Distributor and act accordingly

        if (Auth::user()->UserType == 'Retailer')
        {
            $retailer = RetailerShop::where('UserId', '=', Auth::id())->first();

            SubscriptionHistoryRetailer::create([
                'SubscriptionPackageId' => $id,
                'RetailerId' => $retailer->RetailerShopId,
                'startDate' => date("Y-m-d")
            ]);
        }
        elseif(Auth::user()->UserType == 'Distributor')
        {
            $distributor = DistributorShop::where('UserId', '=', Auth::id())->first();

            SubscriptionHistoryDistributor::create([
                'SubscriptionPackageId' => $id,
                'RetailerId' => $distributor->DistributorShopId,
                'startDate' => date("Y-m-d")
            ]);
        }

        return redirect(route('home'))->with('success', 'Hoorah! You Subscribed, Thank You!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //This is for Admin to Remove Subscription Packages from Database
    }
}
