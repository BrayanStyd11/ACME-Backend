<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\user_vehicles;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::with('rol')->with('vehicles')->get();
        return response()->json(['status'=>200, 'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->create($request->all());

        $user = User::latest('id')->first();
        /**
         * Se realiza un metodo foreach para poder guardar la cantidad de vehiculos
         * necesarios para asignarlos al respectivo usuario
         */

        $vehicles = $request->vehicles;
                
        foreach ($vehicles as $key => $vehicle) {            
            $user_vehicles = new user_vehicles();
            $user_vehicles->user_id = $user->id;
            $user_vehicles->vehicles_id = $vehicle['id'];
            $user_vehicles->save();
        } 
        
        return response()->json(['status'=>200, 'message'=>'Información salvada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        /**
         * Se realiza un metodo foreach para poder guardar la cantidad de vehiculos
         * necesarios para asignarlos al respectivo usuario, de igual forma se valida si existe el 
         * registro para evitar la duplicidad de información
         */
        $vehicles = $request->vehicles;
        try {
            foreach ($vehicles as $key => $vehicle) {                     
                $user_vehicles = user_vehicles::where('user_id',$id)->where('vehicles_id',$vehicle['id'])->first();
                if($user_vehicles === null){
                    $user_vehicles = new user_vehicles();
                    $user_vehicles->user_id = $user->id;
                    $user_vehicles->vehicles_id = $vehicle['id'];
                    $user_vehicles->save();
                }                   
            }
        } catch (\Throwable $th) {
            return response()->json(['status'=>204, 'message' => 'Información Actualizada, Registros de Vehiculo no encontrado']);    
        }        

        return response()->json(['status'=>200, 'message' => 'Información Actualizada correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
                
    }
}
