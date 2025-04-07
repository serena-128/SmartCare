<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\DiagnosisController;
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
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\NextOfKinLoginController;
use App\Http\Controllers\Auth\NextOfKinForgotPasswordController;
use App\Http\Controllers\Auth\NextOfKinRegisterController;
use App\Http\Controllers\NextOfKinSettingsController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NextOfKinProfileController;
use App\Http\Controllers\EventAppointmentController;
use App\Http\Controllers\NextOfKinDashboardController;
use App\Http\Controllers\StaffScheduleController;
use App\Http\Controllers\CareLogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Welcome page
Route::get('/', [DashboardController::class, 'index']);

// ✅ Authentication Routes
Route::get('/login', [StaffAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [StaffAuthController::class, 'login'])->name('staff.login');
Route::post('/logout', [StaffAuthController::class, 'logout'])->name('logout');

// ✅ Staff Dashboard (only for authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/staffDashboard', [DashboardController::class, 'index'])->name('staffDashboard');
});

// ✅ Resource Routes for Entities
Route::resource('residents', ResidentController::class);
Route::resource('standardtasks', StandardTaskController::class);
Route::resource('doses', DoseController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('nextofkins', NextOfKinController::class);
Route::resource('staffmembers', StaffMemberController::class);
Route::resource('roles', RoleController::class);
Route::resource('dietaryrestrictions', DietaryRestrictionController::class);
Route::resource('stafftasks', StaffTaskController::class);
Route::resource('emergencyalerts', EmergencyAlertController::class);

// ✅ Emergency Alert Actions
Route::patch('/emergencyalerts/{id}/resolve', [EmergencyAlertController::class, 'markAsResolved'])->name('emergencyalerts.resolve');

// ✅ Care Log Routes (🟢 Anyone Can Access, No `auth` Middleware)
Route::get('/care_logs/create/{resident_id}', [CareLogController::class, 'create'])->name('care_logs.create');
Route::post('/care_logs/store/{resident_id}', [CareLogController::class, 'store'])->name('care_logs.store');

// ✅ Diagnoses Routes
Route::get('/diagnoses', [DiagnosisController::class, 'index'])->name('diagnoses.index');
Route::get('/diagnoses/create', [DiagnosisController::class, 'create'])->name('diagnoses.create');
Route::post('/diagnoses', [DiagnosisController::class, 'store'])->name('diagnoses.store');
Route::get('/diagnoses/{id}', [DiagnosisController::class, 'show'])->name('diagnoses.show');
Route::get('/diagnoses/{id}/edit', [DiagnosisController::class, 'edit'])->name('diagnoses.edit');
Route::put('/diagnoses/{id}', [DiagnosisController::class, 'update'])->name('diagnoses.update');
Route::delete('/diagnoses/{id}', [DiagnosisController::class, 'destroy'])->name('diagnoses.destroy');

// ✅ Staff Member Profile (protected by `auth`)
Route::middleware(['auth'])->group(function () {
    Route::get('/staffmember/profile', function () {
        return view('staffmembers.profile');
    })->name('staff.profile');
});

// ✅ Schedule Routes
Route::resource('schedules', ScheduleController::class);
Route::get('/schedule/request-day-off/{id}', [ScheduleController::class, 'showRequestDayOffForm'])->name('schedule.requestDayOffForm');
Route::post('/schedule/request-day-off/{id}/submit', [ScheduleController::class, 'submitDayOffRequest'])->name('schedule.submitDayOffRequest');
Route::post('/shift-change', [ScheduleController::class, 'store'])->name('shiftChange.store');

// ✅ Care Plan Routes
Route::resource('careplans', CarePlanController::class);
Route::get('/careplans/{id}/edit', [CarePlanController::class, 'edit'])->name('careplans.edit');
Route::put('/careplans/{id}', [CarePlanController::class, 'update'])->name('careplans.update');

// ✅ Next of Kin Routes
Route::prefix('nextofkin')->group(function () {
    Route::get('register', [NextOfKinRegisterController::class, 'showRegistrationForm'])->name('nextofkin.register');
    Route::post('register', [NextOfKinRegisterController::class, 'register'])->name('nextofkin.register.submit');
    Route::get('forgot', [NextOfKinForgotPasswordController::class, 'showLinkRequestForm'])->name('nextofkin.forgot');
    Route::get('login', [NextOfKinLoginController::class, 'showLoginForm'])->name('nextofkin.login');
    Route::post('login', [NextOfKinLoginController::class, 'login'])->name('nextofkin.login.submit');
    Route::post('logout', [NextOfKinLoginController::class, 'logout'])->name('nextofkin.logout');
});

// ✅ Staff Schedule Route (🟢 This Fixes the "Route Not Found" Error)
Route::get('/my-schedule', [ScheduleController::class, 'mySchedule'])->name('staff.schedule');

// ✅ Events & Appointments
Route::get('/add-event', [EventController::class, 'create'])->name('events.create');
Route::post('/add-event', [EventController::class, 'store'])->name('events.store');
Route::get('/fetch-events', [EventController::class, 'fetchEvents']);

// ✅ Profile Picture Update
Route::get('/profile', [NextOfKinDashboardController::class, 'profile'])->name('nextofkin.profile')->middleware('auth:nextofkin');
Route::post('/profile/update', [NextOfKinDashboardController::class, 'updateProfile'])->name('nextofkin.profile.update');

// ✅ Fetching Appointments
Route::get('/fetch-appointments', [AppointmentController::class, 'fetchAppointments'])->name('appointments.fetch');

// ✅ Staff Calendar
Route::get('/staff/calendar', function () {
    return view('staff.calendar');
})->name('staff.calendar');
Route::get('/staff/appointments/json', [AppointmentController::class, 'fetchStaffAppointments'])->name('appointments.json');

// ✅ Staff Birthdays
Route::get('/staff/birthdays', function () {
    return view('staff.birthdays');
});

// ✅ Fix the missing "diagnoses.searchPage" route
Route::get('/diagnoses/search', function () {
    return view('diagnoses.search'); // Ensure this view exists: resources/views/diagnoses/search.blade.php
})->name('diagnoses.searchPage');


use App\Http\Controllers\ResidentCareDashboardController;

Route::get('/resident-care-dashboard', [ResidentCareDashboardController::class, 'index'])
    ->name('resident_care_dashboard');

