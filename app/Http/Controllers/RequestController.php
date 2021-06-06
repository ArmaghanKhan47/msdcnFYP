<?php

namespace App\Http\Controllers;

use App\Models\Request as RequestModel;
use App\Models\User;
use App\Notifications\FeedbackNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->only(['index', 'update', 'changeStatus']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //For Admin
        $feedbacks = RequestModel::with('user')->latest()->get();

        $active = $feedbacks->filter(function($item){
            if (strstr($item->status, 'Active'))
            {
                return $item;
            }
        });

        $completed = $feedbacks->filter(function($item){
            if (strstr($item->status, 'Completed'))
            {
                return $item;
            }
        });
        return view('admin.main.showfeedbacks', compact('active', 'completed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //For User
        return view('request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //For User
        $this->validate($request, [
            'title' => 'string|required|max:50',
            'discription' => 'string|required|max:300'
        ]);

        $json = json_encode([
            'title' => $request->input('title'),
            'comments' => [[$request->input('discription'), date('Y-m-d h:m'), 'user']]
        ]);

        RequestModel::create([
            'userid' => Auth::id(),
            'message' => $json,
            'status' => 'Active'
        ]);

        return redirect(route('inventory.create'))->with('success', 'Your Request has been made');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //can be used for both admin and user
        $request = RequestModel::find($id);
        return view('request.show', compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        //For User
        $this->validate($request, [
            'comment' => 'required|max:255'
        ]);

        $req = RequestModel::find($id);

        $message = json_decode($req->message);
        $decoded = $message->comments;
        array_push($decoded, [$request->input('comment'), date('Y-m-d h:m'), 'user']);
        $message->comments = $decoded;
        $req->message = json_encode($message);
        $req->save();

        return redirect()->back();
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
        //For Admin
        $this->validate($request, [
            'comment' => 'required|max:255'
        ]);

        $req = RequestModel::find($id);

        $message = json_decode($req->message);
        $decoded = $message->comments;
        array_push($decoded, [$request->input('comment'), date('Y-m-d h:m'), 'admin']);
        $message->comments = $decoded;
        $req->message = json_encode($message);
        $req->save();

        $link = route('request.show', $id);
        $mes = 'Comment added to your Request <a href=' . $link .'>Click Here</a>';
        User::find($req->userid)->notify(new FeedbackNotification($mes));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id)
    {
        //For Admin
        $req = RequestModel::find($id);
        $req->status = 'Completed';
        $req->save();

        $mes = 'Your Request with id#' . $id . ' is marked as completed';
        User::find($req->userid)->notify(new FeedbackNotification($mes));

        return redirect()->back()->with('success', 'Status Changed');
    }
}
