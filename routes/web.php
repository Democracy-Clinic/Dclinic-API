<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatatableApiController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorApiController;
use App\Http\Controllers\TownApiController;
use App\Http\Controllers\SpecializationApiController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AccountController;

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


    Route::get('/users', function() {
        return view('admin.users.index');
    })
    ->name('users.index');

    Route::prefix('/dashboard')->group(function () {
        Route::get('/', function () {
            return view('admin-layouts.admin');
        })->name('dashboard');

        Route::resource('doctors', DoctorController::class);
        Route::resource('clinics', ClinicController::class);
        Route::resource('ambulances', AmbulanceController::class);
        Route::resource('schedules', ScheduleController::class);
        Route::resource('accounts', AccountController::class);
    });



    // internel call
    Route::prefix('api')->group(function () {
        Route::get('/doctors/datatable', [DatatableApiController::class, 'doctors'])
        ->name('api.doctors.datatable');
        Route::get('/users/datatable', [DatatableApiController::class, 'users'])
        ->name('api.users.datatable');
    });
});

Route::prefix('api/v1')->name('api.v1.')->group(function () {
    Route::resource('doctors', DoctorApiController::class);
    Route::resource('specializations', SpecializationApiController::class);
    Route::resource('towns', TownApiController::class);
    // Route::resource('doctors.specializations', DoctorSpecializationApiController::class);
});

require __DIR__ . '/auth.php';
