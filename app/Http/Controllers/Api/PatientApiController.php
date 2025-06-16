<?php
  

  namespace App\Http\Controllers\Api;

  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;
  use App\Models\Patient;
  use App\Models\Doctor;
  use App\Models\Clinic;
  
  class PatientApiController extends Controller
  {
      public function storeNew(Request $request)
      {
          $validated = $request->validate([
              'name' => 'required|string|max:255',
              'age' => 'nullable|numeric',
              'gender' => 'nullable|in:male,female,other',
              'birth_date' => 'nullable|date',
              'keluhan' =>'nullable|string',
          ]);
  
          $date = now()->format('Ymd');
          $patientCountToday = Patient::whereDate('created_at', now()->toDateString())->count() + 1;
          $medicalRecordNumber = 'RM-' . $date . '-' . str_pad($patientCountToday, 4, '0', STR_PAD_LEFT);
  
          $patient = Patient::create([
              'name' => $validated['name'],
              'age' => $validated['age'] ?? null,
              'gender' => $validated['gender'] ?? null,
              'birth_date' => $validated['birth_date'] ?? null,
              'keluhan' => $validated['keluhan'] ?? null,
              'queue_number' => null,
              'medical_record_number' => $medicalRecordNumber,
              'user_id' => auth()->id(),
          ]);
  
          return response()->json([
              'message' => 'Pasien baru berhasil dibuat',
              'data' => $patient,
          ], 201);
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
              return response()->json([
                  'message' => 'Pasien lama ditemukan',
                  'data' => $existingPatient
              ]);
          }
  
          $queueNumber = Patient::whereDate('created_at', now())->count() + 1;
  
          $patient = Patient::create([
              'name' => $validated['name'],
              'medical_record_number' => $validated['medical_record_number'],
              'keluhan' => $validated['keluhan'],
              'queue_number' => $queueNumber,
          ]);
  
          return response()->json([
              'message' => 'Pasien baru dari form pasien lama dibuat',
              'data' => $patient
          ], 201);
      }
      public function storePoli(Request $request, $patientId)
{
    \Log::info('Masuk storePoli');

    $validated = $request->validate([
        'clinic_id' => 'required|exists:clinics,id',
        'doctor_id' => 'required|exists:doctors,id',
        'keluhan' => 'nullable|string',
    ]);
    \Log::info('Validasi sukses', $validated);

    $patient = Patient::findOrFail($patientId);
    \Log::info('Pasien ditemukan: ' . $patient->name);

    $doctor = Doctor::findOrFail($validated['doctor_id']);
    \Log::info('Dokter ditemukan: ' . $doctor->name);

    $queueNumber = Patient::whereDate('created_at', now())
        ->where('doctor_id', $doctor->id)
        ->count() + 1;

    $patient->update([
        'clinic_id' => $validated['clinic_id'],
        'doctor_id' => $doctor->id,
        'queue_number' => $queueNumber,
        'keluhan' => $validated['keluhan'] ?? $patient->keluhan,
    ]);

    \Log::info('Update pasien berhasil');

    return response()->json([
        'message' => 'Poli berhasil dipilih',
        'queue_number' => $queueNumber,
        'patient' => $patient
    ]);
}

      
  
      public function search(Request $request)
      {
          $name = $request->query('name');
          $patients = Patient::where('name', 'LIKE', '%' . $name . '%')->get();
  
          return response()->json([
              'found' => $patients->isNotEmpty(),
              'patients' => $patients->map(function($patient) {
                  return [
                      'name' => $patient->name,
                      'medical_record_number' => $patient->medical_record_number,
                  ];
              }),
          ]);
      }
      public function checkPatientStatus(Request $request)
{
    $user = $request->user();

    $patient = Patient::where('user_id', $user->id)->first();

    return response()->json([
        'is_new' => !$patient,
        'patient_id' => $patient?->id,
    ]);
}

  }
  
