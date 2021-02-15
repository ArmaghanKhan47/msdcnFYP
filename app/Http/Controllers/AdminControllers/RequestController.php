<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\UserAccountNotification;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pendings = User::where('AccountStatus', 'Pending')->get();
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
        return redirect()->back()->with('error', 'User#' . $id . ' is DEACTIVE');
    }
}
