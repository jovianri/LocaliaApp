<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use response;
use App\Imagenes;

class ImagenesController extends Controller
{
    public function index()
    {
        return Imagenes::all();
    }

    public function store(Request $request)
    {
        $codigoEstado = 401;

        $imagen = new Imagenes();
        $imagen->nombre = e($request->nombre);

        if($imagen->save()){
            $codigoEstado = 201;
        }

        return response($imagen,$codigoEstado);
    }

    public function show($id)
    {
        $codigoEstado = 404;
        $imagen = Imagenes::find($id);
        if($imagen != null)
            $codigoEstado = 200;
        return response($imagen,$codigoEstado);
    }

    public function update(Request $request, $id)
    {

        try{
            $codigoEstado = 404;

            $imagen = Imagenes::find($id);
    
            if($imagen != null){
                if($imagen->update($request->all()))
                    $codigoEstado = 200;
            }

            return response($imagen,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
 
    }

    public function destroy($id)
    {
        try{
            $codigoEstado = 404;
    
            $imagen = Imagenes::find($id);
            
            if($imagen!=null){
                if($imagen->delete())
                    $codigoEstado = 200;
            }
            return response($imagen,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
    }
}
