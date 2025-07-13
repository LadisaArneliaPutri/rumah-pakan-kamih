<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LadisaRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', // ← ini field yang digunakan di form
        'room_type_id',
        'harga',
        'deskripsi',
        'gambar',
    ];

    public function roomType()
    {
        return $this->belongsTo(LadisaRoomType::class, 'room_type_id');
    }

    public function bookings()
    {
        return $this->hasMany(LadisaBooking::class, 'room_id');
    }
}
