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
use App\Http\Controllers\Auth\NextOfKinLoginController;
use App\Http\Controllers\Auth\NextOfKinForgotPasswordController;

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

// Staff Authentication Routes
Route::get('/login', [StaffAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [StaffAuthController::class, 'login'])->name('staff.login');
Route::post('/logout', [StaffAuthController::class, 'logout'])->name('logout');

// Protected Routes (Only Logged-in Staff)
Route::middleware(['auth.staff'])->group(function () {
    Route::resource('emergencyalerts', EmergencyAlertController::class);
});

Route::prefix('nextofkin')->group(function () {
    
     // Forgot Password Route
    Route::get('forgot', [NextOfKinForgotPasswordController::class, 'showLinkRequestForm'])->name('nextofkin.forgot');
});

// Next of Kin Authentication Routes
Route::prefix('nextofkin')->group(function () {
    Route::get('login', [NextOfKinLoginController::class, 'showLoginForm'])->name('nextofkin.login');
    Route::post('login', [NextOfKinLoginController::class, 'login'])->name('nextofkin.login.submit');
    Route::post('logout', [NextOfKinLoginController::class, 'logout'])->name('nextofkin.logout');

    Route::middleware('auth:nextofkin')->group(function () {
        Route::get('dashboard', function () {
            return view('nextofkin.dashboard');
        })->name('nextofkin.dashboard');
    });
});

// Resource Routes for Other Entities
Route::resource('residents', ResidentController::class);
Route::resource('diagnoses', DiagnosisController::class);
Route::resource('standardtasks', StandardTaskController::class);
Route::resource('careplans', CarePlanController::class);
Route::resource('doses', DoseController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('nextofkins', NextOfKinController::class);
Route::resource('staffmembers', StaffMemberController::class);
Route::resource('roles', RoleController::class);
Route::resource('dietaryrestrictions', DietaryRestrictionController::class);
Route::resource('stafftasks', StaffTaskController::class);

// Emergency Alert Actions
Route::patch('/emergencyalerts/{id}/resolve', [EmergencyAlertController::class, 'markAsResolved'])->name('emergencyalerts.resolve');

// Main Page
Route::get('/main', function () {
    return view('main');
})->name('main');