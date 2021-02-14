<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;

class DatatableApiController extends Controller
{
    public function doctors(Request $request)
    {
        return Doctor::getDatatableQuery($request);
    }

    public function users(Request $request)
    {
        return User::getDatatableQuery($request);
    }
}
