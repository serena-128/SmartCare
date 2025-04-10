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
use App\Http\Controllers\NewsController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PhotoGalleryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\GoogleFitController;
use App\Http\Controllers\FitbitController;
use App\Http\Controllers\OpenFDAController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\CartController;
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
Route::get('/diagnoses', [DiagnosisController::class, 'index'])->name('diagnoses.index');
Route::get('/diagnoses/create', [DiagnosisController::class, 'create'])->name('diagnoses.create');
Route::post('/diagnoses', [DiagnosisController::class, 'store'])->name('diagnoses.store');
Route::get('/diagnoses/{id}', [DiagnosisController::class, 'show'])->name('diagnoses.show');
Route::get('/diagnoses/{id}/edit', [DiagnosisController::class, 'edit'])->name('diagnoses.edit');
Route::put('/diagnoses/{id}', [DiagnosisController::class, 'update'])->name('diagnoses.update');
Route::delete('/diagnoses/{id}', [DiagnosisController::class, 'destroy'])->name('diagnoses.destroy');

Route::get('/my-schedule', [ScheduleController::class, 'mySchedule'])->name('staff.schedule');

Route::middleware(['auth'])->group(function () {
    Route::get('/staffmember/profile', function () {
        return view('staffmembers.profile');
    })->name('staff.profile');
});

Route::get('/schedule/request-day-off/{id}', [ScheduleController::class, 'showRequestDayOffForm'])->name('schedule.requestDayOffForm');
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

// Next of Kin Profile & Settings
Route::get('nextofkin/complete-profile', [NextOfKinProfileController::class, 'showCompleteProfileForm'])->name('nextofkin.complete-profile');
Route::post('nextofkin/complete-profile', [NextOfKinProfileController::class, 'completeProfile'])->name('nextofkin.complete-profile.submit');

// RSVP Form
Route::get('/rsvp-form', [RsvpController::class, 'showForm'])->name('rsvp.form');
Route::post('/rsvp-form', [RsvpController::class, 'submitRsvp'])->name('rsvp.submit');

// Contact Form
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

// About Us Page
Route::view('/about', 'about')->name('about');

// Event & Appointment Routes
Route::get('/add-event', [EventController::class, 'create'])->name('events.create');
Route::post('/add-event', [EventController::class, 'store'])->name('events.store');
Route::get('/fetch-events', [EventController::class, 'fetchEvents'])->name('events.fetch');

Route::get('/add-event-appointment', [EventAppointmentController::class, 'create'])->name('eventAppointment.create');
Route::post('/add-event-appointment', [EventAppointmentController::class, 'store'])->name('eventAppointment.store');

// Profile Picture Update
Route::get('/profile', [NextOfKinDashboardController::class, 'profile'])->name('nextofkin.profile')->middleware('auth:nextofkin');
Route::post('/profile/update', [NextOfKinDashboardController::class, 'updateProfile'])->name('nextofkin.profile.update');

// Fetching Appointments
Route::get('/fetch-appointments', [AppointmentController::class, 'fetchAppointments'])->name('appointments.fetch');

Route::resource('diagnosistypes', App\Http\Controllers\diagnosistypeController::class);

Route::get('/staff/calendar', function () {
    return view('staff.calendar');
})->name('staff.calendar');

Route::get('/staff/appointments/json', [App\Http\Controllers\appointmentController::class, 'fetchStaffAppointments'])->name('appointments.json');

// Combine both sections from the conflict:
// Routes from HEAD:
Route::get('/search-appointments', [AppointmentController::class, 'searchAppointments']);
Route::get('/photogallery', [PhotoGalleryController::class, 'index'])->name('photogallery');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');
Route::get('/bulletin/create', [BulletinController::class, 'create'])->name('bulletin.create');
Route::post('/bulletin', [BulletinController::class, 'store'])->name('bulletin.store');
Route::get('/photo/create', [PhotoController::class, 'create'])->name('photo.create');
Route::post('/photo', [PhotoController::class, 'store'])->name('photo.store');
Route::post('/nextofkin/password/update', [NextOfKinController::class, 'updatePassword'])->name('nextofkin.password.update');
Route::get('/notifications/count', [NotificationController::class, 'fetch'])->name('notifications.count');
Route::get('/notifications/fetch', [NotificationController::class, 'fetch'])->name('notifications.fetch');
Route::post('/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.markRead');
Route::get('staff/schedule', [StaffScheduleController::class, 'showSchedule'])->name('staffmembers.schedule');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
// And the route from the other branch:
Route::get('/staff/birthdays', function () {
    return view('staff.birthdays');
});

