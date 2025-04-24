<?php

use App\Http\Controllers\Admin\ThemeAdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ThemeDoctorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Patients Routes
// Route::controller(ThemeController::class)->name('theme.')->group(function () {
//     Route::get('/', 'index')->name('index');
//     Route::get('/doctors', 'doctors')->name('doctors');
//     Route::get('/contact', 'contact')->name('contact');
//     Route::get('/login', 'login')->name('login');
//     Route::get('/psychologists', 'psychologists')->name('psychologists');
//     Route::get('/live-sessions', 'liveSession')->name('live-sessions');
// });

// ================= Middleware ====================

// // Patient Routes
// Route::middleware(['auth', 'role:user'])->controller(ThemeController::class)->name('theme.')->group(function () {
//     Route::get('/', 'index')->name('index');
//     Route::get('/doctors', 'doctors')->name('doctors');
//     Route::get('/contact', 'contact')->name('contact');
//     Route::get('/psychologists', 'psychologists')->name('psychologists');
//     Route::get('/live-sessions', 'liveSession')->name('live-sessions');
//     Route::get('/user-profile', 'profile')->name('user-profile');
//     Route::get('/user-profile/appointments', 'fetchAppointments')->name('user-profile.appointments');
// });

// // Doctor Routes
// Route::middleware(['auth', 'role:doctor'])->controller(ThemeDoctorController::class)->name('doctor.')->group(function () {
//     Route::get('dashboard', 'index')->name('doctor.dashboard');
//     Route::get('liveSessions', 'liveSessions')->name('doctor.liveSessions');
//     Route::get('schedualeTimings', 'schedualeTimings')->name('doctor.schedualeTimings');
//     Route::get('reviews', 'reviews')->name('doctor.reviews');
//     Route::get('profileSettings', 'profileSettings')->name('doctor.profileSettings');
//     Route::get('changePassword', 'changePassword')->name('doctor.changePassword');
//     Route::get('appointments/fetch', 'fetchAppointments')->name('doctor.appointments.fetch');
// });

// Route::middleware(['auth', 'role:patient'])->controller(ThemeController::class)->name('theme.')->group(function () {
//     Route::get('/', 'index')->name('index');
//     Route::get('/doctors', 'doctors')->name('doctors');
//     Route::get('/contact', 'contact')->name('contact');
//     Route::get('/psychologists', 'psychologists')->name('psychologists');
//     Route::get('/live-sessions', 'liveSession')->name('live-sessions');
//     Route::get('/user-profile', 'profile')->name('user-profile');
//     Route::get('/user-profile/appointments', 'fetchAppointments')->name('user-profile.appointments');
// });

// // Doctor Routes (only for doctor role)
// Route::middleware(['auth', 'role:doctor'])->controller(ThemeDoctorController::class)->name('doctor.')->group(function () {
//     Route::get('dashboard', 'index')->name('doctor.dashboard');
//     Route::get('liveSessions', 'liveSessions')->name('doctor.liveSessions');
//     Route::get('schedualeTimings', 'schedualeTimings')->name('doctor.schedualeTimings');
//     Route::get('reviews', 'reviews')->name('doctor.reviews');
//     Route::get('profileSettings', 'profileSettings')->name('doctor.profileSettings');
//     Route::get('changePassword', 'changePassword')->name('doctor.changePassword');
//     Route::get('appointments/fetch', 'fetchAppointments')->name('doctor.appointments.fetch');
// });

// // ================= Middleware ====================
// Route::get('/login', [ThemeController::class, 'login'])->name('theme.login');



// Public routes
Route::get('/login', [ThemeController::class, 'login'])->name('theme.login');

// Root route - redirects based on role
Route::middleware('auth')->get('/', function () {
    $user = auth()->user();

    if (in_array($user->role, ['user', 'patientDoctor', 'patientPsychologist'])) {
        return redirect()->route('theme.index');
    }

    if ($user->role === 'doctor') {
        return redirect()->route('doctor.dashboard'); // Now matches exactly
    }

    abort(403, 'Unauthorized role: ' . $user->role);
});

