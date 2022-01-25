<?php

namespace App\Http\Middleware;

use App\Enums\AccountStatus;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class RegistrationCheck
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
        //Fetching User Subscriptions
        if (!Auth::user()->userable){
            // Registration is not complete
            return redirect(route('shop-registration.index'));
        }

        //Check Account Status
        switch(Auth::user()->account_status)
        {
            case AccountStatus::$PENDING:
                if ($request->header('accept') == 'application/json'){
                    //responce for api calls
                    return response()->json([
                        'message' => 'Your Account Activation is Pending'
                        ]);
                }
                return redirect('/settings')->with('error', 'Your Account Activation is Pending');
                break;

            case AccountStatus::$DEACTIVE:
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