//signed out
Route::get('/signed-out', function () {
    return view('signedout'); // Create a view for this if needed
})->name('signed.out');

Route::post('appointments/rsvp', [AppointmentController::class, 'handleRSVP'])->name('appointments.rsvp');

Route::post('/events/rsvp', [\App\Http\Controllers\EventController::class, 'handleRSVP'])->name('events.rsvp');

Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::post('/nextofkin/send-message', [NextOfKinController::class, 'sendMessage'])->name('nextofkin.sendMessage');

// Route to view staff messages
Route::get('/staff/messages', [StaffMemberController::class, 'viewMessages'])->name('staffMessages');

Route::post('/staff/reply/{messageId}', [StaffMemberController::class, 'reply'])->name('staff.reply');

Route::get('/staff/messages/{messageId?}', [StaffMemberController::class, 'viewMessages'])->name('staff.messages');

Route::middleware('auth:nextofkin')->get('/received-messages', [NextOfKinController::class, 'showReceivedMessages'])->name('nextofkin.receivedMessages');

Route::get('/google-fit/connect', [GoogleFitController::class, 'connect'])->name('googlefit.connect');
Route::get('/google-fit/callback', [GoogleFitController::class, 'callback'])->name('googlefit.callback');
Route::get('/google-fit/data', [GoogleFitController::class, 'getData'])->name('googlefit.data');

Route::get('/fitbit/connect', [App\Http\Controllers\FitbitController::class, 'redirectToFitbit'])->name('fitbit.connect');
Route::get('/fitbit/callback', [App\Http\Controllers\FitbitController::class, 'handleCallback']);
Route::get('/fitbit/data', [App\Http\Controllers\FitbitController::class, 'fetchFitbitData'])->name('fitbit.data');

Route::get('/nextofkin/fitbit-summary', [FitbitController::class, 'showFitbitSummary'])->name('fitbit.summary');
Route::get('/fitbit/summary', [FitbitController::class, 'summary']);
Route::get('/fitbit/callback', [FitbitController::class, 'handleCallback']);

Route::get('/staff/drug-info/{name}', [\App\Http\Controllers\OpenFDAController::class, 'fetchDrugInfo'])->name('staff.drug.info');
Route::get('/staff/medication/{drugName}', [StaffDashboardController::class, 'showMedicationInfo'])->name('staff.medication');

Route::get('/staff/medication-search', [StaffDashboardController::class, 'showMedicationInfo'])->name('staff.medication');
Route::get('/staff/medications', [StaffDashboardController::class, 'showMedicationPage'])->name('staff.medications');

Route::post('/pharmacy/purchase', [App\Http\Controllers\PharmacyController::class, 'purchase'])->name('pharmacy.purchase');

Route::get('/pharmacy', [PharmacyController::class, 'index'])->name('pharmacy.index');
Route::post('/pharmacy/purchase', [PharmacyController::class, 'placeOrder'])->name('pharmacy.purchase');
Route::post('/pharmacy/ship/{order}', [PharmacyController::class, 'markShipped'])->name('pharmacy.ship');


Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/pharmacy/add-to-cart', [PharmacyController::class, 'addToCart'])->name('pharmacy.addToCart');
Route::post('/pharmacy/checkout', [PharmacyController::class, 'checkout'])->name('pharmacy.checkout');

Route::put('/residents/{id}/update-medications', [\App\Http\Controllers\ResidentController::class, 'updateMedications'])->name('residents.updateMedications');

Route::post('/pharmacy/clear-cart', [PharmacyController::class, 'clearCart'])->name('pharmacy.clearCart');

