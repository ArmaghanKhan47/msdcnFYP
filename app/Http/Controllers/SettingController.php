<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Models\DistributorShop;
use App\Models\RetailerShop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    //
    public function index()
    {
        //Fetch User Data
        $user = Auth::user();
        //Fetch Shop Data
        switch($user->UserType)
        {
            case 'Retailer':
                $shop = RetailerShop::where('UserId', '=', $user->id)->first();
                break;
            case 'Distributor':
                $shop = DistributorShop::where('UserId', '=', $user->id)->first();
                break;
        }
        //Fetch Credit Card Data
        $card = CreditCard::find($user->CreditCardId);

        return view('testingViews.settings', compact('user', 'shop', 'card'));
    }

    public function regenerateApiToken()
    {
        $user = User::find(Auth::id());
        $user->api_token = Str::random(60);
        $user->save();
        return redirect()->back()->with('success', 'New API Token is Generated');
    }

    public function reapply()
    {
        $user = User::find(Auth::id());
        $user->AccountStatus = 'PENDING';
        $user->save();
        return redirect()->back()->with('success', 'Your have applied again and your application is under review');
    }
}
