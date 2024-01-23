<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExhibitorController;
use App\Http\Controllers\UserAuth;

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
    return view('welcome');
});

Route::get('logout',[UserAuth::class,'logout'])->name('logout');

Route::middleware(['guest'])->group(function () {

    Route::post('register',[UserAuth::class,'register'])->name('register');
    Route::get('login',[UserAuth::class,'login'])->name('login');
    Route::post('validate_login',[UserAuth::class,'validate_login'])->name('validate_login');
    Route::post('validate_registration',[UserAuth::class,'validate_registration'])->name('validate_registration');
});
Route::middleware(['auth'])->group(function () {

    Route::get('index', [ExhibitorController::class, 'index'])->name('index');

    // Functions of Exhibitor
    Route::get('exhibitor-registration',[ExhibitorController::class,'exhibitor_registration'])->name('exhibitor_registration');
    Route::post('validate_exhibitor',[ExhibitorController::class,'validate_exhibitor'])->name('validate_exhibitor');
    Route::get('exhibitor-table',[ExhibitorController::class,'exhibitor_table'])->name('exhibitor_table');
    Route::get('exportExhibitorCsv',[ExhibitorController::class,'exportExhibitorCsv'])->name('exportExhibitorCsv');

    // Functions of Membership
    Route::get('assign-membership',[ExhibitorController::class,'assign_membership'])->name('assign_membership');
    Route::post('validate_membership',[ExhibitorController::class,'validate_membership'])->name('validate_membership');
    Route::get('membership-table',[ExhibitorController::class,'membership_table'])->name('membership_table');
    Route::get('exportMembershipCsv',[ExhibitorController::class,'exportMembershipCsv'])->name('exportMembershipCsv');

    // Functions of Attendee
    Route::get('attendee-registration',[ExhibitorController::class,'attendee_registration'])->name('attendee_registration');
    Route::post('validate_attendee',[ExhibitorController::class,'validate_attendee'])->name('validate_attendee');
    Route::get('attendee-table',[ExhibitorController::class,'attendee_table'])->name('attendee_table');
    Route::get('exportAttendeeCsv',[ExhibitorController::class,'exportAttendeeCsv'])->name('exportAttendeeCsv');

});

Route::get('dashboard',[ExhibitorController::class,'dashboard']);



