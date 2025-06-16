<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.user.profile');
    }

    public function riwayatKunjungan()
    {
        return view('dashboard.user.riwayatkunjungan'); // nanti buat view ini juga
    }

    public function ubahPassword()
    {
        return view('ubah_password'); // nanti buat view ini juga
    }

    public function pengaturanNotif()
    {
        return view('dashboard.user.pengaturannotif');
    }

    public function pengaturanPrivasi()
    {
        return view('dashboard.user.pengaturanprivasi');
    }

    public function kritikSaran()
    {
        return view('kritik_saran');
    }

    public function logout()
    {
        // Log out logic
        auth()->logout();
        return redirect('/login');
    }
}