// Patient Routes
Route::middleware(['auth', 'role:patient'])->controller(ThemeController::class)->name('theme.')->group(function () {
    Route::get('/home', 'index')->name('index');
    Route::get('/doctors', 'doctors')->name('doctors');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/psychologists', 'psychologists')->name('psychologists');
    Route::get('/live-sessions', 'liveSession')->name('live-sessions');
    Route::get('/user-profile', 'profile')->name('user-profile');
    Route::get('/user-profile/appointments', 'fetchAppointments')->name('user-profile.appointments');
});

// Doctor Routes
Route::prefix('doctor')->middleware(['auth', 'role:doctor'])->name('doctor.')->group(function () {
    Route::get('dashboard', [ThemeDoctorController::class, 'index'])->name('dashboard');
    Route::get('liveSessions', [ThemeDoctorController::class, 'liveSessions'])->name('liveSessions');
    Route::get('schedualeTimings', [ThemeDoctorController::class, 'schedualeTimings'])->name('schedualeTimings');
    Route::get('reviews', [ThemeDoctorController::class, 'reviews'])->name('reviews');
    Route::get('profileSettings', [ThemeDoctorController::class, 'profileSettings'])->name('profileSettings');
    Route::get('changePassword', [ThemeDoctorController::class, 'changePassword'])->name('changePassword');
    Route::get('appointments/fetch', [ThemeDoctorController::class, 'fetchAppointments'])->name('appointments.fetch');

    Route::get('/schedule', [DoctorScheduleController::class, 'index'])->name('schedule');
    Route::post('/schedule/add-slot', [DoctorScheduleController::class, 'storeSlot'])
        ->name('schedule.slot.store');
    Route::delete('/schedule/delete-slot/{slot}', [DoctorScheduleController::class, 'deleteSlot'])->name('schedule.slot.delete');
});





// Doctors Routes
// Route::controller(ThemeDoctorController::class)->name('doctor.')->group(function () {
//     Route::get('/doctor/dashboard', 'index')->name('doctor.dashboard');
//     Route::get('/doctor/liveSessions', 'liveSessions')->name('doctor.liveSessions');
//     Route::get('/doctor/schedualeTimings', 'schedualeTimings')->name('doctor.schedualeTimings');
//     Route::get('/doctor/reviews', 'reviews')->name('doctor.reviews');
//     Route::get('/doctor/profileSettings', 'profileSettings')->name('doctor.profileSettings');
//     Route::get('/doctor/changePassword', 'changePassword')->name('doctor.changePassword');
//     Route::get('/doctor/appointments/fetch', 'fetchAppointments')->name('doctor.appointments.fetch');
// });

// Admin Routes
Route::controller(ThemeAdminController::class)->name('Admin.')->group(function () {
    Route::get('/admin/home', 'index')->name('admin.home');
});

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

Route::get('/doctors/{id}', [DoctorController::class, 'show'])->name('doctors.show');

Route::get('/psychologists/{id}', [PsychologistController::class, 'show'])->name('psychologist.show');


// Appointment Routes
Route::controller(AppointmentController::class)
    ->prefix('appointment')->name('appointment.')->group(function () {
        Route::get('/{doctor_id}', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::middleware('auth')->group(function () {
//     Route::get('/user-profile', [ThemeController::class, 'profile'])->name('theme.user-profile');
//     Route::get('/user-profile/appointments', [ThemeController::class, 'fetchAppointments'])->name('theme.user-profile.appointments');

//     Route::patch('/user-profile', [ProfileController::class, 'update'])->name('user-profile.update');
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update']);
//     Route::delete('/profile', [ProfileController::class, 'destroy']);
// });


require __DIR__ . '/auth.php';
