<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPeriksa extends Model
{
    protected $table = 'hasil_periksas'; 

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'jenis_rawat',
        'diagnosa',
        'resep',
    ];
    // Relasi ke Patient (satu hasil periksa milik satu pasien)
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    
}
