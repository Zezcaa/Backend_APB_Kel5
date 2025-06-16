<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Norekams extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_rekam',
        'pasien_id',
        'dokter_id',
        'Diagnosa',
    ];

    // Relasi ke pasien (satu norekam milik satu pasien)
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    // Relasi ke dokter (satu norekam milik satu dokter)
    public function dokter()
    {
        return $this->belongsTo(Doctor::class);
    }
}
