<?php

use App\Http\Controllers\LabTestController;
use App\Http\Controllers\ProfileController;
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

use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
Route::get('/patients/{patients}/edit', [PatientController::class, 'edit'])->name('patients.edit');
Route::put('/patients/{patients}', [PatientController::class, 'update'])->name('patients.update');
Route::delete('/patients/{patients}', [PatientController::class, 'destroy'])->name('patients.destroy');

Route::get('/tickets/index', [TicketController::class, 'index'])->name('tickets.index');
//Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

Route::get('/lab_tests', [LabTestController::class, 'index'])->name('lab_tests.index');
Route::get('/lab_tests/create', [LabTestController::class, 'create'])->name('lab_tests.create');
Route::post('/lab_tests', [LabTestController::class, 'store'])->name('lab_tests.store');
Route::get('/lab_tests/{labTest}/edit', [LabTestController::class, 'edit'])->name('lab_tests.edit');
Route::put('/lab_tests/{labTest}', [LabTestController::class, 'update'])->name('lab_tests.update');
Route::delete('/lab_tests/{labTest}', [LabTestController::class, 'destroy'])->name('lab_tests.destroy');

use App\Http\Controllers\MedicalReportController;

Route::get('/medical_reports/create/{ticket}', [MedicalReportController::class, 'create'])->name('medical_reports.create');
Route::post('/medical_reports', [MedicalReportController::class, 'store'])->name('medical_reports.store');
Route::get('/medical_reports/{medicalReport}/edit', [MedicalReportController::class, 'edit'])->name('medical_reports.edit');
Route::put('/medical_reports/{medicalReport}', [MedicalReportController::class, 'update'])->name('medical_reports.update');
Route::delete('/medical_reports/{medicalReport}', [MedicalReportController::class, 'destroy'])->name('medical_reports.destroy');




require __DIR__.'/auth.php';
