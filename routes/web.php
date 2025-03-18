<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\EmergencyAlertController;
use App\Http\Controllers\StandardTaskController;

use App\Http\Controllers\DoseController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\NextOfKinController;
use App\Http\Controllers\StaffMemberController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DietaryRestrictionController;
use App\Http\Controllers\StaffTaskController;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [StaffAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [StaffAuthController::class, 'login'])->name('staff.login');
Route::post('/logout', [StaffAuthController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/staffDashboard', [DashboardController::class, 'index'])->name('staffDashboard');


});



// Resource Routes for Other Entities
Route::resource('residents', ResidentController::class);

Route::resource('standardtasks', StandardTaskController::class);

Route::resource('doses', DoseController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('nextofkins', NextOfKinController::class);
Route::resource('staffmembers', StaffMemberController::class);
Route::resource('roles', RoleController::class);
Route::resource('dietaryrestrictions', DietaryRestrictionController::class);
Route::resource('stafftasks', StaffTaskController::class);
Route::get('/staffDashboard', [DashboardController::class, 'index'])->name('staffDashboard');
Route::get('/', [DashboardController::class, 'index']);
Route::resource('emergencyalerts', EmergencyAlertController::class);



// Emergency Alert Actions
Route::patch('/emergencyalerts/{id}/resolve', [EmergencyAlertController::class, 'markAsResolved'])->name('emergencyalerts.resolve');

// Main Page
Route::get('/main', function () {
    return view('main');
})->name('main');




// Route to load the search page (only the search bar)
Route::get('/diagnoses/search', function () {
    return view('diagnoses.search');
})->name('diagnoses.searchPage');

// Route to handle search request
Route::get('/diagnoses/search/results', [DiagnosisController::class, 'search'])->name('diagnoses.search');
Route::get('/residents/{id}/profile', [ResidentController::class, 'profile'])->name('residents.profile');
// Diagnoses Routes
Route::get('/diagnoses', [DiagnosisController::class, 'index'])->name('diagnoses.index'); // View all diagnoses
Route::get('/diagnoses/create', [DiagnosisController::class, 'create'])->name('diagnoses.create'); // Show create form
Route::post('/diagnoses', [DiagnosisController::class, 'store'])->name('diagnoses.store'); // Save new diagnosis
Route::get('/diagnoses/{id}', [DiagnosisController::class, 'show'])->name('diagnoses.show'); // View specific diagnosis
Route::get('/diagnoses/{id}/edit', [DiagnosisController::class, 'edit'])->name('diagnoses.edit'); // Show edit form
Route::put('/diagnoses/{id}', [DiagnosisController::class, 'update'])->name('diagnoses.update'); // Update diagnosis
Route::delete('/diagnoses/{id}', [DiagnosisController::class, 'destroy'])->name('diagnoses.destroy'); // Delete diagnosis
Route::get('/my-schedule', [ScheduleController::class, 'mySchedule'])->name('staff.schedule');





Route::middleware(['auth'])->group(function () {
    Route::get('/staffmember/profile', function () {
        return view('staffmembers.profile');
    })->name('staff.profile');
});


Route::get('/schedule/request-day-off/{id}', [scheduleController::class, 'showRequestDayOffForm'])->name('schedule.requestDayOffForm');
Route::post('/schedule/request-day-off/{id}/submit', [ScheduleController::class, 'submitDayOffRequest'])->name('schedule.submitDayOffRequest');





// Grouping all routes under the schedules resource
Route::resource('schedules', ScheduleController::class);

Route::post('/shift-change', [ScheduleController::class, 'store'])->name('shiftChange.store');



Route::resource('careplans', App\Http\Controllers\careplanController::class);
Route::get('/careplans/{id}/edit', [CarePlanController::class, 'edit'])->name('careplans.edit');
Route::put('/careplans/{id}', [CarePlanController::class, 'update'])->name('careplans.update');

