<?php

namespace App\Http\Controllers;
use App\Models\doctor;
use App\Models\Clinic;
use App\Models\Schedule;
use App\Models\patient;
use App\Models\reservasi;
use App\Models\User;
use App\Models\KritikSaran;

use Illuminate\Support\Facades\Hash; 
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
        
        return view('dashboard.admin.admin'); 
    }
    
    public function showdok()
    {
        $doctors = Doctor::with('clinic', 'schedules')->get();  
        return view('dashboard.admin.dokter.show', compact('doctors'));  // Mengarahkan ke view yang benar
    }

    public function createdok()
    {
        $doctors = Doctor::all();
        $clinics = Clinic::all();
        return view('dashboard.admin.dokter.create', compact('doctors', 'clinics'));
    }

    public function storedok(Request $request)
{
    $validated = $request->validate([
        'username' => 'required|string|unique:users,username',
        'password' => 'required|string|min:6|confirmed',
        'name' => 'required|string|max:255',
        'speciality' => 'required|string|max:255',
        'clinic_id' => 'required|exists:clinics,id',
        'day' => 'required|string',
        'time' => 'required|string',
    ]);

    $user = User::create([
        'username' => $validated['username'],
        'password' => Hash::make($validated['password']),
        'role' => 'dokter',
    ]);

    if (!$user) {
        return back()->with('error', 'Gagal membuat user');
    }

    $doctor = Doctor::create([
        'user_id' => $user->id,
        'name' => $validated['name'],
        'speciality' => $validated['speciality'],
        'clinic_id' => $validated['clinic_id'],
    ]);

    if (!$doctor) {
        // Jika gagal buat doctor, hapus user agar tidak orphan
        $user->delete();
        return back()->with('error', 'Gagal membuat data dokter');
    }

    $schedule = Schedule::create([
        'doctor_id' => $doctor->id,
        'clinic_id' => $validated['clinic_id'],
        'day' => $validated['day'],
        'time' => $validated['time'],
    ]);

    if (!$schedule) {
        // Jika gagal buat jadwal, hapus dokter dan user agar tidak orphan
        $doctor->delete();
        $user->delete();
        return back()->with('error', 'Gagal membuat jadwal dokter');
    }

    return redirect()->route('dokter.show')->with('success', 'Dokter dan Jadwal berhasil ditambahkan.');
}


    public function editdok($id)
    {

        $doctor = Doctor::find($id); 
    

        if (!$doctor) {
            return redirect()->route('dokter.show')->with('error', 'Dokter tidak ditemukan.');
        }

        $clinics = Clinic::all();
        $schedule = $doctor->schedule; 

        return view('dashboard.admin.dokter.editdok', compact('doctor', 'schedule', 'clinics'));
    }

    public function updatedok(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update([
            'name' => $request->name,
            'speciality' => $request->speciality,
            'clinic_id' => $request->clinic_id,
        ]);

        if ($request->has('existing_schedules')) {
            foreach ($request->existing_schedules as $scheduleData) {
                $schedule = Schedule::find($scheduleData['id']);
                if (isset($scheduleData['delete']) && $scheduleData['delete']) {
                    $schedule->delete();
                } else {
                    $schedule->update([
                        'day' => $scheduleData['day'],
                        'time' => $scheduleData['time'],
                    ]);
                }
            }
        }
        if ($request->has('new_schedules')) {
            foreach ($request->new_schedules as $scheduleData) {
                Schedule::create([
                    'doctor_id' => $doctor->id,
                    'day' => $scheduleData['day'],
                    'time' => $scheduleData['time'],
                ]);
            }
        }

        return redirect()->route('dokter.show')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroydok($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('dokter.show')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function cekPasien()
{
    // Pastikan relasi 'hasilPeriksa' ada di model Patient
    $patients = Patient::with(['reservations.room', 'hasilPeriksa'])->get();
    return view('dashboard.admin.pasien.pasien', compact('patients'));
}

    public function searchPasien(Request $request)
{
    $name = $request->query('name');

    $patients = Patient::with(['reservations.room', 'hasilPeriksa'])
        ->where('name', 'LIKE', '%' . $name . '%')
        ->get();

    if ($patients->count() > 0) {
        return response()->json([
            'patients' => $patients->map(function($patient) {
                $birthDate = $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date) : null;
                $age = $birthDate ? $birthDate->age : null;

                return [
                    'id' => $patient->id,
                    'name' => $patient->name,
                    'medical_record_number' => $patient->medical_record_number,
                    'birth_date' => $patient->birth_date,
                    'age' => $age,
                    'reservations' => $patient->reservations->map(function($reservation) {
                        return [
                            'id' => $reservation->id,
                            'room_type' => $reservation->room->type ?? null,
                            'reservation_date' => $reservation->reservation_date,
                            'payment_method' => $reservation->payment_method,
                        ];
                    }),
                    'hasilPeriksa' => $patient->hasilPeriksa ? [
                        'diagnosa' => $patient->hasilPeriksa->diagnosa,
                        'jenis_rawat' => $patient->hasilPeriksa->jenis_rawat,
                        'resep' => $patient->hasilPeriksa->resep,
                    ] : null,
                ];
            }),
        ]);
    }
    return response()->json(['patients' => []]);
}
public function getResep($id)
{
    $patient = Patient::with('hasilPeriksa')->find($id);

    if (!$patient) {
        return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
    }

    return response()->json([
        'name' => $patient->name,
        'hasilPeriksa' => $patient->hasilPeriksa ? [
            'diagnosa' => $patient->hasilPeriksa->diagnosa,
            'jenis_rawat' => $patient->hasilPeriksa->jenis_rawat,
            'resep' => $patient->hasilPeriksa->resep,
        ] : null,
    ]);
}
public function lihatKritikSaran()
{
    $kritikList = KritikSaran::latest()->get();

    return view('dashboard.admin.kritik', compact('kritikList'));
}


    
}

