<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Svg\Tag\Rect;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //check email and password
        //if given credentials exits, api_token will be returned
        if ($request->has('email') && $request->has('password'))
        {
            $user = User::where('email', $request->input('email'))->first();
            if ($user)
            {
                $user->makeVisible(['password']);
                if(Hash::check($request->input('password'), $user->password))
                {
                    //Password matched;
                    return response()->json(['key' => $user->api_token]);
                }
                else
                {
                    return response()->json(['error' => 'Invalid Password or Email', 'error_code' => 404]);
                }
            }
            else
            {
                return response()->json(['error' => 'User Doest not Exist', 'error_code' => 404]);
            }
        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
