<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\clinic;
use Illuminate\Http\Request;

class JadwalApiController extends Controller
{
    // GET /api/jadwal/dokter
    // public function doctors()
    // {
    //     $doctors = Doctor::select('id', 'name', 'speciality as specialty', 'photo_path as image_url')->get();

    //     return response()->json([
    //         'doctors' => $doctors,
    //     ]);
    // }

    // GET /api/jadwal/{id}
    public function getDoctorSchedule($id)
    {
        $doctor = Doctor::findOrFail($id);
        $schedule = $doctor->schedules()->select('day', 'time')->get();

        return response()->json([
            'doctor' => $doctor->name,
            'schedule' => $schedule,
        ]);
    }
    public function clinic()
{
    // $clinics = \App\Models\Clinic::select('id', 'name')->get();
    // return response()->json(['clinics' => $clinics]);

    \Log::info('Clinic route dipanggil');
    $clinics = \App\Models\Clinic::select('id', 'name')->get();
    return response()->json(['clinics' => $clinics]);


}
public function doctors()
{
    $doctors = \App\Models\Doctor::select('id', 'name', 'clinic_id', 'speciality as specialty', 'photo_path')->get();

    return response()->json([
        'doctors' => $doctors,
    ]);
}



}
