<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //load all notifications of user
        $notifications = User::find(Auth::id())->unreadNotifications;
        $readNotifications = User::find(Auth::id())->notifications;
        session(['notificationscount' => $notifications->count()]);
        // return $notifications;
        return view('notification.notification', compact('notifications', 'readNotifications'));
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
    public function update(Request $request,$id)
    {
        //Marking Notification to ReadAs
        User::find(Auth::id())->notifications()->where('id', $id)->get()->markAsRead();
        $notifications = User::find(Auth::id())->unreadNotifications->count();
        session(['notificationscount' => $notifications]);
        return redirect()->back()->with('success', 'Notification Marked as Read');
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
        User::find(Auth::id())->notifications()->where('id', $id)->delete();
        $notifications = User::find(Auth::id())->unreadNotifications->count();
        session(['notificationscount' => $notifications]);
        return redirect()->back()->with('success', 'Notification Deleted');
    }
}
