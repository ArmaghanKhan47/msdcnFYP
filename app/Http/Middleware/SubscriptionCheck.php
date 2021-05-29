<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class SubscriptionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $subscriptions = null;
        try
        {
            switch(Auth::user()->UserType)
            {
                case 'Retailer':
                    $subscriptions = User::with(['retailershop.subscriptions' => function($query){
                        $query->orderBy('startDate', 'desc');
                    }, 'retailershop.subscriptions.package'])->find(Auth::id())->retailershop->subscriptions;
                    break;

                case 'Distributor':
                    $subscriptions = User::with(['distributorshop.subscriptions' => function($query){
                        $query->orderBy('startDate', 'desc');
                    }, 'distributorshop.subscriptions.package'])->find(Auth::id())->distributorshop->subscriptions;
                    break;
            }
        }
        catch(Exception $e)
        {
            return $next($request);
        }

        if($subscriptions  && $subscriptions->count() != 0)
                {
                    $last_sub = $subscriptions[0];
                    $interval = date_diff(date_create(date('Y-m-d', strtotime('today'))), date_create($last_sub->endDate));
                    $intervel = $interval->invert ? -$interval->days : $interval->days;
                    if($intervel < 3)
                    {
                        if ($intervel < 1)
                        {
                            if ($request->header('accept') == 'application/json')
                            {
                                //responce for api calls
                                return response()->json([
                                    'message' => 'Your Subscription has ended'
                                ]);
                            }
                            return redirect(route('subscription.index'))->with('error', 'Your Subscription has ended.');
                        }
                        if ($request->header('accept') == 'application/json')
                            {
                                //responce for api calls
                                return response()->json([
                                    'message' => 'Your Subscription will end in ' . (string)$interval->days . ' days'
                                ]);
                            }
                        session()->now('error', 'Your Subscription will end in ' . (string)$interval->days . ' days');
                    }
                }
                else
                {
                    if ($request->header('accept') == 'application/json')
                    {
                        //responce for api calls
                        return response()->json([
                            'message' => 'Please Subscribe'
                            ]);
                    }
                    return redirect(route('subscription.index'))->with('error', 'Please Subscribe');
                }

        //Check Account Status
        switch(User::find(Auth::id())->AccountStatus)
        {
            case 'PENDING':
                if ($request->header('accept') == 'application/json')
                {
                    //responce for api calls
                    return response()->json([
                        'message' => 'Your Account Activation is Pending'
                        ]);
                }
                return redirect('/settings')->with('error', 'Your Account Activation is Pending');
                break;

            case 'DEACTIVE':
                if ($request->header('accept') == 'application/json')
                {
                    //responce for api calls
                    return response()->json([
                        'message' => 'Your Account is Deactive'
                        ]);
                }
                return redirect('/settings')->with('error', 'Your Account is Deactive');
                break;
        }
        return $next($request);
    }
}
