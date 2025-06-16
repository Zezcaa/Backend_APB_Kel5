<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Clinic;
use App\Models\Schedule;  
class jadwalController extends Controller
{
   
    public function index()
    {
        $doctors = Doctor::with('clinic', 'schedules')->get();  
        $clinics = Clinic::all();  

        return view('jadwaldokter.jadwal', compact('doctors', 'clinics'));  
    }

    public function showDoctor($id)
    {
        $doctor = Doctor::with('clinic', 'schedules')->findOrFail($id);  
        return response()->json($doctor); 
    }

   
    public function showClinic($id)
    {
        $clinic = Clinic::with('doctors.schedules')->find($id);  
        if (!$clinic) {
            return response()->json(['message' => 'Clinic not found'], 404);  
        }
        return response()->json($clinic);  
    }
}
