<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CarPark;
use App\Models\CarParkPlace;
use Exception;
use Illuminate\Http\Request;

class CarParkController extends Controller
{
    //otopark kayıtlarını listeler
    public function index()
    {
        $data = CarPark::orderBy('created_at', 'desc')->get();
        return view('backend.carpark.index')->with('data', $data);
    }

    public function add()
    {
        return view('backend.carpark.add');
    }

    public function edit($id)
    {
        $data = CarPark::findOrFail($id);
        return view('backend.carpark.edit')->with('data', $data);
    }

    public function update(Request $request)
    {
        try {
            $data = CarPark::where('id', $request->id)->first();
            $data->name = $request->post('name');
            $data->floor_count = $request->post('floor_count');
            $data->park_count = $request->post('park_count');
            $update = $data->save();

            if($update){
                return response()->json([
                    'status' => 1,
                    'message' => 'Güncelleme Başarılı'
                ]);
            }else{
                return response()->json([
                    'status' => 2,
                    'message' => 'Güncelleme Başarısız'
                ]);
            }

        }catch (Exception $e){
            return response()->json([
                'status' => 0,
                'message' => $e.getMessage()
            ]);
        }
    }

    //otopark kaydetme fonksiyonu
    public function store(Request $request)
    {
        try {
            $save = CarPark::create([
                'name' => $request->post('name'),
                'floor_count' => $request->post('floor_count'),
                'park_count' => $request->post('park_count')
            ]);

            if($save){
               $this->createParkPlace($save->id,$request->post('floor_count'),$request->post('park_count'));

                return response()->json([
                    'status' => 1,
                    'message' => 'Kayıt Başarılı'
                ]);
            }else{
                return response()->json([
                    'status' => 2,
                    'message' => 'Kayıt Başarısız'
                ]);
            }

        }catch (Exception $e){
            return response()->json([
                'status' => 0,
                'message' => $e.getMessage()
            ]);
        }
    }

    //otopark kaydı silme fonksiyonu
    public function delete(Request $request)
    {
        try {
            $data = CarPark::findOrFail($request->get('id'));
            $delete = $data->delete();
            if($delete){
                return response()->json([
                    'status' => 1,
                    'message' => 'Silme işlemi Başarılı'
                ]);
            }else{
                return response()->json([
                    'status' => 2,
                    'message' => 'Silme işlemi Başarısız'
                ]);
            }

        }catch (Exception $e){
            return response()->json([
                'status' => 0,
                'message' => $e.getMessage()
            ]);
        }
    }

    //kat sayısına ve girilen park yeri sayısına göre her katta ki park yeri isimlendirmesini ve tabloya kaydetme fonksiyonu
    public function createParkPlace($id,$floor_count, $park_count)
    {
        $arr = array('A', 'B', 'C', 'D', 'E', 'F', 'G','H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        for($i = 1; $i<=$floor_count; $i++){
            for($k = 1; $k<=$park_count; $k++){
                $data = CarParkPlace::create([
                   'carpark_id' => $id,
                    'name' => $arr[$i-1].''.$k,
                    'floor' => $i
                ]);
            }
        }
    }

}
