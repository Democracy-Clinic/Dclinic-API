<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class Doctor extends Model
{
    use HasFactory;

    public function scopeGetDatatableQuery($query, $request)
    {
        return Datatables::of($query)
        // ->editColumn('title', '<a href="{{route("posts.show", $id)}}"><p class="text-success"> {{ $title }} </p>')
        ->addColumn("name", function ($query) {
            $data = '<p class="text-info">' . $query->user->name .'</p>';
            return $data;
        })
        // ->addColumn("created_at", function ($query) {
        //     $data = '<span class="badge progress-bar-success">' . $query->created_at->diffForHumans() .'</span>';
        //     return $data;
        // })
        // ->addColumn("readable_time", function ($query) {
        //     $data = '<span class="badge progress-bar-danger">' . $query->readable_time .'</span>';
        //     return $data;
        // })
        // ->addColumn("edit", function ($query) {
        //     $data = '<a href='. route("posts.edit", $query->id) .' class="btn btn-info text-info"><span class="fa fa-edit"></span></a>';
        //     return $data;
        // })
        // ->addColumn("delete", function ($query) {
        //     $data = '<form action="' . route('posts.destroy', $query->id). '" method="post">'
        //     . csrf_field() .
        //     method_field("delete") .
        //     '<button class="btn btn-danger"><span class="fa fa-trash"></span></a></button>
        // </form>';
        //     return $data;
        // })
        ->rawColumns(['name'])
        ->toJson();
    }
}
