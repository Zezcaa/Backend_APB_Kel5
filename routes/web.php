<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\jadwalController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\reservasiController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\dokterController;


Route::get('/', function () {
    return view('index');
})->name('index');


//reservasi 
Route::get('/rooms', [reservasiController::class, 'index'])->name('rooms.index');
Route::get('/reservasi/create/{roomId}', [reservasiController::class, 'create'])->name('reservasi.create');
Route::post('/reservasi/store', [reservasiController::class, 'store'])->name('reservasi.store');
Route::get('/reservations', [reservasiController::class, 'index'])->name('reservations.index');
Route::get('/reservasi/receipt/{id}', [reservasiController::class, 'receipt'])->name('reservasi.receipt');
Route::get('/search-patient', [reservasiController::class, 'searchPatient'])->name('searchPatient');



//profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/riwayat-kunjungan', [ProfileController::class, 'riwayatKunjungan'])->name('riwayat.kunjungan');
Route::get('/ubah-password', [ProfileController::class, 'ubahPassword'])->name('ubah.password');
Route::get('/pengaturan-notifikasi', [ProfileController::class, 'pengaturanNotif'])->name('pengaturan.notif');
Route::get('/pengaturan-privasi', [ProfileController::class, 'pengaturanPrivasi'])->name('pengaturan.privasi');
Route::get('/kritik-saran', [ProfileController::class, 'kritikSaran'])->name('kritik.saran');


//login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
// Tampilkan form registrasi pasien
Route::get('/login/register-patient', function () {
    return view('login.register'); // Pastikan file resources/views/register.blade.php ada
})->name('register.patient');

// Proses form registrasi pasien
Route::post('/login/register-patient', [LoginController::class, 'registerPatient'])->name('register.patient.submit');



// Middleware auth untuk memastikan pengguna login sebelum mengakses halaman tertentu
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard.admin.admin'); // Halaman dashboard admin
    })->name('admin.dashboard');

    Route::get('/dokter/dashboard', function () {
        return view('dashboard.dokter.dokter')->with('namaDokter', session('namaDokter'));
    })->name('dokter.dashboard.view')->middleware('auth');
    
    // Halaman utama setelah login untuk user biasa
    Route::get('/home', function () {
        return view('index'); // Halaman utama
    })->name('home');
});

//logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



//jadwal dokter
Route::get('/dokter', [dokterController::class, 'dashboard'])->name('dokter.main');
Route::get('/dokter/{id}', [jadwalController::class, 'showDoctor'])->name('doctors.show');
Route::get('/clinics', [jadwalController::class, 'index'])->name('clinics.index');
Route::get('/klinik/{id}', [jadwalController::class, 'showClinic'])->name('clinic.show');

Route::middleware(['auth'])->group(function () {
    // daftar
    Route::get('/daftar', [PatientController::class, 'redirectBasedOnPatientStatus'])->name('patients.index');

    // Pasien baru
    Route::get('/daftar-pasien-baru', [PatientController::class, 'createNew'])->name('patients.createNew');
    Route::post('/daftar-pasien-baru', [PatientController::class, 'storeNew'])->name('patients.storeNew');

    // Pasien lama
    Route::get('/daftar-pasien-lama', [PatientController::class, 'createOld'])->name('patients.createOld');
    Route::post('/daftar-pasien-lama', [PatientController::class, 'storeOld'])->name('patients.storeOld');

    // Pilih Poli
    Route::get('/pasien/{patient}/pilih', [PatientController::class, 'selectPoli'])->name('patients.selectPoli');
    Route::post('/pasien/{patient}/pilih', [PatientController::class, 'storePoli'])->name('patients.storePoli');

    // Tampilkan nomor antrean
    Route::get('/pasien/{patient}/nomor-antrean', [PatientController::class, 'showQueueNumber'])->name('patients.showQueueNumber');

    // AJAX search pasien
    Route::get('/search-patient', [PatientController::class, 'search'])->name('search.patient');

});

//admin
Route::get('admin', [adminController::class, 'index'])->name('admin.home');
Route::get('/semua-dokter', [adminController::class, 'showdok'])->name('dokter.show');
Route::get('/create-dokter', [adminController::class, 'createdok'])->name('dokter.create');
Route::post('/simpan-dokter', [adminController::class, 'storedok'])->name('dokter.store');
Route::get('/edit-dokter/{id}', [adminController::class, 'editdok'])->name('dokter.edit');
Route::delete('/delete-dokter/{id}', [adminController::class, 'destroydok'])->name('dokter.destroy');
Route::put('/update-dokter/{id}', [adminController::class, 'updatedok'])->name('dokter.update');
Route::get('/admin/cek-pasien', [adminController::class, 'cekPasien'])->name('admin.cekPasien');
Route::get('/admin/search-pasien', [adminController::class, 'searchPasien'])->name('admin.searchPasien');
Route::get('/admin/kritik-saran', [adminController::class, 'lihatKritikSaran'])->name('admin.kritikSaran');

//dokter
Route::get('/dokter', [dokterController::class, 'dashboard'])->name('dokter.dashboard');
Route::get('/dokter-antrian', [dokterController::class, 'antrian'])->name('dokter.antrian');
Route::get('/dokter-antrian-call/{id}', [DokterController::class, 'callPatient'])->name('dokter.antrian.call');
Route::get('/dokter-diagnosis', [DokterController::class, 'diagnosis'])->name('dokter.diagnosis');
Route::post('/dokter-diagnosis/{patient}', [DokterController::class, 'storeHasil'])->name('dokter.storeHasil');


Route::middleware(['auth'])->group(function () {
    Route::get('/dokter/finish-patient/{id}', [DokterController::class, 'finishPatient'])->name('dokter.finishPatient');
});

Route::get('/admin/pasien/{id}/resep', [AdminController::class, 'getResep'])->name('admin.getResepPasien');











