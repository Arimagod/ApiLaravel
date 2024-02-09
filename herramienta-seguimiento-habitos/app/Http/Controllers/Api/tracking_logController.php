<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tracking_log;

class tracking_logController extends Controller
{
    public function list(){
        $trackingLogs = Tracking_log::all();
        $list = [];
        foreach($trackingLogs as $Tracking_log){
            $object = [
                "id" => $Tracking_log->id,
                "user_id" => $Tracking_log->user_id,  
                "registration_date" => $Tracking_log->registration_date, 
                "habit_state" => $Tracking_log->habit_state, 
                "created_at" => $Tracking_log->Created_at,
                "updated_at" => $Tracking_log->Updated_at,
            ];
            
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id){
            $trackingLog = Tracking_log::where('id', '=', $id)->first();
                $object = [
                    "id" => $trackingLog->id,
                    "user_id" => $trackingLog->user_id,  
                    "registration_date" => $trackingLog->registration_date, 
                    "habit_state" => $trackingLog->habit_state, 
                    "created_at" => $trackingLog->Created_at,
                    "updated_at" => $trackingLog->Updated_at,
                ];
            return response()->json($object);

    }

    public function create (Request $request){
        $data = $request->validate([
            "registration_date" => "required", 
            "habit_state" => "required",  
            "user_id" => "required|numeric",      
        ]);

        $tracking = Tracking_log::create([
            "registration_date" => $data["registration_date"], 
            "habit_state" => $data["habit_state"],   
            "user_id" => $data["user_id"],       
        ]);

        if($tracking){
            return response()->json([
                "message" => "Progreso de estadistica creado correctamente",
                "data" => $tracking
            ]);
        }else{
            return response()->json([
                "message" => "Intenta mas tarde"
            ]);
        }

    }
    public function update(Request $request){
        $data = $request->validate([
            "id" => "required|numeric", 
            "registration_date" => "required",
            "habit_state" => "required",
            "user_id" => "required|numeric", 
 

        ]);
        $tracking = Tracking_log::where('id', '=', $data["id"])->first();


        if($tracking){

            $old = clone $tracking;


            $tracking->registration_date = $data["registration_date"];
            $tracking->habit_state = $data["habit_state"];
            $tracking->user_id = $data["user_id"];

            if($tracking->save()){
                return response()->json([
                    "message" => "Correctamente modificado",
                    "old" => $old,
                    "new" => $tracking
                ]);
            }
            else{
                return response()->json([
                    "message" => "Error al modificar",
                    
                ]);
            }
        }
        else{
            return response()->json([
                "message" => "Elemento no encontrado",
                
            ]);

    } }
}
