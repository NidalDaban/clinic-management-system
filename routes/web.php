<?php

use App\Http\Controllers\Admin\ThemeAdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ThemeController;
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
Route::controller(ThemeController::class)->name('theme.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/doctors', 'doctors')->name('doctors');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/login', 'login')->name('login');
    Route::get('/psychologists', 'psychologists')->name('psychologists');
    Route::get('/live-sessions', 'liveSession')->name('live-sessions');
});

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


// Route::patch('/user-profile', [ProfileController::class, 'update'])->middleware('auth')->name('user-profile.update');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/user-profile', [ThemeController::class, 'profile'])->name('theme.user-profile');
//     Route::patch('/user-profile', [ProfileController::class, 'update'])->name('user-profile.update');

//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::middleware('auth')->group(function () {
    Route::get('/user-profile', [ThemeController::class, 'profile'])->name('theme.user-profile');
    Route::get('/user-profile/appointments', [ThemeController::class, 'fetchAppointments'])->name('theme.user-profile.appointments');

    Route::patch('/user-profile', [ProfileController::class, 'update'])->name('user-profile.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
});

require __DIR__ . '/auth.php';
