<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CarParkPlace;
use Illuminate\Http\Request;

class CarParkPlaceController extends Controller
{
    public function index()
    {
        $data = CarParkPlace::all();
        return view('backend.carpark.place')->with('data', $data);
    }
}
