<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservasi;
use App\Models\Patient;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    // Menampilkan pilihan kamar
    public function index()
    {
        $rooms = Room::all();
        return view('dashboard.reservasi.tampilan', compact('rooms'));
    }

    // Menampilkan receipt setelah reservasi dibuat
    public function receipt($id)
    {   

        $reservation = Reservasi::with(['room', 'patient'])->findOrFail($id);
        $room = $reservation->room;
        $patient = $reservation->patient;

        return view('dashboard.reservasi.receipt', compact('reservation', 'room', 'patient'));
    }



    // Menampilkan form reservasi untuk memilih kamar
    public function create($roomId)
    {
        $room = Room::findOrFail($roomId);
        return view('dashboard.reservasi.create', compact('room'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'reservation_date' => 'required|date',
            'payment_method' => 'required|in:mandiri,asuransi,bpjs',
            'insurance_number' => 'nullable|string|max:255',
            'patient_name' => 'required|string|max:255',
            'patient_age' => 'nullable|numeric',
            'patient_gender' => 'nullable|in:male,female,other',
            'patient_birth_date' => 'nullable|date',
        ]);

        // Cari atau buat pasien berdasarkan nama
        $patient = Patient::firstOrCreate(
            ['name' => $validated['patient_name']], // cari berdasarkan nama pasien
            [
                'age' => $validated['patient_age'] ?? null,
                'gender' => $validated['patient_gender'] ?? null,
                'birth_date' => $validated['patient_birth_date'] ?? null,
            ]
        );

        // Mendapatkan informasi kamar yang dipilih
        $room = Room::findOrFail($validated['room_id']);

        // Menyimpan data reservasi
        $reservation = new Reservasi();
        $reservation->user_id = auth()->id();
        $reservation->patient_id = $patient->id; // Simpan id pasien
        $reservation->room_id = $validated['room_id'];
        $reservation->reservation_date = $validated['reservation_date'];
        $reservation->payment_method = $validated['payment_method'];

        // Jika metode pembayaran adalah asuransi, simpan nomor asuransi
        if ($validated['payment_method'] == 'asuransi') {
            $reservation->insurance_number = $validated['insurance_number'];
        }

        // Simpan data reservasi
        $reservation->save();

        // Redirect ke halaman receipt
        return redirect()->route('reservasi.receipt', ['id' => $reservation->id]);
    }

    // Fungsi untuk mencari pasien
    public function searchPatient(Request $request)
    {
      
        $name = $request->query('name');

        $patient = Patient::where('name', 'LIKE', '%' . $name . '%')->first();
        // Mengembalikan hasil pencarian dalam bentuk JSON
        return response()->json($patients);
    }
}
