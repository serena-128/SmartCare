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
use App\Http\Controllers\Auth\NextOfKinRegisterController;

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

// Next of Kin Register Routes
Route::prefix('nextofkin')->group(function () {
    Route::get('register', [NextOfKinRegisterController::class, 'showRegistrationForm'])->name('nextofkin.register');
    Route::post('register', [NextOfKinRegisterController::class, 'register'])->name('nextofkin.register.submit');
});

Route::prefix('nextofkin')->group(function () {
    
     // Forgot Password Route
    //Route::get('forgot', [NextOfKinForgotPasswordController::class, 'showLinkRequestForm'])->name('nextofkin.forgot');
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

Route::prefix('nextofkin')->group(function () {

    // Show the Next of Kin forgot password form
    Route::get('forgot', [NextOfKinForgotPasswordController::class, 'showLinkRequestForm'])
         ->name('nextofkin.forgot');

    // Handle the Next of Kin forgot password form
    Route::post('forgot', [NextOfKinForgotPasswordController::class, 'sendResetLinkEmail'])
         ->name('nextofkin.password.email');
});

// Direct login to next of kin dashboard
Route::middleware('auth:nextofkin')->group(function () {
    Route::get('dashboard', function () {
        return view('nextofkins.dashboard'); // This view should exist
    })->name('nextofkins.dashboard');
});

//Optional link for non registered next of kin users on the login 
Route::get('register', [NextOfKinRegisterController::class, 'showRegistrationForm'])->name('nextofkin.register');

//Route for next of kin users when signing out
Route::get('/signed-out', function () {
    return view('signedout');
})->name('signed.out');

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