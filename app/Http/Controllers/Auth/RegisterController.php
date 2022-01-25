<?php

namespace App\Http\Controllers\Auth;

use App\Enums\AccountStatus;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = '/register/shopregistration';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cnicnumber' => 'required|string|min:13|max:13',
            'cnicfrontpic' => 'required|image|mimes:jpeg,png,jpg,webp|max:1999',
            'cnicbackpic' => 'required|image|mimes:jpeg,png,jpg,webp|max:1999'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        //Storing Pictures
        $cnicfrontfilename = 'cnic_front_' . str_replace(" ", "_", $data['name']) . '_' . time() . '.' . $data['cnicfrontpic']->getClientOriginalExtension();
        $cnicbackfilename = 'cnic_back_' . str_replace(" ", "_", $data['name'])  . '_' . time() . '.' . $data['cnicbackpic']->getClientOriginalExtension();
        $data['cnicfrontpic']->storePubliclyAs('public/cnic/front', $cnicfrontfilename);
        $data['cnicbackpic']->storePubliclyAs('public/cnic/back', $cnicbackfilename);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'account_status' => AccountStatus::$PENDING,
            'cnic_card_no' => $data['cnicnumber'],
            'cnic_front_pic' => $cnicfrontfilename,
            'cnic_back_pic' => $cnicbackfilename,
        ]);
    }

}
