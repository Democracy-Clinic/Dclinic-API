<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\DoctorRequest;
use App\Models\Specialization;
use App\Models\Town;
use App\Models\Doctor;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.doctors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specializations = Specialization::pluck('title_myan', 'id');
        $towns = Town::pluck('Town_Name_Eng', 'Town_Pcode');
        return view('admin.doctors.create', compact('specializations', 'towns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorRequest $request)
    {
        flash('Doctor information is added !')->success()->important();
        $doctor = Doctor::create([
            'name' => $request->name,
            'name_myan' => $request->name_myan,
            'phone' => $request->phone,
            'viber' => $request->viber,
            'facebook_url' => $request->facebook_url,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'address' => $request->address,
            'note' => $request->note,
            'fee_status' => $request->fee_status,
            'status' => $request->status,
            'specialization_id' => $request->specialization_id,
            'town_pcode' => $request->town_pcode,
        ]);

        return Redirect::route('doctors.index');
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
