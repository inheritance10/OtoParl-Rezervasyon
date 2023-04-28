<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public $guarded = [];

    public function users()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function car_park_places()
    {
        return $this->belongsTo(CarParkPlace::class,'park_place_id','id');
    }
}
