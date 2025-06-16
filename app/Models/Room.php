<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',        // Tipe kamar (Standard, VIP, Suite)
        'description', // Deskripsi kamar
        'photo_path',       // Nama file gambar untuk kamar
    ];

    /**
     * Relasi ke tabel reservations
     * Satu kamar bisa memiliki banyak reservasi
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
