<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Events\QrCodeEvent;
use App\Models\DistributorShop;
use App\Models\MobileBank;
use App\Models\RetailerShop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    //
    public function index()
    {
        //Fetch Shop Data
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $user = User::with(['retailershop', 'creditcard', 'mobilebank'])->where('id', Auth::id())->first();
                break;
            case 'Distributor':
                $user = User::with(['distributorshop', 'creditcard', 'mobilebank'])->where('id', Auth::id())->first();
                break;
        }

        return view('testingViews.settings', compact('user'));
    }

    //To Regenerate API Token
    public function regenerateApiToken()
    {
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $user = User::select('id', 'api_token')->with(['retailershop' => function($query){
                    $query->select('RetailerShopId', 'UserId')->with('subscription:HistoryId,SubscriptionPackageId,RetailerId','subscription.package:PackageId,supportApi');
                }])->find(Auth::id());

                $subscription_api_support = $user->retailershop->subscription->package->supportApi;
                break;

            case 'Distributor':
                $user = User::select('id', 'api_token')->with(['distributorshop' => function($query){
                    $query->select('DistributorShopId', 'UserId')->with('subscription:HistoryId,SubscriptionPackageId,DistributorId','subscription.package:PackageId,supportApi');
                }])->find(Auth::id());

                $subscription_api_support = $user->distributorshop->subscription->package->supportApi;
                break;
        }
        if(!$subscription_api_support)
        {
            //Means you can regenerate your api token
            if ($user->api_token)
            {
                $user->api_token = null;
                $user->save();
            }
            return redirect()->back()->with('error', 'Your current subscription does not support api token');
        }
        $user->api_token = Str::random(60);
        $user->save();
        return redirect()->back()->with('success', 'New API Token is Generated');
    }

    //To Reapply for Application
    public function reapply()
    {
        $user = User::find(Auth::id());
        $user->AccountStatus = 'PENDING';
        $user->save();
        return redirect()->back()->with('success', 'Your have applied again and your application is under review');
    }

    //To Update Shop Address
    public function updateShopAddress(Request $request)
    {
        $this->validate($request, [
            'value' => 'string|required'
        ]);

        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $shop = RetailerShop::where('UserId', Auth::id())->first();
                $shop->shopAddress = $request->input('value');
                $shop->save();
                return 'Changes Saved';
                break;

            case 'Distributor':
                $shop = DistributorShop::where('UserId', Auth::id())->first();
                $shop->shopAddress = $request->input('value');
                $shop->save();
                return 'Changes Saved';
                break;
        }
    }

    //To Show Page for upload or add mobile bank account detail
    public function saveMobileAccountSettings(Request $request)
    {
        
        $this->validate($request, [
            'mobileaccountprovider' => 'numeric|min:0|max:1|required',
            'qrcode' => 'image|mimes:jpg,png,jpeg|max:1999|required'
        ]);

        $user = User::select(['id', 'mobilebankaccountid'])->with('distributorshop:DistributorShopId,UserId,DistributorShopName,Region' ,'mobilebank')->where('id', Auth::id())->first();

        $additional_parameters = [
            $request->input('mobileaccountprovider'),
            $user->distributorshop->DistributorShopName,
            $user->distributorshop->Region
        ];

        event(new QrCodeEvent($request->file('qrcode'), $user, $additional_parameters));

        return redirect()->back()->with('success', 'Mobile Account details saved Successfully');
    }
}
