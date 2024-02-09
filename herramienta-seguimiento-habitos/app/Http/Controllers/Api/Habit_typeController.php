<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habit_type;


class Habit_typeController extends Controller
{
    public function list(){
        $habit_types = Habit_type::all();
        $list = [];
        foreach($habit_types as $habit_type){
            $object = [
                "id" => $habit_type->id,
                "type" => $habit_type->type,
                "created_at" => $habit_type->Created_at,
                "updated_at" => $habit_type->Updated_at,
            ];
            
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id){
            $habit_type = Habit_type::where('id', '=', $id)->first();
                $object = [
                    "id" => $habit_type->id,
                    "type" => $habit_type->type,
                    "created_at" => $habit_type->Created_at,
                    "updated_at" => $habit_type->Updated_at,
                ];
            return response()->json($object);

    }

    public function create (Request $request){
        $data = $request->validate([
            "type" => "required",            
        ]);

        $habit_type = Habit_type::create([
            "type" => $data["type"],
        ]);

        if($habit_type){
            return response()->json([
                "message" => "Tipo de Habito creado correctamente",
                "data" => $habit_type
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
            "type" => "required",            
        ]);
        $habit_type = Habit_type::where('id', '=', $data["id"])->first();


        if($habit_type){

            $old = clone $habit_type ;


            $habit_type->type = $data["type"];

            if($habit_type->save()){
                return response()->json([
                    "message" => "Correctamente modificado",
                    "old" => $old,
                    "new" => $habit_type
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
