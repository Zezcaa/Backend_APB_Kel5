<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'profiles';

    // Tentukan kolom yang bisa diisi
    protected $fillable = ['user_id', 'full_name', 'address', 'birthdate'];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
