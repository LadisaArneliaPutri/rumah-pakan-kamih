<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LadisaVisitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'email', 'telepon', 'alamat'
    ];

    public function bookings()
    {
        return $this->hasMany(LadisaBooking::class, 'visitor_id');
    }
}
