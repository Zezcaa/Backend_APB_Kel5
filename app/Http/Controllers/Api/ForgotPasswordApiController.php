<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; // PENTING: Gunakan Mail facade
use App\Mail\PasswordResetMail;     // PENTING: Gunakan Mailable class yang baru dibuat

class ForgotPasswordApiController extends Controller
{
    /**
     * Menerima email, membuat kode reset, dan mengirimkannya via email.
     */
    public function sendResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Email tidak terdaftar.'], 404);
        }

        $user = User::where('email', $request->email)->first();
        $resetCode = rand(100000, 999999);
        
        $user->password_reset_code = $resetCode;
        $user->password_reset_expires_at = Carbon::now()->addMinutes(10);
        $user->save();
        
        // ===============================================
        // PERUBAHAN UTAMA: Kirim email sungguhan
        // Di dalam ForgotPasswordApiController.php
        try {
            // Laravel mencoba mengirim email di sini
            Mail::to($user->email)->send(new PasswordResetMail($resetCode));
        } catch (\Exception $e) {
            // Jika ada masalah apapun saat mencoba mengirim, kode ini akan dijalankan
            return response()->json(['message' => 'Gagal mengirim email, silakan coba lagi nanti.'], 500);
        }
        // ===============================================
        
        return response()->json([
            // Hapus baris 'reset_code_for_testing'
            'message' => 'Kode reset telah dikirim ke email Anda.' 
        ]);
    }

    // Fungsi verifyCode() dan resetPassword() tidak perlu diubah.
    // ... (copy-paste fungsi verifyCode dan resetPassword dari artifak sebelumnya)

    /**
     * Memverifikasi kode reset yang dimasukkan pengguna.
     */
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'code'  => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)
                    ->where('password_reset_code', $request->code)
                    ->where('password_reset_expires_at', '>', Carbon::now())
                    ->first();

        if (!$user) {
            return response()->json(['message' => 'Kode tidak valid atau telah kedaluwarsa.'], 400);
        }

        return response()->json(['message' => 'Kode berhasil diverifikasi.']);
    }

    /**
     * Mengganti password lama dengan yang baru.
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'          => 'required|email|exists:users,email',
            'code'           => 'required|numeric',
            'new_password'     => 'required|string|min:6',
            'confirm_password' => 'required|string|same:new_password',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)
                    ->where('password_reset_code', $request->code)
                    ->where('password_reset_expires_at', '>', Carbon::now())
                    ->first();

        if (!$user) {
            return response()->json(['message' => 'Kode tidak valid atau telah kedaluwarsa.'], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->password_reset_code = null;
        $user->password_reset_expires_at = null;
        $user->save();

        return response()->json(['message' => 'Password Anda telah berhasil direset. Silakan login.']);
    }
}