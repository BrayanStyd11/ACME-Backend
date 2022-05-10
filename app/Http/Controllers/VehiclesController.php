<?php

namespace App\Http\Controllers;

use App\Models\Vehicles;
use App\Models\Roles;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicles::with('users')->get();

        /**
         * Se realiza un forEach doble para iterar los datos que llegan de la tabla vehicles para obtener
         * los datos de la tabla foranea users, para despues obtener el rol con base al campo id_rol
         */
        foreach ($vehicles as $key => $vehicle) {
            foreach ($vehicle->users as $key => $users) {
                $rol = Roles::where('id',$users->id_rol)->first();
                $users->rol = $rol->rol;
            }
        }
        return response()->json(['status'=>200,'data'=>$vehicles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = new Vehicles();
        $vehicle->create($request->all());

        return response()->json(['status'=>200,'message' =>'Vehiculo Guardado exitosamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicles $vehicles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicles::findOrFail($id);        
        $vehicle->update($request->all());

        return response()->json(['status'=>200,'message' =>'Vehiculo Actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $vehicle = Vehicles::findOrFail($id);
            $vehicle->delete();

            return response()->json(['status'=>200,'message' =>'Vehiculo Eliminado Correctamente']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>400,'message' =>'No se Puede eliminar el vehiculo, ya se encuentra asociado']);
        }        
    }
}
