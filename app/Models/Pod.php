<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pod extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'start_time',
        'end_time',
        'status'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
