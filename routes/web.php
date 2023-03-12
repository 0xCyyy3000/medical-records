<?php

use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VitalSignController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/add-patient', [PageController::class, 'addPatient'])->name('add.patient');
Route::get('/patients', [PageController::class, 'patients'])->name('index.patient');

Route::post('/add-patient/store', [PatientController::class, 'store'])->name('patient.store');
Route::get('/patient/{patient}', [PatientController::class, 'select'])->name('patient.select');
Route::put('/patient/update/{patient}', [PatientController::class, 'update'])->name('patient.update');
Route::delete('/patient/destroy/{patient}', [PatientController::class, 'destroy'])->name('patient.destroy');

Route::post('/update/vitals/{patient}', [VitalSignController::class, 'update'])->name('patient.vitals.update');

Route::group(['middleware' => 'guest', 'prefix' => '/patient/medical-record'], function () {
    Route::post('/store/{patient}', [MedicalRecordController::class, 'store'])->name('medicalRecord.store');
    Route::put('/update', [MedicalRecordController::class, 'update'])->name('medicalRecord.update');
    Route::delete('/destroy', [MedicalRecordController::class, 'destroy'])->name('medicalRecord.destroy');
});
