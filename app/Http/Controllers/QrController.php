<?php

namespace App\Http\Controllers;



use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function index()
    {
        return view('frontend.QrCode.qr');
    }

    public function create()
    {
        $qrCode = new QrCode('Hello, world!');
        $data =$qrCode->create(public_path('qrcode.png'));
        return view('frontend.QrCode.qr', ['qrCodePath' => 'qrcode.png']);
    }
}
