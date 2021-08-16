<?php

namespace App\Http\Controllers;

use App\Mail\MedicineMail;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\User;
use App\Notifications\MedicineNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MedicineController extends Controller
{
    private $medtypes;

    public function __construct()
    {
        //Appling default middleware to only Show
        $this->middleware('auth')->only('show');
        //Appling Admin Auth to function except Show
        $this->middleware('auth:admin')->except('show');

        $this->medtypes = ['Vial', 'Tablets', 'Syrup', 'Drips', 'Cream', 'Gel', 'Elixir'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $medicines = Medicine::get();
        return view('admin.main.allmedicines', compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //For Admin
        return view('admin.main.addmedicine');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //for admin
        $this->validate($request, [
            'medname' => 'string|required',
            'medcompany' => 'string|required',
            'medtype' => 'numeric|required',
            'medformula' => 'string|required',
            'meddiscription' => 'string|required',
            'coverimg' => 'image|required|max:1999|mimes:jpeg,jpg,png'
        ]);

        $filename = str_replace(" ", "", $request->input('medname')) . '_' . str_replace(" ", "_", $request->input('medcompany')) . '_' . $request->input('medtype'). '_' . time() . '.' . $request->file('coverimg')->getClientOriginalExtension();
        $request->file('coverimg')->storeAs('public/medicines', $filename);

        $id = Medicine::create([
            'MedicineName' => $request->input('medname'),
            'MedicineCompany' => $request->input('medcompany'),
            'MedicineDiscription' => $request->input('meddiscription'),
            'MedicineType' => $this->medtypes[$request->input('medtype')],
            'MedicinePic' => $filename,
            'MedicineFormula' => json_encode(explode(',', $request->input('medformula')))
        ])->MedicineId;

        $users = User::all();
        $message = 'New Medicine is added(' . $request->input('medname') . ' by ' . $request->input('medcompany') . ')';
        Notification::send($users, new MedicineNotification($message));

        foreach($users as $user){
            $mail = (
                new MedicineMail(
                    $user,
                    'New Medicine Added',
                    $message
                )
            )
            ->onQueue('email');
            Mail::later(now()->addSeconds(5), $mail);
        }

        return redirect()->back()->with('success', 'Medicine created with id '. $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $distributorid)
    {
        ////$id = Medicine Id
        $data = Medicine::with([
            'inventorydistributor' => function($query) use ($distributorid)
            {
                $query->where('DistributorShopId', $distributorid);
            },
            'inventorydistributor.distributor:DistributorShopId,DistributorShopName'
        ])->find($id);
        return view('testingViews.medicinedetail')->with('data', $data);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //for admin
        $medicine = Medicine::find($id);
        return view('admin.main.editmedicine', compact('medicine'));
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
        //for admin
        $this->validate($request, [
            'medname' => 'string|required',
            'medcompany' => 'string|required',
            'medtype' => 'numeric|required',
            'medformula' => 'string|required',
            'meddiscription' => 'string|required',
            'coverimg' => 'image|max:1999|mimes:jpeg,jpg,png'
        ]);

        $medicine = Medicine::find($id);

        if($request->hasFile('coverimg'))
        {
            $filename = str_replace(" ", "_", $request->input('medname')) . '_' . str_replace(" ", "_", $request->input('medcompany')) . '_' . $request->input('medtype'). '_' . time() . '.' . $request->file('coverimg')->getClientOriginalExtension();
            $request->file('coverimg')->storeAs('public/medicines', $filename);
            Storage::delete('public/medicines/'.$medicine->MedicinePic);
            $medicine->MedicinePic = $filename;
        }

        $medicine->MedicineName = $request->input('medname');
        $medicine->MedicineCompany = $request->input('medcompany');
        $medicine->MedicineType = $this->medtypes[$request->input('medtype')];
        $medicine->MedicineDiscription = $request->input('meddiscription');
        $medicine->MedicineFormula = json_encode(explode(',', $request->input('medformula')));
        $medicine->save();

        $users = User::all();
        $message = $request->input('medname') . ' by ' . $request->input('medcompany') . ' details has been updated';
        Notification::send($users, new MedicineNotification($message));

        foreach($users as $user){
            $mail = (
                new MedicineMail(
                    $user,
                    'Medicine Updated',
                    $message
                )
            )
            ->onQueue('email');
            Mail::later(now()->addSeconds(5), $mail);
        }

        return redirect(route('admin.medicine.index'))->with('success', 'Medicine#' . $id . ' changes saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //foradmin
        Medicine::destroy($id);
        return redirect(route('admin.medicine.index'))->with('success', 'Medicine#' . $id . ' is deleted');
    }
}
