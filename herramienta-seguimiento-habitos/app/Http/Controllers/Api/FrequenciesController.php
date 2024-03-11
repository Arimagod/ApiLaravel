<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frequency;

class FrequenciesController extends Controller
{
    public function list(){
        $frequency = Frequency::all();
        $list = [];
        foreach($frequency as $frecuencys){
            $object = [
                "id" => $frecuencys->id,
                "frequency" => $frecuencys->frequency,  
                "created_at" => $frecuencys->Created_at,
                "updated_at" => $frecuencys->Updated_at,
            ];
            
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id){
            $frequency = Frequency::where('id', '=', $id)->first();
                $object = [
                    "id" => $frequency->id,
                    "frequency" => $frequency->frequency,  
                    "created_at" => $frequency->Created_at,
                    "updated_at" => $frequency->Updated_at,
                ];
            return response()->json($object);

    }

    public function create (Request $request){
        $data = $request->validate([
            "frequency" => "required", 
                 
        ]);

        $frequency = Frequency::create([
            "frequency" => $data["frequency"], 
                  
        ]);

        if($frequency){
            return response()->json([
                "message" => "Progreso de estadistica creado correctamente",
                "data" => $frequency
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
            "frequency" => "required",
            
 

        ]);
        $frequency = Frequency::where('id', '=', $data["id"])->first();


        if($frequency){

            $old = clone $frequency;


            $frequency->frequency = $data["frequency"];


            if($frequency->save()){
                return response()->json([
                    "message" => "Correctamente modificado",
                    "old" => $old,
                    "new" => $frequency
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
