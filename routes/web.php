<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::group(['middleware' => ['auth','isAdmin'],'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
    Route::delete('permissions_mass_destroy', [\App\Http\Controllers\Admin\PermissionController::class, 'massDestroy'])->name('permissions.mass_destroy');
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::delete('roles_mass_destroy', [\App\Http\Controllers\Admin\RoleController::class, 'massDestroy'])->name('roles.mass_destroy');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::delete('users_mass_destroy', [\App\Http\Controllers\Admin\UserController::class, 'massDestroy'])->name('users.mass_destroy');

    // services
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::delete('services_mass_destroy', [\App\Http\Controllers\Admin\ServiceController::class, 'massDestroy'])->name('services.mass_destroy');

    // client
    Route::resource('tattoos', \App\Http\Controllers\Admin\TattooController::class);
    Route::delete('tattoos_mass_destroy', [\App\Http\Controllers\Admin\TattooController::class, 'massDestroy'])->name('tattoos.mass_destroy');
    Route::post('tattoos/media', [\App\Http\Controllers\Admin\TattooController::class, 'storeMedia'])->name('tattoos.storeMedia');

    // //piercing services
    Route::resource('services_piercings', \App\Http\Controllers\Admin\ServicesPiercingController::class);
    Route::delete('services_piercing_mass_destroy', [\App\Http\Controllers\Admin\ServicesPiercingController::class, 'massDestroy'])->name('services_piercing.mass_destroy');

    //  //piercing body part
     Route::resource('bodypart_piercings', \App\Http\Controllers\Admin\PiercingBodyPartController::class);
     Route::delete('piercings_mass_destroy', [\App\Http\Controllers\Admin\PiercingBodyPartController::class, 'massDestroy'])->name('piercings.mass_destroy');
     Route::post('tattoos/media', [\App\Http\Controllers\Admin\PiercingBodyPartController::class, 'storeMedia'])->name('tattoos.storeMedia');

    // appointment
    Route::resource('appointments', \App\Http\Controllers\Admin\AppointmentController::class);
    Route::delete('appointments_mass_destroy', [\App\Http\Controllers\Admin\AppointmentController::class, 'massDestroy'])->name('appointments.mass_destroy');

    // piercing appointment
    Route::resource('piercing_appointments', \App\Http\Controllers\Admin\PiercingAppointmentController::class);
    Route::delete('piercing_appointments_mass_destroy', [\App\Http\Controllers\Admin\PiercingAppointmentController::class, 'massDestroy'])->name('piercing_appointments.mass_destroy');

    Route::get('calendar', [\App\Http\Controllers\Admin\CalendarController::class, 'index'])->name('calendar');
});

Auth::routes(['register' => false]);

