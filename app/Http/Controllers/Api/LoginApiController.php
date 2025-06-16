<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile; // 1. Pastikan Model Profile di-import

class LoginApiController extends Controller
{
    /**
     * Handle a login request for the API.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Username atau password salah'], 401);
        }

        $user = $request->user();
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token,
            'role' => $user->role,
        ]);
    }

    /**
     * Handle a registration request for the application.
     */
    public function registerPatient(Request $request)
    {
        // 2. Validasi data yang masuk dari Flutter
        $validatedData = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users,email',
            'username'      => 'required|string|max:255|unique:users,username',
            'password'      => 'required|string|min:6|confirmed',
            'date_of_birth' => 'required|date_format:Y-m-d',
        ]);

        // 3. Buat data baru di tabel 'users'
        //    PENTING: Pastikan Anda sudah menjalankan migrasi untuk menambahkan kolom 'email' ke tabel 'users'
        $user = User::create([
            'email'    => $validatedData['email'], // Email tetap disimpan di tabel users untuk login & reset password
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'role'     => 'patient', 
        ]);

        // 4. Buat data baru di tabel 'profiles' yang terhubung dengan user baru
        $user->profile()->create([
            'full_name' => $validatedData['name'],
            'address'   => $validatedData['email'], // <-- PERMINTAAN ANDA: Menyimpan email sebagai alamat
            'birthdate' => $validatedData['date_of_birth'],
        ]);

        // 5. Kirim respons sukses
        return response()->json([
            'message' => 'Registrasi pasien berhasil!',
            'user'    => $user
        ], 201); // 201 artinya 'Created'
    }

    

    /**
     * Handle a logout request for the API.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout berhasil']);
    }
}
