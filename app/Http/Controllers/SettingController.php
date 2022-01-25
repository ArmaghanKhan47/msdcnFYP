<?php

namespace App\Http\Controllers;

use App\Enums\AccountStatus;
use App\Events\QrCodeEvent;
use App\Models\MobileBank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        $user = User::with(['userable', 'mobilebank'])
        ->where('id', Auth::id())->first();

        return view('partials.settings', compact('user'));
    }

    //To Regenerate API Token
    public function regenerateApiToken()
    {
        $user = User::find(Auth::id());
        $subscription_api_support = true;
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
        $user->account_status = AccountStatus::$PENDING;
        $user->save();
        return redirect()->back()->with('success', 'Your have applied again and your application is under review');
    }

    //To Update Shop Address
    public function updateShopAddress(Request $request)
    {
        $this->validate($request, [
            'value' => 'string|required'
        ]);

        $user = User::with('userable')->find(Auth::id());

        $user->userable()->update([
            'shop_address' => $request->value
        ]);
        return 'Changes Saved';
    }

    //To Show Page for upload or add mobile bank account detail
    public function saveMobileAccountSettings(Request $request)
    {
        //Distributor Only
        Gate::authorize('distributorAccessOnly');

        $this->validate($request, [
            'mobileaccountprovider' => 'numeric|min:0|max:1|required',
            'qrcode' => 'image|mimes:jpg,png,jpeg|max:1999|required'
        ]);

        $user = User::select(['id', 'mobilebankaccountid'])
        ->with(
            'distributorshop:DistributorShopId,UserId,DistributorShopName,Region',
            'mobilebank')
            ->where('id', Auth::id())->first();

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

        $user = User::with('userable')->find(Auth::id());

        $user->userable()->update([
            'contact_no' => $request->value
        ]);

        return 'Changes Saved';
    }
}
