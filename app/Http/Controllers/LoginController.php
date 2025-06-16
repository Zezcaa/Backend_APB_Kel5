<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan name
        $user = User::where('username', $credentials['username'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
        // User tidak ditemukan atau password salah
            return back()->withErrors(['loginError' => 'Username atau Password salah']);
        }

        // Login user
        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'patient') {
            return redirect()->route('home');
        } elseif ($user->role == 'dokter') {
            return redirect()->route('dokter.dashboard')->with('namaDokter', $user->doctor->name ?? 'Nama tidak tersedia');
        }

        // Default fallback
        return redirect('/home');
    }

    public function registerPatient(Request $request)
    {
    $validated = $request->validate([
        'username' => 'required|string|unique:users,username',
        'password' => 'required|string|min:6|confirmed', // pastikan ada password_confirmation
    ]);
  

    User::create([
        'username' => $validated['username'],
        'password' => Hash::make($validated['password']), // hash password dari input user
        'role' => 'patient',
    ]);

    return redirect()->route('register.patient')->with('success', 'Registrasi berhasil, silakan login.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}





