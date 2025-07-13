<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LadisaRoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description'
    ];

    public function rooms()
    {
        return $this->hasMany(LadisaRoom::class, 'room_type_id');
    }
}
