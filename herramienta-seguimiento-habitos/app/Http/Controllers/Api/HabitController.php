<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habit;
use App\Models\Habit_type;
use App\Models\User;


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
                "user" => $Habit->user,
                "frequency" => $Habit->frequency,
                "status" => $Habit->status,
                "habit_type" => $Habit->habit_type,
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
                "frequency" => $habits->frequency,
                "status" => $habits->status,
                "user" => $habits->user,
                "habit_type" => $habits->habit_type,
                "created_at" => $habits->Created_at,
                "updated_at" => $habits->Updated_at,
                ];
            return response()->json($object);

    }

    public function create (Request $request){
        $data = $request->validate([
            "name" => "required",  
            "description" => "required",  
            "user_id" => "required|numeric",    
            "habit_type_id" => "required|numeric",   
            "frequency_id" => "required|numeric",
            "status_id" => "required|numeric",       
      
    
        ]);

        $habit = Habit::create([
            "name" => $data["name"],
            "description" => $data["description"],
            "user_id" => $data["user_id"],
            "habit_type_id" => $data["habit_type_id"],
            "frequency_id" => $data["frequency_id"],
            "status_id" => $data["status_id"],          

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
            "user_id" => "required|numeric",  
            "habit_type_id" => "required|numeric",
            "frequency_id" => "required|numeric",
            "status_id" => "required|numeric",


        ]);
        $habit = Habit::where('id', '=', $data["id"])->first();


        if($habit){

            $old = clone $habit;


            $habit->name = $data["name"];
            $habit->description = $data["description"];
            $habit->user_id = $data["user_id"];
            $habit->habit_type_id = $data["habit_type_id"];
            $habit->frequency_id = $data["frequency_id"];
            $habit->status_id = $data["status_id"];




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
    public function Elements($types){
        $elem = Habit_type:: where ('type', 'LIKE', "%{$types}%") -> first(); 
        $habits = Habit::where('habit_type_id', '=', $elem -> id)->get();

    
        $habitsArray = [];
        foreach ($habits as $habit) {
            $habitsArray[] = [
                "id" => $habit->id,
                "name" => $habit->name,
                "description" => $habit->description,
                "frequency_id" => $habit->frequency_id,
                "status_id" => $habit->status_id,
                "user_id" => $habit->user_id,
                "habit_type_id" => $habit->habit_type_id,
                "created_at" => $habit->created_at,
                "updated_at" => $habit->updated_at,
            ];
        }
    
        return response()->json($habitsArray);
    }
    
    public function Elements2($types){
        $elem = User:: where ('type', 'LIKE', "%{$types}%") -> first(); 
        $habits = Habit::where('user_id', '=', $elem -> id)->get();

    
        $habitsArray = [];
        foreach ($habits as $habit) {
            $habitsArray[] = [
                "id" => $habit->id,
                "name" => $habit->name,
                "description" => $habit->description,
                "frequency_id" => $habit->frequency_id,
                "status_id" => $habit->status_id,
                "user_id" => $habit->user_id,
                "habit_type_id" => $habit->habit_type_id,
                "created_at" => $habit->created_at,
                "updated_at" => $habit->updated_at,
            ];
        }
    
        return response()->json($habitsArray);
    }
    

    
     
}
