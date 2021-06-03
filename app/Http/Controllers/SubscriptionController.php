<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CreditCardController;
use App\Models\SubscriptionHistoryDistributor;
use App\Models\SubscriptionHistoryRetailer;
use App\Models\SubscriptionPackage;
use App\Models\User;
use App\Notifications\SubscribedNotification;
use App\Notifications\SubscriptionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['show','update', 'index']);
    }
    public function index()
    {
        //For User
        //Pull Subscription Packages
        $data = SubscriptionPackage::get();
        //Display Subscription Page
        return view('registration.subscription')->with('data', $data);
    }

    public function adminindex()
    {
        $packages = SubscriptionPackage::get();
        return view('admin.main.allsubscriptionpackages', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //This is for admin to create new Subscription Packages
        return view('admin.main.addsubscriptionpackage');
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
        $this->validate($request, [
            'pkgname' => 'string|required|max:255',
            'pkgprice' => 'numeric|required',
            'pkgduration' => 'numeric|required',
            'supportapi' => 'numeric|required|max:1|min:0'
        ]);

        $id = SubscriptionPackage::create([
            'PackageName' => $request->input('pkgname'),
            'PackagePrice' => $request->input('pkgprice'),
            'PackageDuration' => $request->input('pkgduration'),
            'supportApi' => $request->input('supportapi')
        ])->PackageId;

        Notification::send(User::all(), new SubscriptionNotification('New Package is introduced with name ' . $request->input('pkgname')));

        return redirect(route('admin.subscription.index'))->with('success', 'Package is created with id ' . $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //For User
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
        //For Admin
        $data = SubscriptionPackage::find($id);
        return view('admin.main.editsubscriptionpackage')->with('package', $data);
    }

    public function adminUpdate(Request $request, $id)
    {
        //For Admin
        $this->validate($request, [
            'pkgname' => 'string|required|max:255',
            'pkgprice' => 'numeric|required',
            'pkgduration' => 'numeric|required',
            'supportapi' => 'numeric|required|max:1|min:0'
        ]);

        $package = SubscriptionPackage::find($id);
        $package->PackageName = $request->input('pkgname');
        $package->PackagePrice = $request->input('pkgprice');
        $package->PackageDuration = $request->input('pkgduration');
        $package->supportApi = $request->input('supportapi');
        $package->save();

        return redirect(route('admin.subscription.index'))->with('success', 'Packaged Updated');

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
        //For User
        $test = new CreditCardController();
        $cardid = $test->create($request);

        $user = User::find(Auth::id());
        if ($cardid != null)
        {
            //New Credit Card REcord is created creted
            $user->CreditCardId = $cardid;
        }
        $user->save();

        //now check that user is a Retailer or Distributor and act accordingly
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $user = User::select('id', 'api_token')->with('retailershop:RetailerShopId,UserId')->where('id', Auth::id())->first();

                SubscriptionHistoryRetailer::create([
                    'SubscriptionPackageId' => $id,
                    'RetailerId' => $user->retailershop->RetailerShopId,
                    'startDate' => date("Y-m-d"),
                    'TransactionId' => 000000000000
                ]);
                break;

            case 'Distributor':
                $user = User::select('id', 'api_token')->with('distributorshop:DistributorShopId,UserId')->where('id', Auth::id())->first();

                SubscriptionHistoryDistributor::create([
                    'SubscriptionPackageId' => $id,
                    'DistributorId' => $user->distributorshop->DistributorShopId,
                    'startDate' => date("Y-m-d"),
                    'TransactionId' => 000000000000
                ]);
                break;
        }

        $user->AccountStatus = 'PENDING';
        //If Package Support API Then genetrate API for the user
        $subscription_api_support = SubscriptionPackage::select('PackageId', 'PackageName', 'supportApi')->where('PackageId', $id)->first();
        if ($subscription_api_support->supportApi)
        {
            $user->api_token = Str::random(60);
            $user->save();
        }
        else
        {
            $user->api_token = null;
            $user->save();
        }

        Notification::send(Auth::user(), new SubscribedNotification('You Have Subscribed our ' . $subscription_api_support->PackageName . ' Package'));

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
