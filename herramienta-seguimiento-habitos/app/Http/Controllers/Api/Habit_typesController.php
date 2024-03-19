<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habit_type;


class Habit_typesController extends Controller
{
    public function list(){
        $habit_types = Habit_type::all();
        $list = [];
        foreach($habit_types as $habit_type){
            $object = [
                "id" => $habit_type->id,
                "type" => $habit_type->type,
                "user" => $habit_type->user,
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
                    "user" => $habit_type->user,
                    "created_at" => $habit_type->Created_at,
                    "updated_at" => $habit_type->Updated_at,
                ];
            return response()->json($object);

    }

    public function create (Request $request){
        $data = $request->validate([
            "type" => "required",
            "user_id" => "required"
                     
        ]);

        $habit_type = Habit_type::create([
            "type" => $data["type"],
            "user_id" => $data["user_id"]

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
            "user_id" => "required|numeric"           
        ]);
        $habit_type = Habit_type::where('id', '=', $data["id"])->first();


        if($habit_type){

            $old = clone $habit_type ;


            $habit_type->type = $data["type"];
            $habit_type->user_id = $data["user_id"];

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
    public function search($letter){
        // Obtener los tipos de hábitos que comienzan con la letra proporcionada
        $types = Habit_type::where('type', 'LIKE', $letter . '%')->get();
        
        $typesArray = [];
        
        // Iterar sobre los tipos de hábitos encontrados
        foreach ($types as $type) {
            // Construir el array de datos para este tipo de hábito
            $typeData = [
                "id" => $type->id,
                "type" => $type->type,
                "user_id" => $type->user_id,
                "created_at" => $type->created_at,
                "updated_at" => $type->updated_at
            ];
            
            // Agregar este tipo de hábito al array de tipos
            $typesArray[] = $typeData;
        }
        
        // Devolver la respuesta JSON con los tipos de hábitos
        return response()->json($typesArray);
    }
    

}
