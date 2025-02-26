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
use App\Http\Controllers\ShiftController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Welcome Page
Route::get('/', function () { 
    return view('welcome'); 
});

// Dashboard (Requires Authentication)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Authentication Routes (Breeze or Fortify)
require __DIR__.'/auth.php';

// Resource Routes for Admin Entities (Requires Authentication)
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('residents', ResidentController::class);
    Route::resource('emergencyalerts', EmergencyAlertController::class);
    Route::resource('standardtasks', StandardTaskController::class);
    Route::resource('doses', DoseController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('nextofkins', NextOfKinController::class);
    Route::resource('staffmembers', StaffMemberController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('dietaryrestrictions', DietaryRestrictionController::class);
    Route::resource('stafftasks', StaffTaskController::class);
    Route::resource('diagnoses', DiagnosisController::class);
    Route::resource('schedules', ScheduleController::class);
});

// Emergency Alert Custom Route
Route::patch('/emergencyalerts/{id}/resolve', [EmergencyAlertController::class, 'markAsResolved'])
    ->name('emergencyalerts.resolve');

// Main Page
Route::get('/main', function () {
    return view('main');
})->name('main');

// Shift Routes (No Authentication Required)
Route::prefix('shifts')->group(function () {
    Route::get('/', [ShiftController::class, 'index'])->name('shifts.index');
    Route::get('/create', [ShiftController::class, 'create'])->name('shifts.create');
    Route::post('/', [ShiftController::class, 'store'])->name('shifts.store');
    Route::get('/{id}/edit', [ShiftController::class, 'edit'])->name('shifts.edit');
    Route::put('/{id}', [ShiftController::class, 'update'])->name('shifts.update');
    Route::get('/{id}/approve', [ShiftController::class, 'approve'])->name('shifts.approve');
});

// ✅ Make Care Plan Routes Public (No Authentication Required)
Route::resource('careplans', CarePlanController::class);