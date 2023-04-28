<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CarPark;
use App\Models\CarParkPlace;
use App\Models\Reservation;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $floor = CarPark::all();

        return view('frontend.layout')->with('floor', $floor);
    }

    //Park yerlerini doluluk ve müsaitlik olarak gelen sorguya göre listeliyoruz
    //type = 1 saatlik rezervasyon
    //type = 2 günlük rezervasyon
    //type = 3 abonman
    public function getParkPlace(Request $request,$id,$floor)
    {
        if($request->has('date') && $request->has('start_hour') && $request->has('end_hour')){
            $date =  Carbon::parse($request->date)->format('Y-m-d');
            $start_hour =  $request->start_hour;
            $end_hour = $request->end_hour;
        }else{
            $end_hour = "";
            $date =   Carbon::now()->format('Y-m-d');
            $start_hour = Carbon::now()->hour;
        }

        $notAvailable = [];
        $available = [];

        $parkPlace = CarParkPlace::with('reservation')->where('carpark_id', $id)->where('floor', $floor)->get();

        foreach ($parkPlace as $data){
            $isReservation = Reservation::where('park_place_id', $data->id)->whereDate('date', $date)
            ->where(function ($query) use ($start_hour,$end_hour){
                $query->whereBetween('start_hour', [$start_hour,$end_hour]);
            })->get();

            $isSubscrib = Reservation::where('park_place_id', $data->id)->where('type', 3)->get();

            if(count($isReservation) > 0 || count($isSubscrib) > 0){
                $notAvailable[] = [
                    'id' => $data->id,
                    'name' => $data->name,
                    'table' => $isReservation,
                    'isSubscrib' => $isSubscrib
                ];
            }else{
                $available[] = [
                    'id' => $data->id,
                  'name' => $data->name,
                    ''
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
        $reservation = Reservation::where('park_place_id', $id)->where('start_date', '>=' , Carbon::now()->format('Y-d-m'))->get();
        $carParkPlace = CarParkPlace::where('id', $id)->first();
        return view('frontend.home.reservation')
            ->with('id' , $id)
            ->with('date', $date)
            ->with('carParkPlace', $carParkPlace)
            ->with('reservation', $reservation);
    }

    //saatlik rezervasyon için onaylama fonksiyonu
    public function hourReservationConfirm(Request $request)
    {
        try {
            while (true){
                $pnr = $this->ticket_number();
                $isPnrSame = Reservation::where('pnr_code', $pnr)->exists();
                if(!$isPnrSame){
                    break;
                }
            }
            $save = Reservation::create([
               'user_id' => Auth::user()->id,
                'park_place_id' => $request->post('id'),
                'price' => $request->post('price'),
                'date' => $request->post('date'),
                'end_hour' => $request->post('endHour'),
                'start_hour' => $request->post('startHour'),
                'pnr_code' =>$pnr,
                'type' => $request->post('type'),
                'status' => 1
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
                'message' => $e. $this->getMessage()
            ]);
        }

    }

    //günlük rezervasyon onaylama için çalışan fonksiyonu
    public function dateReservationConfirm(Request $request)
    {
        try {
            while (true){
                $pnr = $this->ticket_number();
                $isPnrSame = Reservation::where('pnr_code', $pnr)->exists();
                if(!$isPnrSame){
                    break;
                }
            }
            $save = Reservation::create([
                'user_id' => Auth::user()->id,
                'park_place_id' => $request->post('id'),
                'price' => $request->post('price'),
                'end_date' => $request->post('endDate'),
                'start_date' => $request->post('startDate'),
                'pnr_code' =>$pnr,
                'type' => $request->post('type'),
                'status' => 1
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

    //abonman rezervasyon onaylama için çalışan fonksiyonu
    public function subscribReservationConfirm(Request $request)
    {
        try {

            while (true){
                $pnr = $this->ticket_number();
                $isPnrSame = Reservation::where('pnr_code', $pnr)->exists();
                if(!$isPnrSame){
                    break;
                }
            }

            $save = Reservation::create([
                'user_id' => Auth::user()->id,
                'park_place_id' => $request->post('id'),
                'price' => $request->post('price'),
                'end_date' => Carbon::now()->addDay(30)->format('Y-m-d'),
                'start_date' => Carbon::now()->format('Y-m-d'),
                'pnr_code' =>$pnr,
                'type' => $request->post('type'),
                'status' => 1
            ]);

            if ($save){
                return response()->json([
                    'status' => 1,
                    'message' => '1 Aylık Abonman Kaydınız Başarılı'
                ]);
            }else {
                return response()->json([
                    'status' => 2,
                    'message' => 'Abonman Kaydınız Tamamlanamadı'
                ]);
            }

        }catch (Exception $e){
            return response()->json([
                'status' => 0,
                'message' => $e.getMessage()
            ]);
        }
    }

    //hesabım kısmına rezervasyonlarım çekildi
    public function account()
    {
        $reservation = Reservation::with('car_park_places')->where('user_id', Auth::user()->id)
            ->where('start_date', '>=' , Carbon::now()->format('Y-d-m'))->get();

        return view('frontend.home.account')->with('reservation', $reservation);
    }

    function ticket_number()
    {
        $number = random_int(1000000, 9999999);

        return $number;
    }

    private function getMessage()
    {
        return 'Hata';
    }
}
