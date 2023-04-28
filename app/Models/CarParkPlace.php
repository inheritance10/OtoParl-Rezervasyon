<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarParkPlace extends Model
{
    use HasFactory;

    public $guarded = [];

    public function reservation()
    {
        return $this->hasMany(Reservation::class,'id','park_place_id');
    }
}
