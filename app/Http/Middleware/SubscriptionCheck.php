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
                    //Formulate Ending Date
                    $end_date = date('Y-m-d', strtotime($last_sub->startDate . "+".(string)$last_sub->package->PackageDuration." months"));
                    $interval = date_diff(date_create($end_date), date_create(date('Y-m-d', strtotime('today'))));
                    if($interval->days < 3)
                    {
                        if ($interval->days < 1)
                        {
                            return redirect(route('subscription.index'))->with('error', 'Your Subscription has ended.');
                        }
                        session()->now('error', 'Your Subscription will end in ' . (string)$interval->days . ' days');
                    }
                }
                else
                {
                    return redirect(route('subscription.index'))->with('error', 'Please Subscribe');
                }

        //Check Account Status
        switch(User::find(Auth::id())->AccountStatus)
        {
            case 'PENDING':
                return redirect('/settings')->with('error', 'Your Account Activation is Pending');
                break;

            case 'DEACTIVE':
                return redirect('/settings')->with('error', 'Your Account is Deactive');
                break;
        }
        return $next($request);
    }
}
