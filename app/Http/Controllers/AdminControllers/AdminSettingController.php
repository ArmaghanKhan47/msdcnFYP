<?php

namespace App\Http\Controllers\AdminControllers;

use App\Events\QrCodeEvent;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdminSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = AdminUser::find(Auth::id());
        return view('admin.main.settings', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        //Validate and change the password
        $this->validate($request, [
            'currentpassword' => 'required|password:admin',
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


        $user = AdminUser::find(Auth::id());
        $user->password = Hash::make($request->newpassword1);
        $user->save();

        return redirect()->back()->with('success', 'Password Changed');
    }

    //To Show Page for upload or add mobile bank account detail
    public function saveMobileAccountSettings(Request $request)
    {
        $mobilebankprovider = [
            'EasyPaisa',
            'JassCash'
        ];

        $this->validate($request, [
            'mobileaccountprovider' => 'numeric|min:0|max:1|required',
            'qrcode' => 'image|mimes:jpg,png,jpeg|max:1999|required'
        ]);

        $user = AdminUser::find(Auth::id());

        $additional_parameters = [
            'Admin',
            'MSDCN Official Payment',
            'National'
        ];

        $qrcodefilename = 'qrcode_pic_' . $mobilebankprovider[$request->input('mobileaccountprovider')] . '_' . str_replace(" ", "_", $additional_parameters[1]) . '_' . $additional_parameters[0] . "_" . $additional_parameters[2] . "_" . time() . '.' . $request->qrcode->getClientOriginalExtension();
        $request->qrcode->storePubliclyAs('public/admin/mobilebank/qrcode', $qrcodefilename);

        Storage::delete('public/admin/mobilebank/qrcode/' . $user->qr_code);
        $user->account_provider = $mobilebankprovider[$request->input('mobileaccountprovider')];
        $user->qr_code = $qrcodefilename;
        $user->save();

        return redirect()->back()->with('success', 'Mobile Account details saved Successfully');
    }
}
