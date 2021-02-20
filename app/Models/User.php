<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Yajra\Datatables\Datatables;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeGetDatatableQuery($query, $request)
    {
        return Datatables::of($query)
        // ->editColumn('title', '<a href="{{route("posts.show", $id)}}"><p class="text-success"> {{ $title }} </p>')
        ->addColumn("name", function ($query) {
            return $query->name;
        })
        ->addColumn("email", function ($query) {
            $data = '<p class="text-danger">' . $query->email .'</p>';
            return $data;
        })
        ->addColumn("roles", function ($query) {
            // later add roles
            $data = '<span class="badge progress-bar-info"> admin </span>';
            return $data;
        })
        ->addColumn("created_at", function ($query) {
            $data = '<span class="badge progress-bar-success">' . $query->created_at->diffForHumans() .'</span>';
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
        ->rawColumns(['name', 'email', 'roles', 'created_at'])
        ->toJson();
    }
}
