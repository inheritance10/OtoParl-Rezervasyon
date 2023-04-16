<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CarPark;
use App\Models\CarParkPlace;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $floor = CarPark::all();

        return view('frontend.layout')->with('floor', $floor);
    }

    public function getParkPlace(Request $request,$id,$floor)
    {
        if($request->has('date') && $request->has('start_hour') && $request->has('end_hour')){
            $date =  Carbon::parse($request->date)->format('Y-m-d');
            $start_hour =  $request->start_hour;
            $end_hour = $request->end_hour;
        }else{
            $end_hour = "";
            $date =   Carbon::now()->format('Y-m-d');
            $start_hour =   Carbon::now()->hour;
        }


        $notAvailable = [];
        $available = [];
        $parkPlace = CarParkPlace::where('carpark_id', $id)->where('floor', $floor)->get();

        foreach ($parkPlace as $data){
            $isReservation = Reservation::where('park_place_id', $data->id)->whereDate('date', $date)
            ->where(function ($query) use ($start_hour,$end_hour){
                $query->whereBetween('start_hour', [$start_hour,$end_hour]);
            })->exists();

            if($isReservation){
                $notAvailable[] = [
                    'id' => $data->id,
                  'name' => $data->name
                ];
            }else{
                $available[] = [
                    'id' => $data->id,
                  'name' => $data->name
                ];
            }
        }



        return view('frontend.home.parkPlace')->with('notAvailable', $notAvailable)
            ->with('available', $available)
            ->with('id', $id)
            ->with('floor', $floor)
            ->with('date',$date)
            ->with('start_hour', $start_hour)
            ->with('end_hour', $end_hour);
    }

    public function reservation($id,$date)
    {
        return view('frontend.home.reservation')
            ->with('id' , $id)
            ->with('date', $date);
    }

    public function dateQuery()
    {
        return view('frontend.home.reservation');
    }

    public function hourReservationConfirm(Request $request)
    {
        try {
            $save = Reservation::create([
               'user_id' => Auth::user()->id,
                'park_place_id' => $request->post('id'),
                'price' => $request->post('price'),
                'date' => $request->post('date'),
                'end_hour' => $request->post('end_hour'),
                'start_hour' => $request->post('start_hour'),
                'type' => $request->post('type')
            ]);
            if ($save){
                return response()->json([
                    'status' => 1,
                    'message' => 'Rezervasyon Kaydınız Başarılı'
                ]);
            }else {
                return response()->json([
                    'status' => 2,
                    'message' => 'Rezervasyon Kaydınız Tamamlanamdı'
                ]);
            }
        }catch (Exception $e){
            return response()->json([
                'status' => 0,
                'message' => $e.getMessage()
            ]);
        }

    }

    public function dateReservationConfirm(Request $request)
    {
        try {
            $save = Reservation::create([
                'user_id' => Auth::user()->id,
                'park_place_id' => $request->post('id'),
                'price' => $request->post('price'),
                'end_date' => $request->post('end_date'),
                'start_date' => $request->post('start_date'),
                'type' => $request->post('type')
            ]);
            if ($save){
                return response()->json([
                    'status' => 1,
                    'message' => 'Rezervasyon Kaydınız Başarılı'
                ]);
            }else {
                return response()->json([
                    'status' => 2,
                    'message' => 'Rezervasyon Kaydınız Tamamlanamdı'
                ]);
            }
        }catch (Exception $e){
            return response()->json([
                'status' => 0,
                'message' => $e.getMessage()
            ]);
        }
    }
}
