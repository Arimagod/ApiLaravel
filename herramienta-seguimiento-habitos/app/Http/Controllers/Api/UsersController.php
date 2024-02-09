<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function list(){
        $users = User::all();
        $list = [];
        foreach($users as $user){
            $object = [
                "id" => $user->id,
                "name" => $user->name,  
                "email" => $user->email, 
                "email_verified_at" => $user->email_verified_at, 
                "password" => $user->password,
                "created_at" => $user->Created_at,
                "updated_at" => $user->Updated_at,
            ];
            
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id){
            $users = User::where('id', '=', $id)->first();
                $object = [
                    "id" => $users->id,
                    "name" => $users->name,  
                    "email" => $users->email, 
                    "email_verified_at" => $users->email_verified_at, 
                    "password" => $users->password,
                    "created_at" => $users->Created_at,
                    "updated_at" => $users->Updated_at,
                ];
            return response()->json($object);

    }

    public function create (Request $request){
        $data = $request->validate([
            "name" => "required", 
            "email" => "required",
            "password" => "required|numeric",  

        ]);

        $users = User::create([
            "name" => $data["name"], 
            "email" => $data["email"],   
            "password" => $data["password"],       
        ]);

        if($users){
            return response()->json([
                "message" => "Usuario creado correctamente",
                "data" => $users
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
            "email" => "required",
            "password" => "required", 
 

        ]);
        $users = User::where('id', '=', $data["id"])->first();


        if($users){

            $old = clone $users;


            $users->name = $data["name"];
            $users->email = $data["email"];
            $users->password = $data["password"];

            if($users->save()){
                return response()->json([
                    "message" => "Correctamente modificado",
                    "old" => $old,
                    "new" => $users
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
