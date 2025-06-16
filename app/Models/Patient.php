<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'gender',
        'birth_date',
        'medical_record_number',
        'queue_number',
        'keluhan',
        'user_id',
        'doctor_id',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function reservations()
{
    return $this->hasMany(reservasi::class);
}

public function hasilPeriksa()
{
    return $this->hasOne(HasilPeriksa::class);
}

}

