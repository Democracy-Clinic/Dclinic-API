<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use App\Models\Accounts;
use App\Models\Schedule;
use App\Models\Specialization;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function accounts()
    {
        return $this->morphMany(Account::class, 'accountable');
    }

    public function schedules()
    {
        return $this->morphMany(Schedule::class, 'schedulable');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function scopeGetDatatableQuery($query, $request)
    {
        return Datatables::of($query)
        // ->editColumn('title', '<a href="{{route("posts.show", $id)}}"><p class="text-success"> {{ $title }} </p>')
        ->addColumn("name", function ($query) {
            return $query->name;
        })
        ->addColumn("created_at", function ($query) {
            $data = '<span class="badge progress-bar-success">' . $query->created_at->diffForHumans() .'</span>';
            return $data;
        })
        // ->addColumn("readable_time", function ($query) {
        //     $data = '<span class="badge progress-bar-danger">' . $query->readable_time .'</span>';
        //     return $data;
        // })
        ->addColumn("edit", function ($query) {
            $data = '<a href='. route("doctors.edit", $query->id) .' class="btn btn-info text-info"><span class="fa fa-edit"></span></a>';
            return $data;
        })
        ->addColumn("show", function ($query) {
            $data = '<a href='. route("doctors.show", $query->id) .' class="btn btn-success text-info"><span class="fa fa-user"></span></a>';
            return $data;
        })
        // ->addColumn("delete", function ($query) {
        //     $data = '<form action="' . route('posts.destroy', $query->id). '" method="post">'
        //     . csrf_field() .
        //     method_field("delete") .
        //     '<button class="btn btn-danger"><span class="fa fa-trash"></span></a></button>
        // </form>';
        //     return $data;
        // })
        ->rawColumns(['name', 'created_at', 'edit', 'show'])
        ->toJson();
    }
}
