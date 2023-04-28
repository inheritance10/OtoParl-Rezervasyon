<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CarParkPlace;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //saatlik rezervasyonları getir
    public function getHourReservations()
    {
        $data = Reservation::with('users')->with('car_park_places')->where('type', 1)->orderBy('created_at', 'desc')->get();

        return view('backend.reservations.hourReservations')
            ->with('data', $data);
    }

    //günlük rezervasyonların ekranı getiriliyor
    public function getDateReservations()
    {
        $data = Reservation::with('users')->with('car_park_places')->where('type', 2)->orderBy('created_at', 'desc')->get();
        return view('backend.reservations.dateReservations')->with('data', $data);
    }

    //abone yerlerin bilgisi getiriliyor
    public function getSubscribReservations()
    {
        $data = Reservation::with('users')->with('car_park_places')->where('type', 3)->orderBy('created_at', 'desc')->get();
        return view('backend.reservations.subscribReservation')->with('data', $data);
    }

    //Rezervasyon tamamla.Araçların çıkışı yapılır
    public function reservationFinish($id)
    {
        $data = Reservation::findOrFail($id);

        $data->delete();

        return redirect()->back();
    }
}
