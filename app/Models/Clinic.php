<?php

// app/Models/Clinic.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $table = 'clinics';

    protected $fillable = [
        'name',
    ];

    // Relasi klinik dengan dokter (satu klinik bisa memiliki banyak dokter)
    public function doctors()
    {
        return $this->hasMany(Doctor::class);  // Relasi HasMany ke model Doctor
    }
}

