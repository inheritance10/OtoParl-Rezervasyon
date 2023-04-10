<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.layout');
    }

    public function dateQuery()
    {
        return view('frontend.home.reservation');
    }
}
