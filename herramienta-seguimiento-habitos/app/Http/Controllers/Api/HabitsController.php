<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habit;
use App\Models\Habit_type;
use App\Models\User;


class HabitsController extends Controller
{
    public function list(){
        $habits = Habit::all();
        $list = [];
        foreach($habits as $Habit){
            $object = [
                "id" => $Habit->id,
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
            "description" => "required",  
            "user_id" => "required|numeric",    
            "habit_type_id" => "required|numeric",   
            "frequency_id" => "required|numeric",
            "status_id" => "required|numeric",       
      
    
        ]);

        $habit = Habit::create([
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
            "description" => "required",  
            "user_id" => "required|numeric",  
            "habit_type_id" => "required|numeric",
            "frequency_id" => "required|numeric",
            "status_id" => "required|numeric",


        ]);
        $habit = Habit::where('id', '=', $data["id"])->first();


        if($habit){

            $old = clone $habit;


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
    public function habitUser($userId){
        $habits = Habit::where('user_id', '=', $userId)->get();
        $habitData = [];

        foreach ($habits as $habit) {
            $habitData[] = [
                "id" => $habit->id,
                "description" => $habit->description,
                "frequency" => $habit->frequency,
                "status" => $habit->status,
                "user" => $habit->user,
                "habit_type" => $habit->habit_type,
                "created_at" => $habit->Created_at,
                "updated_at" => $habit->Updated_at,
            ];
        }

        if(!$habitData){
            return response()->json([
                'message' => "Error al obtener los elementos"
            ]);
        }
        return response()->json($habitData
        );

    }
    public function TypeUser($userId){
        $HabitsSaves = Habit::where('user_id', '=', $userId)->get();
        $HabitData = [];

        foreach ($HabitsSaves as $habit) {
            $habitId = $habit->habit_type_id;
            $Habits = Habit_type::where('id', '=', $habitId)->get();

            foreach ($Habits as $habit) {
                $HabitData[] = [
                    "id" => $habit->id,
                    "type" => $habit->type,
                    "created_at" => $habit->created_at,
                    "updated_at" => $habit->updated_at,
                ];
            }
        }

        if(!$HabitData){
            return response()->json([
                'message' => "Error al obtener los elementos"
            ]);
        }
        return response()->json($HabitData);
    }
    

    
     
}
