<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Reservasi;
use App\Models\Patient;
use Illuminate\Http\Request;


class ReservasiApiController extends Controller
{
    // GET semua kamar yang tersedia
    public function listRooms()
    {
        $rooms = Room::all();
        return response()->json(['rooms' => $rooms]);
    }

    // GET receipt berdasarkan ID reservasi
    public function receipt($id)
    {
        $reservation = Reservasi::with(['room', 'patient'])->find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservasi tidak ditemukan'], 404);
        }

        return response()->json([
            'reservation' => $reservation,
            'room' => $reservation->room,
            'patient' => $reservation->patient,
        ]);
    }

    // POST buat reservasi baru
    public function store(Request $request)
{
    $validated = $request->validate([
        'room_id' => 'required|exists:rooms,id',
        'reservation_date' => 'required|date',
        'payment_method' => 'required|in:mandiri,asuransi,bpjs',
        'insurance_number' => 'nullable|string|max:255',
        'patient_name' => 'required|string|max:255',
        'patient_age' => 'nullable|numeric',
        'patient_gender' => 'nullable|in:male,female,other',
        'patient_birth_date' => 'nullable|date',
        'user_id' => 'nullable|exists:users,id'  // tambahkan ini
    ]);

    $patient = Patient::firstOrCreate(
        ['name' => $validated['patient_name']],
        [
            'age' => $validated['patient_age'] ?? null,
            'gender' => $validated['patient_gender'] ?? null,
            'birth_date' => $validated['patient_birth_date'] ?? null,
        ]
    );

    $reservation = new Reservasi();

    // Gunakan ID user dari login jika ada, jika tidak ambil dari request, kalau tetap kosong → null
    $reservation->user_id = auth()->id() ?? $request->input('user_id');

    $reservation->patient_id = $patient->id;
    $reservation->room_id = $validated['room_id'];
    $reservation->reservation_date = $validated['reservation_date'];
    $reservation->payment_method = $validated['payment_method'];

    if ($validated['payment_method'] === 'asuransi') {
        $reservation->insurance_number = $validated['insurance_number'];
    }

    $reservation->save();

    return response()->json([
        'message' => 'Reservasi berhasil disimpan',
        'reservation_id' => $reservation->id,
        'patient_id' => $patient->id
    ]);
}



    // GET pencarian pasien berdasarkan nama
    public function searchPatient(Request $request)
    {
        $name = $request->query('name');
        $patients = Patient::where('name', 'LIKE', '%' . $name . '%')->get();

        return response()->json([
            'patients' => $patients->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'medical_record_number' => $p->medical_record_number,
                ];
            })
        ]);
    }
}
