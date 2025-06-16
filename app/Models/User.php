<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Penting untuk otentikasi API

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * Atribut (kolom) yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email', // Pastikan email sudah ditambahkan ke tabel users melalui migrasi
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Atribut yang akan disembunyikan saat data dikirim sebagai JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     * Mengubah tipe data secara otomatis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Otomatis hash password saat disimpan
        ];
    }

    /**
     * Mendefinisikan relasi "one-to-one" ke model Patient.
     * Satu User memiliki satu data pasien.
     */
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * Mendefinisikan relasi "one-to-one" ke model Doctor.
     * Satu User bisa jadi adalah seorang dokter.
     */
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    /**
     * Mendefinisikan relasi "one-to-one" ke model Profile.
     * Satu User memiliki satu profile.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
