<?php

namespace App\Http\Controllers;

use App\Models\doctor;
use App\Models\patient;
use App\Models\hasilPeriksa;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class dokterController extends Controller
{

    public function dashboard()
{
    $user = Auth::user();
    $doctor = Doctor::where('user_id', $user->id)->first();

    // Tambahkan with('hasilPeriksa') agar hasil periksa ikut dimuat
    $patients = Patient::with('hasilPeriksa')
    ->where('doctor_id', $doctor->id)
    ->get();


    return view('dashboard.dokter.dokter', compact('doctor','patients'));
}


    public function antrian()
{
    $user = Auth::user();
    $doctor = Doctor::where('user_id', $user->id)->first();
    $today = now()->toDateString();

    // Ambil pasien hari ini yang masih punya nomor antrian
    $patients = Patient::where('doctor_id', $doctor->id)
    ->whereDate('created_at', '>=', now()->subDays(2))
    ->whereNotNull('queue_number')
    ->orderBy('queue_number')
    ->get();


    return view('dashboard.dokter.antrian', compact('patients', 'doctor'));
}

    
    public function callPatient($id)
{
    $patient = Patient::findOrFail($id);

    // Simpan ID pasien ke session
    session(['current_patient_id' => $patient->id]);

    // Redirect ke halaman diagnosis
    return redirect()->route('dokter.diagnosis');
}

public function diagnosis()
{
    $doctor = Doctor::where('user_id', auth()->id())->first();
    $patientId = session('current_patient_id');

    if (!$patientId) {
        return redirect()->route('dokter.antrian')->with('error', 'Tidak ada pasien yang dipanggil.');
    }

    $patient = Patient::findOrFail($patientId);

    return view('dashboard.dokter.diagnosis', compact('patient', 'doctor'));

    
}

public function storeHasil(Request $request, Patient $patient)
{
    $request->validate([
        'diagnosa' => 'required|string',
        'jenis_rawat' => 'required|string',
        'resep' => 'required|string',
    ]);

    // Simpan hasil pemeriksaan
    HasilPeriksa::create([
        'patient_id' => $patient->id,
        'diagnosa' => $request->diagnosa,
        'jenis_rawat' => $request->jenis_rawat,
        'resep' => $request->resep,
        'doctor_id' => auth()->user()->doctor->id, // pastikan relasi doctor ke user tersedia
    ]);

    // Hapus nomor antrian setelah diperiksa
    $patient->queue_number = null;
    $patient->save();

    // Hapus session ID pasien yang sedang diperiksa
    session()->forget('current_patient_id');

    return redirect()->route('dokter.antrian')->with('success', 'Diagnosis berhasil disimpan dan pasien dikeluarkan dari antrian.');
}



    

    
}

