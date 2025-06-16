<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\HasilPeriksa;
use App\Models\Reservasi;
use Carbon\Carbon;
use App\Models\KritikSaran;

class ProfileApiController extends Controller
{
    public function __construct()
    {
        // Set locale ke Bahasa Indonesia untuk semua tanggal
        Carbon::setLocale('id');
    }

    /**
     * Mengambil data profil dari user yang sedang login.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $profile = $user->profile;
        if (!$profile) {
            return response()->json(['message' => 'Profil tidak ditemukan untuk user ini.'], 404);
        }
 
        return response()->json([
            'data' => [
                'user_id' => $user->id,
                'full_name' => $profile->full_name,
                'birthdate' => $profile->birthdate,
                'address' => $profile->address,
            ]
        ]);
    }

    /**
     * Mengambil riwayat kunjungan dari HasilPeriksa dan Reservasi
     */
    public function riwayatKunjungan(Request $request)
    {
        $user = $request->user();

        if (!$user || !$user->patient) {
            return response()->json([]);
        }

        $patientId = $user->patient->id;

        // Riwayat dari hasil periksa (Poliklinik)
        $hasilPeriksa = collect(HasilPeriksa::with('doctor')
            ->where('patient_id', $patientId)
            ->get()
            ->map(function ($item) {
                return [
                    'tanggal' => $item->created_at->translatedFormat('d F Y'),
                    'diagnosa' => $item->diagnosa,
                    'jenis_rawat' => $item->jenis_rawat,
                    'resep' => $item->resep,
                    'nama_dokter' => $item->doctor ? $item->doctor->name : '-',
                    'sumber' => 'Poliklinik',
                ];
            }));

        // Riwayat dari reservasi kamar inap
        $reservasiInap = collect(Reservasi::with('room')
            ->where('patient_id', $patientId)
            ->get()
            ->map(function ($item) {
                return [
                    // Tambahkan key 'sort_key' untuk sorting benar
'tanggal' => $item->created_at->translatedFormat('d F Y'),
'sort_key' => $item->created_at->toDateString(), // YYYY-MM-DD

                    'diagnosa' => '-',
                    'jenis_rawat' => 'Rawat Inap',
                    'resep' => '-',
                    'nama_dokter' => '-',
                    'sumber' => 'Reservasi Kamar',
                    'kamar' => optional($item->room)->type ?? 'Kamar tidak diketahui',
                    'metode_pembayaran' => $item->payment_method ?? '-',
                ];
            }));

        // Gabungkan dan urutkan berdasarkan tanggal terbaru
        $riwayatGabungan = $hasilPeriksa
    ->merge($reservasiInap)
    ->sortByDesc('sort_key')
    ->values();


        return response()->json($riwayatGabungan);
    }
    public function ubahPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:6',
            'confirm_password' => 'required|string|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 422);
        }

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Password saat ini tidak cocok'], 401);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password berhasil diubah.']);
    }
    public function storeKritikSaran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pesan' => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
    }

    $kritik = KritikSaran::create([
        'pesan' => $request->pesan,
    ]);

    return response()->json([
        'message' => 'Terima kasih atas masukannya!',
        'data' => $kritik,
    ], 201);
    }


}
