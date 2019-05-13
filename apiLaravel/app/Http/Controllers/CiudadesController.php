<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use response;
use App\Http\Controllers\Controller;
use App\Ciudades;

class CiudadesController extends Controller
{
    public function index()
    {
        $ciudades = Ciudades::all();
        return $ciudades;
    }

    public function store(Request $request)
    {
        $codigoEstado = 401;

        $ciudad = new Ciudades();
        $ciudad->nombre = e($request->nombre);

        if($ciudad->save()){
            $codigoEstado = 201;
        }

        return response($ciudad,$codigoEstado);
    }

    public function show($id)
    {
        $codigoEstado = 404;
        $ciudad = Ciudades::find($id);
        if($ciudad != null)
            $codigoEstado = 200;
        return response($ciudad,$codigoEstado);
    }

    public function update(Request $request, $id)
    {

        try{
            $codigoEstado = 404;

            $ciudad = Ciudades::find($id);
    
            if($ciudad != null){
                if($ciudad->update($request->all()))
                    $codigoEstado = 200;
            }

            return response($ciudad,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
 
    }

    public function destroy($id)
    {
        try{
            $codigoEstado = 404;
    
            $ciudad = Ciudades::find($id);
            
            if($ciudad!=null){
                if($ciudad->delete())
                    $codigoEstado = 200;
            }
            return response($ciudad,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
    }
}
