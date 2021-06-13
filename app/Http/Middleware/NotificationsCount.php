<?php

namespace App\Http\Middleware;

use App\Models\Request as ModelsRequest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NotificationsCount
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
        if (Auth::guard('web')->check())
        {
            //For normal users
            $notifications = User::find(Auth::id())->unreadNotifications->count();
            session(['notificationscount' => $notifications]);
        }
        elseif (Auth::guard('admin')->check())
        {
            //For admin users
            $pendings = User::where('AccountStatus', 'Pending')->with(['retailershop', 'distributorshop'])->get()->filter(function($item){
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
            })->count();
            session(['pendingcount' => $pendings]);

            $feedback = ModelsRequest::where('status', 'ACTIVE')->get()->count();
            session(['feedbackcount' => $feedback]);
        }

        return $next($request);
    }
}
