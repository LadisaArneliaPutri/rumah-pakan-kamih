<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LadisaBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id', 'user_id', 'room_id', 'checkin', 'checkout', 'status'
    ];

    public function visitor()
    {
        return $this->belongsTo(LadisaVisitor::class, 'visitor_id');
    }

    public function room()
    {
        return $this->belongsTo(LadisaRoom::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
