<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 
        'pod_id', 
        'start_time', 
        'end_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pod()
    {
        return $this->belongsTo(Pod::class);
    }
}
