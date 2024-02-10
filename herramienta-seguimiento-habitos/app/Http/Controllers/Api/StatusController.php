<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    public function list(){
        $status = Status::all();
        $list = [];
        foreach($status as $statuses){
            $object = [
                "id" => $statuses->id,
                "status" => $statuses->status,                
                "created_at" => $statuses->Created_at,
                "updated_at" => $statuses->Updated_at,
            ];
            
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id){
            $status = Status::where('id', '=', $id)->first();
                $object = [
                    "id" => $statuses->id,
                    "status" => $statuses->status,                
                    "created_at" => $statuses->Created_at,
                    "updated_at" => $statuses->Updated_at,
                ];
            return response()->json($object);

    }

    public function create (Request $request){
        $data = $request->validate([
            "status" => "required",
                
        
        ]);

        $status = Status::create([
            "status" => $data["status"], 
        ]);

        if($status){
            return response()->json([
                "message" => "status creado correctamente",
                "data" => $status
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
            "status" => "required",

        ]);
        $status = Status::where('id', '=', $data["id"])->first();


        if($status){

            $old = $status ->replicate();

            $status->status = $data["status"];
            
            if($status->save()){
                return response()->json([
                    "message" => "Correctamente modificado",
                    "old" => $old,
                    "new" => $status
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
