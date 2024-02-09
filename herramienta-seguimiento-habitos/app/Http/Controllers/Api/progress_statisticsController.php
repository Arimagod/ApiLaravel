<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\progress_statistics;

class progress_statisticsController extends Controller
{
    public function list(){
        $progress_Statistic = progress_statistics::all();
        $list = [];
        foreach($progress_Statistic as $progress_statistics){
            $object = [
                "id" => $progress_statistics->id,
                "user_id" => $progress_statistics->user_id,                
                "created_at" => $progress_statistics->Created_at,
                "updated_at" => $progress_statistics->Updated_at,
            ];
            
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id){
            $progress_Statistic = progress_statistics::where('id', '=', $id)->first();
                $object = [
                    "id" => $progress_Statistic->id,
                    "user_id" => $progress_Statistic->user_id,                
                    "created_at" => $progress_Statistic->Created_at,
                    "updated_at" => $progress_Statistic->Updated_at,
                ];
            return response()->json($object);

    }

    public function create (Request $request){
        $data = $request->validate([
            "date_hour" => "required",
            "user_id" => "required|numeric",      
                
        
        ]);

        $staticProgress = progress_statistics::create([
            "date_hour" => $data["date_hour"], 
            "user_id" => $data["user_id"],          
        ]);

        if($staticProgress){
            return response()->json([
                "message" => "Progreso de estadistica creado correctamente",
                "data" => $staticProgress
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
            "date_hour" => "required",
            "user_id" => "required|numeric", 

            //"user_id" => "required|numeric",           
        ]);
        $progress_Statistic = progress_statistics::where('id', '=', $data["id"])->first();


        if($progress_Statistic){

            $old = $progress_Statistic ->replicate();


            $progress_Statistic->date_hour = $data["date_hour"];
            $progress_Statistic->user_id = $data["user_id"];

            if($progress_Statistic->save()){
                return response()->json([
                    "message" => "Correctamente modificado",
                    "old" => $old,
                    "new" => $progress_Statistic
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
