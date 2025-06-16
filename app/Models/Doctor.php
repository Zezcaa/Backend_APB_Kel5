<?php

// app/Models/Doctor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'speciality',
        'photo_path',
        'clinic_id',
        'user_id', 
    ];

    public function clinic() {
        return $this->belongsTo(Clinic::class);  // Relasi BelongsTo ke model Clinic
    }
    public function schedules() {
        return $this->hasMany(Schedule::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

}

