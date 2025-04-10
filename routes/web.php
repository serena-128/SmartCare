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
use App\Models\Resident;
use App\Http\Controllers\staffProfilesController;


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

Route::prefix('nextofkin')->group(function () {
    Route::get('register', [NextOfKinRegisterController::class, 'showRegistrationForm'])->name('nextofkin.register');
    Route::post('register', [NextOfKinRegisterController::class, 'register'])->name('nextofkin.register.submit');
    Route::get('forgot', [NextOfKinForgotPasswordController::class, 'showLinkRequestForm'])->name('nextofkin.forgot');
    Route::get('login', [NextOfKinLoginController::class, 'showLoginForm'])->name('nextofkin.login');
    Route::post('login', [NextOfKinLoginController::class, 'login'])->name('nextofkin.login.submit');
    Route::post('logout', [NextOfKinLoginController::class, 'logout'])->name('nextofkin.logout');
    
    Route::middleware('auth:nextofkin')->group(function () {
        Route::get('dashboard', [NextOfKinDashboardController::class, 'index'])->name('nextofkins.dashboard');
    });

    Route::post('settings/update', [NextOfKinSettingsController::class, 'updateProfile'])->name('nextofkin.settings.update');
    Route::post('notifications/update', [NextOfKinSettingsController::class, 'updateNotifications'])->name('nextofkin.notifications.update');
});

// ✅ Next of Kin Profile & Settings
Route::get('nextofkin/complete-profile', [NextOfKinProfileController::class, 'showCompleteProfileForm'])->name('nextofkin.complete-profile');
Route::post('nextofkin/complete-profile', [NextOfKinProfileController::class, 'completeProfile'])->name('nextofkin.complete-profile.submit');
// ✅ RSVP Form
Route::get('/rsvp-form', [RsvpController::class, 'showForm'])->name('rsvp.form');
Route::post('/rsvp-form', [RsvpController::class, 'submitRsvp'])->name('rsvp.submit');

// ✅ Contact Form
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

// ✅ About Us Page
Route::view('/about', 'about')->name('about');

// ✅ Event & Appointment Routes
Route::get('/add-event', [EventController::class, 'create'])->name('events.create');
Route::post('/add-event', [EventController::class, 'store'])->name('events.store');
Route::get('/fetch-events', [EventController::class, 'fetchEvents']);

Route::get('/add-event-appointment', [EventAppointmentController::class, 'create'])->name('eventAppointment.create');
Route::post('/add-event-appointment', [EventAppointmentController::class, 'store'])->name('eventAppointment.store');

// ✅ Profile Picture Update
Route::get('/profile', [NextOfKinDashboardController::class, 'profile'])->name('nextofkin.profile')->middleware('auth:nextofkin');
Route::post('/profile/update', [NextOfKinDashboardController::class, 'updateProfile'])->name('nextofkin.profile.update');

// ✅ Fetching Appointments
Route::get('/fetch-appointments', [AppointmentController::class, 'fetchAppointments'])->name('appointments.fetch');


Route::resource('diagnosistypes', App\Http\Controllers\diagnosistypeController::class);

Route::get('/staff/calendar', function () {
    return view('staff.calendar');
})->name('staff.calendar');
// routes/web.php
Route::get('/staff/appointments/json', [App\Http\Controllers\appointmentController::class, 'fetchStaffAppointments'])->name('appointments.json');


Route::get('/staff/birthdays', function () {
    return view('staff.birthdays');
});

Route::get('/appointments/rsvp', [AppointmentController::class, 'rsvpForm'])->name('appointments.rsvp.form');

Route::resource('staffProfiles', App\Http\Controllers\StaffProfilesController::class);

Route::get('/my-profile', [StaffProfilesController::class, 'myProfile'])->name('staffProfiles.my');


Route::get('/my-profile', function () {
    if (!Session::has('staff_id')) {
        return redirect('/login');
    }

    $staff = \App\Models\StaffMember::find(Session::get('staff_id'));
    return view('my_profile', compact('staff'));
})->name('my.profile');
Route::get('/my-profile/edit', function () {
    if (!Session::has('staff_id')) {
        return redirect('/login');
    }

    $staff = \App\Models\StaffMember::find(Session::get('staff_id'));
    return view('edit_my_profile', compact('staff'));
})->name('my.profile.edit');

Route::post('/my-profile/update', function (Illuminate\Http\Request $request) {
    if (!Session::has('staff_id')) {
        return redirect('/login');
    }

    $staff = \App\Models\StaffMember::find(Session::get('staff_id'));

    // Update phone number
    $staff->contactnumber = $request->contactnumber;
    //update address
    $staff->address = $request->address;


    // Upload profile image
    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('staff_images', 'public');
        $staff->profile_picture = $path;
    }

    $staff->save();

    return redirect()->route('my.profile')->with('success', 'Profile updated!');
})->name('my.profile.update');






Route::get('/resident-hub', function () {
    $totalResidents = Resident::count();
    $newThisWeek = Resident::where('created_at', '>=', now()->subWeek())->count();

    // Check if 'status' column exists in your database before using it
    $discharged = Resident::where('status', 'discharged')->count(); 

    return view('residentHub', compact('totalResidents', 'newThisWeek', 'discharged'));
})->name('resident.hub');


Route::get('/residents/search', [ResidentController::class, 'searchPage'])->name('residents.search');
Route::get('/residents/search-results', [ResidentController::class, 'searchResults'])->name('residents.searchResults');

Route::resource('residents', ResidentController::class); // <-- Leave this below
