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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
                $shop = RetailerShop::select('RetailerShopId', 'shopAddress')->where('UserId', Auth::id())->first();
                $shop->shopAddress = $request->input('value');
                $shop->save();
                return 'Changes Saved';
                break;

            case 'Distributor':
                $shop = DistributorShop::select('DistributorShopId', 'shopAddress')->where('UserId', Auth::id())->first();
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

    public function changePassword(Request $request)
    {
        //Validate and change the password
        $this->validate($request, [
            'currentpassword' => 'required|password:web',
            'newpassword1' => 'required|alpha_dash|max:10',
            'newpassword2' => 'required|alpha_dash|max:10'
        ]);

        if(strcmp($request->newpassword1, $request->newpassword2))
        {
            //When newpassword1 and newpassword2 doesnot match
            throw ValidationException::withMessages([
                'newpassword1' => 'New Password Doesnot match',
                'newpassword2' => 'Retype New Password Doesnot match'
            ]);
        }

        if(!strcmp($request->newpassword1, $request->currentpassword))
        {
            //When new password matches with current password
            throw ValidationException::withMessages([
                'newpassword1' => 'New Password must not match with the current password',
                'newpassword2' => 'New Password must not match with the current password'
            ]);
        }

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->newpassword1);
        $user->save();

        return redirect()->back()->with('success', 'Password Changed');
    }

    public function updateContactNumber(Request $request)
    {
        $this->validate($request, [
            'value' => 'string|required'
        ]);

        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $shop = RetailerShop::select('RetailerShopId', 'ContactNumber')->where('UserId', Auth::id())->first();
                break;

            case 'Distributor':
                $shop = DistributorShop::select('DistributorShopId', 'ContactNumber')->where('UserId', Auth::id())->first();
                break;
        }

        $shop->ContactNumber = $request->input('value');
        $shop->save();
        return 'Changes Saved';
    }
}
