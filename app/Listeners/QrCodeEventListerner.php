<?php

namespace App\Listeners;

use App\Events\QrCodeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\MobileBank;
use Illuminate\Support\Facades\Storage;

class QrCodeEventListerner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QrCodeEvent  $event
     * @return void
     */
    public function handle(QrCodeEvent $event)
    {
        //
        $mobilebankprovider = [
            'EasyPaisa',
            'JassCash'
        ];

        $qrcode = $event->qrcode;
        $user = $event->user;
        $additional_parameter = $event->additional_parameter;
        /*
            [
                0 => mobileproviderindex,
                1 => shopname
                2 => region
            ]
        */

        $qrcodefilename = 'qrcode_pic_' . $mobilebankprovider[$additional_parameter[0]] . '_' . str_replace(" ", "_", $additional_parameter[1]) . '_' . $user->UserType . "_" . $additional_parameter[2] . "_" . time() . '.' . $qrcode->getClientOriginalExtension();
        $qrcode->storePubliclyAs('public/mobilebank/qrcode', $qrcodefilename);

        if($user->mobilebank)
        {
            //Means Record Exist, So update Existing Record
            Storage::delete($user->mobilebank->qr_code);
            $user->mobilebank->qr_code = $qrcodefilename;
            $user->mobilebank->acount_provider = $mobilebankprovider[$additional_parameter[0]];
            $user->mobilebank->save();
        }
        else
        {
            $qrcodeid = MobileBank::create([
                'acount_provider' => $mobilebankprovider[$additional_parameter[0]],
                'qr_code' => $qrcodefilename
            ])->id;

            $user->mobilebankaccountid = $qrcodeid;
            $user->save();
        }
    }
}
