<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatatableApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin-layouts.admin');
    })->name('dashboard');

    Route::prefix('users')->group(function () {
        Route::get('/', function() {
            return view('admin.users.index');
        })
        ->name('users.index');
    });

    // internel call
    Route::prefix('api')->group(function () {
        Route::get('/doctors/datatable', [DatatableApiController::class, 'doctors'])
        ->name('api.doctors.datatable');
        Route::get('/users/datatable', [DatatableApiController::class, 'users'])
        ->name('api.users.datatable');
    });
});

require __DIR__ . '/auth.php';
