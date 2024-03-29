<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPark extends Model
{
    use HasFactory;

    public $guarded = [];

    public function places()
    {
        return $this->hasMany(CarParkPlace::class,'id','carpark_id');
    }
}
