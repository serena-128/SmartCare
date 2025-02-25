<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\EmergencyAlertController;
use App\Http\Controllers\StandardTaskController;
use App\Http\Controllers\CarePlanController;
use App\Http\Controllers\DoseController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\NextOfKinController;
use App\Http\Controllers\StaffMemberController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DietaryRestrictionController;
use App\Http\Controllers\StaffTaskController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\ScheduleController;

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

// Resource Routes
Route::resource('residents', ResidentController::class);
Route::resource('emergencyalerts', EmergencyAlertController::class);
Route::resource('standardtasks', StandardTaskController::class);
Route::resource('careplans', CarePlanController::class);
Route::resource('doses', DoseController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('nextofkins', NextOfKinController::class);
Route::resource('staffmembers', StaffMemberController::class);
Route::resource('roles', RoleController::class);
Route::resource('dietaryrestrictions', DietaryRestrictionController::class);
Route::resource('stafftasks', StaffTaskController::class);
Route::resource('diagnoses', DiagnosisController::class);
Route::resource('schedules', ScheduleController::class);

// Custom Emergency Alert Route
Route::patch('/emergencyalerts/{id}/resolve', [EmergencyAlertController::class, 'markAsResolved'])->name('emergencyalerts.resolve');

// Main Page Route
Route::get('/main', function () {
    return view('main');
})->name('main');

// Role Management Routes (Fixed)
Route::get('/dashboard/roles', [RoleController::class, 'index'])->name('roles.index');
Route::post('/dashboard/roles', [RoleController::class, 'store'])->name('roles.store');
Route::delete('/dashboard/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
