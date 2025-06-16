<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Reservasi extends Model
{
    use HasFactory;
    protected $table = 'reservations';

    protected $fillable = [
        'user_id',            // ID pasien yang melakukan reservasi
        'room_id',            // ID kamar yang dipesan
        'reservation_date',   // Tanggal reservasi
        'payment_method', 
        'patient_id',    // Metode pembayaran (mandiri, asuransi, bpjs)
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function setPriceAttribute($value)
    {
        // Ambil harga dari room yang terhubung
        if ($this->room) {
            $this->attributes['price'] = $this->room->price;
        }
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }


}
