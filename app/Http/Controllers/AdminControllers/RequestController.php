<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Mail\UserAccountMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\UserAccountNotification;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        //
        $pendings = User::where('AccountStatus', 'PENDING')
        ->with(
            [
                'retailershop.subscription:HistoryId,SubscriptionPackageId,RetailerId,TransactionId,PaymentMethod',
                'retailershop.subscription.package:PackageId,PackageName',
                'distributorshop.subscription:HistoryId,SubscriptionPackageId,DistributorId,TransactionId,PaymentMethod',
                'distributorshop.subscription.package:PackageId,PackageName'
            ])
            ->get()
            ->filter(function($item){
                switch($item->UserType)
                {
                    case 'Retailer':
                        if ($item->retailershop && $item->retailershop->subscription)
                        {
                            return $item;
                        }
                        break;

                    case 'Distributor':
                        if ($item->distributorshop && $item->distributorshop->subscription)
                        {
                            return $item;
                        }
                        break;
                }
            });
        // return $pendings;
        return view('admin.main.pendingrequest', compact('pendings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update($id)
    {
        //Admin Activating the user account
        $user = User::find($id);
        $user->AccountStatus = 'ACTIVE';
        $user->save();
        $user->notify(new UserAccountNotification('good'));
        $mail = (new UserAccountMail($user, 'Account Approved', 'Congratulation! Your account is now ACTIVE.<br>We are glad to have you aboad'))
        ->onQueue('email');
        Mail::later(now()->addSeconds(5), $mail);
        return redirect()->back()->with('success', 'User#' . $id . ' is ACTIVE');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Admin Deactivating the user account
        $user = User::find($id);
        $user->AccountStatus = 'DEACTIVE';
        $user->save();
        $user->notify(new UserAccountNotification('bad'));
        $mail = (
            new UserAccountMail(
                $user,
                'Account Disapproved',
                'We regret to inform you that, your account is not approved<br>For any query contact us'
            )
        )
        ->onQueue('email');
        Mail::later(now()->addSeconds(5), $mail);
        return redirect()->back()->with('error', 'User#' . $id . ' is DEACTIVE');
    }
}
