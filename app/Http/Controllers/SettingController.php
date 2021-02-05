<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Models\DistributorShop;
use App\Models\RetailerShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    //
    public function __invoke()
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
}
