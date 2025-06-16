<?php

// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReservasiApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\PatientApiController;
use App\Http\Controllers\Api\JadwalApiController;
use App\Http\Controllers\Api\ForgotPasswordApiController;



Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});



Route::post('/kritik-saran', [ProfileApiController::class, 'storeKritikSaran']);

Route::post('/login', [LoginApiController::class, 'login']);
Route::post('/register-patient', [LoginApiController::class, 'registerPatient']);
// Rute untuk Lupa Password
Route::post('/forgot-password', [ForgotPasswordApiController::class, 'sendResetCode']);
Route::post('/verify-reset-code', [ForgotPasswordApiController::class, 'verifyCode']);
Route::post('/reset-password', [ForgotPasswordApiController::class, 'resetPassword']);


    // Reservasi
Route::get('/rooms', [ReservasiApiController::class, 'listRooms']);
Route::get('/reservasi/{roomId}', [ReservasiApiController::class, 'create']);
Route::middleware('auth:sanctum')->post('/reservasi', [ReservasiApiController::class, 'store']);


// Route::post('/reservasi', [ReservasiApiController::class, 'store']);
Route::get('/reservasi/receipt/{id}', [ReservasiApiController::class, 'receipt']);
Route::get('/search-patient', [ReservasiApiController::class, 'searchPatient']);

    // Jadwal Dokter dan Klinik
Route::get('/doctors', [JadwalApiController::class, 'doctors'])->name('doctors.index');
Route::get('/dokter/{id}', [JadwalApiController::class, 'showDoctor'])->name('doctors.api.show');
Route::get('/clinics', [JadwalApiController::class, 'clinic'])->name('clinics.api.index');
Route::get('/klinik/{id}', [JadwalApiController::class, 'showClinic'])->name('clinic.api.show');
Route::get('/jadwal/{id}', [JadwalApiController::class, 'getDoctorSchedule'])->name('doctors.api.schedule');

Route::middleware('auth:sanctum')->group(function () {

    // Profile
    Route::get('/profile', [ProfileApiController::class, 'index']);
    Route::post('/ubah-password', [ProfileApiController::class, 'ubahPassword']);
    Route::post('/logout', [LoginApiController::class, 'logout']);
    Route::get('/riwayat-kunjungan', [ProfileApiController::class, 'riwayatKunjungan']);


    //daftar
    Route::post('/patients/new', [PatientApiController::class, 'storeNew']);
    Route::post('/patients/old', [PatientApiController::class, 'storeOld']);
    // Route::post('/patients/{patient}/poli', [PatientApiController::class, 'storePoli']);
    Route::post('/reservasi-poli/{patientId}', [PatientApiController::class, 'storePoli']);
    Route::get('/patients/search', [PatientApiController::class, 'search']);
    Route::get('/patient/status', [PatientApiController::class, 'checkPatientStatus']);

    // Route::post('/patient', [PatientApiController::class, 'storeNew'])->middleware('auth:sanctum');

    

});





