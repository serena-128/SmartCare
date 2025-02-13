<?php

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
    return view('welcome');
});


Route::resource('residents', App\Http\Controllers\residentController::class);


Route::resource('emergencyalerts', App\Http\Controllers\emergencyalertController::class);


Route::resource('standardtasks', App\Http\Controllers\standardtaskController::class);


Route::resource('careplans', App\Http\Controllers\careplanController::class);


Route::resource('doses', App\Http\Controllers\doseController::class);


Route::resource('appointments', App\Http\Controllers\appointmentController::class);


Route::resource('nextofkins', App\Http\Controllers\nextofkinController::class);


Route::resource('staffmembers', App\Http\Controllers\staffmemberController::class);


Route::resource('roles', App\Http\Controllers\roleController::class);


Route::resource('dietaryrestrictions', App\Http\Controllers\dietaryrestrictionController::class);


Route::resource('stafftasks', App\Http\Controllers\stafftaskController::class);

Route::patch('/emergencyalerts/{id}/resolve', [EmergencyAlertController::class, 'markAsResolved'])->name('emergencyalerts.resolve');

Route::get('/main', function () {
    return view('main');
})->name('main');
>>>>>>> efdb38d5da495b7d094d9a7bc3b71e13f8fa490c
