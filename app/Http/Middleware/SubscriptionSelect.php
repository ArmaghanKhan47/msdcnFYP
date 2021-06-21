<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class SubscriptionSelect
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
                    $subscriptions = User::with([
                        'retailershop.subscriptions' => function($query){
                            $query->latest();
                    },
                    'retailershop.subscriptions.package'])
                    ->find(Auth::id())->retailershop->subscriptions;
                    break;

                case 'Distributor':
                    $subscriptions = User::with([
                        'distributorshop.subscriptions' => function($query){
                            $query->latest();
                    },
                    'distributorshop.subscriptions.package'])
                    ->find(Auth::id())->distributorshop->subscriptions;
                    break;
            }
        }
        catch(Exception $e)
        {}

        if($subscriptions && $subscriptions->count() != 0)
                {
                    $last_sub = $subscriptions[0];
                    //Formulate Ending Date
                    $interval = date_diff(date_create(date('Y-m-d', strtotime('today'))), date_create($last_sub->endDate));
                    $intervel = $interval->invert ? -$interval->days : $interval->days;
                    if($intervel > 0)
                    {
                        return redirect()->back()->with('success', 'Your Subscription is valid for ' . $interval->days . ' days');
                    }
                }
            // elseif($subscriptions->count() == 0)
            // {
            //     return redirect(route('subscription.index'));
            // }
        return $next($request);
    }
}
