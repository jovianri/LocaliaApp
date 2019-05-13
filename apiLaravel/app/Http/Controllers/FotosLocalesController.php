<?php

namespace App\Http\Controllers;

use response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FotosLocales;

class FotosLocalesController extends Controller
{
    public function index()
    {
        $fotosLocales = FotosLocales::all();
        return $fotosLocales;
    }

    public function store(Request $request)
    {
        $codigoEstado = 401;

        $fotoLocal = new FotosLocales();
        $fotoLocal->idLocal = e($request->idLocal);
        $fotoLocal->nombreImg = e($request->nombreImg);

        if($fotoLocal->save()){
            $codigoEstado = 201;
        }

        return response($fotoLocal,$codigoEstado);
    }

    public function show($id)
    {
        $codigoEstado = 404;
        $fotoLocal = FotosLocales::find($id);
        if($fotoLocal != null)
            $codigoEstado = 200;
        return response($fotoLocal,$codigoEstado);
    }

    public function update(Request $request, $id)
    {

        try{
            $codigoEstado = 404;

            $fotoLocal = FotosLocales::find($id);
    
            if($fotoLocal != null){
                if($fotoLocal->update($request->all()))
                    $codigoEstado = 200;
            }

            return response($fotoLocal,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
 
    }

    public function destroy($id)
    {
        try{
            $codigoEstado = 404;
    
            $fotoLocal = FotosLocales::find($id);
            
            if($fotoLocal!=null){
                if($fotoLocal->delete())
                    $codigoEstado = 200;
            }
            return response($fotoLocal,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
    }
}
