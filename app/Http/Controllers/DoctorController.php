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
        $fee_status = [
            "FREE_OF_CHARGE" => "FOC", 
            "CHARGE" => "အခပေး",
            "PARTIAL_CHARGE" => "စရိတ်မျှပေး"
        ];
        return view('admin.doctors.create', compact('specializations', 'towns', 'fee_status'));
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
    public function show(Doctor $doctor)
    {
        // combine creating
        // schedule and account
        // refactor later
        $days = [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
        ];
        $fee_status = [
            "FREE_OF_CHARGE" => "FOC", 
            "CHARGE" => "အခပေး",
            "PARTIAL_CHARGE" => "စရိတ်မျှပေး"
        ];
        $channels = ['BANK', 'AGENT', 'OTHER'];
        return view('admin.doctors.show', compact('doctor', 'fee_status', 'days', 'channels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $specializations = Specialization::pluck('title_myan', 'id');
        $towns = Town::pluck('Town_Name_Eng', 'Town_Pcode');
        $fee_status = [
            "FREE_OF_CHARGE" => "FOC", 
            "CHARGE" => "အခပေး",
            "PARTIAL_CHARGE" => "စရိတ်မျှပေး"
        ];
        return view('admin.doctors.edit', compact('specializations', 'towns', 'doctor', 'fee_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        flash('Doctor information is edited !')->info()->important();
        $doctor->update([
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
