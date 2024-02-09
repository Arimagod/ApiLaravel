<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habit;

class HabitController extends Controller
{
    public function list(){
        $habits = Habit::all();
        $list = [];
        foreach($habits as $Habit){
            $object = [
                "id" => $Habit->id,
                "name" => $Habit->name,
                "description" => $Habit->description,
                "frecuency" => $Habit->frecuency,
                "user_id" => $Habit->user_id,
                "created_at" => $Habit->Created_at,
                "updated_at" => $Habit->Updated_at,
            ];
            
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id){
            $habits = Habit::where('id', '=', $id)->first();
                $object = [
                "id" => $habits->id,
                "name" => $habits->name,
                "description" => $habits->description,
                "frecuency" => $habits->frecuency,
                "user_id" => $habits->user_id,
                "created_at" => $habits->Created_at,
                "updated_at" => $habits->Updated_at,
                ];
            return response()->json($object);

    }

    public function create (Request $request){
        $data = $request->validate([
            "name" => "required",  
            "description" => "required",  
            "frecuency" => "required",
            "user_id" => "required|numeric",          
    
        ]);

        $habit = Habit::create([
            "name" => $data["name"],
            "description" => $data["description"],
            "frecuency" => $data["frecuency"],
            "user_id" => $data["user_id"],          

        ]);

        if($habit){
            return response()->json([
                "message" => "Habito creado correctamente",
                "data" => $habit
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
            "name" => "required",  
            "description" => "required",  
            "frecuency" => "required",
            "user_id" => "required|numeric",          

        ]);
        $habit = Habit::where('id', '=', $data["id"])->first();


        if($habit){

            $old = clone $habit;


            $habit->name = $data["name"];
            $habit->description = $data["description"];
            $habit->frecuency = $data["frecuency"];
            $habit->user_id = $data["user_id"];




            if($habit->save()){
                return response()->json([
                    "message" => "Correctamente modificado",
                    "old" => $old,
                    "new" => $habit
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

      
        }  
    }
    
}
