<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Ambil user yang sedang login

        if (!$user) {
            // Kalau belum login, redirect ke halaman login
            return redirect()->route('login.index')->with('error', 'Silakan login terlebih dahulu.');
        }

         if (!in_array($user->role, ['admin', 'patient'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('daftar.daftar');
    }

    public function redirectBasedOnPatientStatus()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.index')->with('error', 'Silakan login terlebih dahulu.');
        }

        $patient = Patient::where('user_id', $user->id)->first();

        if ($patient) {
            return redirect()->route('patients.createOld');
        } else {
            return redirect()->route('patients.createNew');
        }
    }


    public function createNew()
    {
        return view('daftar.createNew');
    }

    public function createOld()
    {
        return view('daftar.createOld');
    }

    public function storeNew(Request $request)
{

    \Log::info('User ID saat menyimpan pasien:', ['user_id' => auth()->id()]);
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'age' => 'nullable|numeric',
        'gender' => 'nullable|in:male,female,other',
        'birth_date' => 'nullable|date',
        'keluhan' =>'nullable|string',
    ]);

    // Ambil data pasien terbaru
    $today = now()->toDateString();
    $queueNumber = Patient::whereDate('created_at', $today)->count() + 1;

    // Generate Medical Record Number otomatis
    $date = now()->format('Ymd'); // contoh: 20250427
    $patientCountToday = Patient::whereDate('created_at', now()->toDateString())->count() + 1; // urutan per hari
    $medicalRecordNumber = 'RM-' . $date . '-' . str_pad($patientCountToday, 4, '0', STR_PAD_LEFT); 

    $patient = Patient::create([
        'name' => $validated['name'],
        'age' => $validated['age'] ?? null,
        'gender' => $validated['gender'] ?? null,
        'birth_date' => $validated['birth_date'] ?? null,
        'queue_number' => null,
        'keluhan' => $validated['keluhan'] ?? null,
        'medical_record_number' => $medicalRecordNumber,
        'user_id' => auth()->id(), 
    ]);

    return redirect()->route('patients.selectPoli', ['patient' => $patient->id]);
}


    public function storeOld(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'medical_record_number' => 'required|string|max:255',
            'keluhan' => 'nullable|string',
        ]);

        $existingPatient = Patient::where('medical_record_number', $validated['medical_record_number'])->first();

        if ($existingPatient) {
            return redirect()->route('patients.selectPoli', ['patient' => $existingPatient->id]);
        } else {
            $today = now()->toDateString();
            $queueNumber = Patient::whereDate('created_at', $today)->count() + 1;

            $patient = Patient::create([
                'name' => $validated['name'],
                'medical_record_number' => $validated['medical_record_number'],
                'keluhan' => $validated['keluhan'],
                'queue_number' => $queueNumber,
            ]);

            return redirect()->route('patients.showQueueNumber', ['patient' => $patient->id]);
        }
    }

    public function selectPoli($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $polies = Clinic::all();
        $doctors = Doctor::with('clinic')->get();

        return view('daftar.pilih', compact('patient', 'polies', 'doctors'));
    }

    public function storePoli(Request $request, $patientId)
    {
        \Log::info('Request data:', $request->all());
        
        $validated = $request->validate([
            'clinic_id' => 'required|exists:clinics,id',
            'doctor_id' => 'required|exists:doctors,id',
            'keluhan' => 'nullable|string',
        ]);

        $doctor = Doctor::findOrFail($request->doctor_id);
        $clinicId = $doctor->clinic_id;

        $queueNumber = Patient::whereDate('created_at', now())
            ->where('doctor_id', $request->doctor_id)
            ->count() + 1;


        $patient = Patient::findOrFail($patientId);

        $patient->update([
            'clinic_id' => $validated['clinic_id'],
            'doctor_id' => $validated['doctor_id'],
            'queue_number' => $queueNumber,
            'keluhan' => $validated['keluhan'] ?? $patient->keluhan,
        ]);

        session()->flash('queue_number', $patient->queue_number);
        
        \Log::info('Queue updated:', [
            'clinic_id' => $validated['clinic_id'],
            'queue_number' => $queueNumber
        ]);

        \Log::info('Doctor ID received:', ['doctor_id' => $validated['doctor_id']]);

        return redirect()->route('patients.showQueueNumber', ['patient' => $patient->id]);
    }

    public function showQueueNumber($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        return view('daftar.show', compact('patient'));
    }

    public function search(Request $request)
{
    $name = $request->query('name');
    $patients = Patient::where('name', 'LIKE', '%' . $name . '%')->get();

    if ($patients->count() > 0) {
        return response()->json([
            'medical_record_number' => $patients->first()->medical_record_number, // Get first match
            'patients' => $patients->map(function($patient) {
                return [
                    'name' => $patient->name,
                    'medical_record_number' => $patient->medical_record_number,
                ];
            }),
        ]);
    }

    return response()->json(['medical_record_number' => null]);
}


    

    
}
