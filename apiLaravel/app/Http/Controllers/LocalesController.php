<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Locales;


class LocalesController extends Controller
{
    public function index()
    {

        $locales = DB::table('locales')->
                   join('locales_fotos','locales.id','=','locales_fotos.idLocal','inner',false)->
                   join('ciudades','locales.idCiudad','=','ciudades.id','inner',false)->
                   groupBy('locales.id')->
                   orderBy('locales.id','asc')->
                   select('locales.*','locales_fotos.nombreImg','ciudades.nombre AS ciudad')->
                   get();
        return $locales;
    }

    
    function getLocal($id){
        $codigoEstado = 404;
        $local = Locales::find($id);
        if($local != null)
            $codigoEstado = 200;
        return response($local,$codigoEstado);
    }
    
    function getByCiudad($ciudad){
        $codigoEstado = 404;
        $locales = DB::table('locales')->
        join('locales_fotos','locales.id','=','locales_fotos.idLocal','inner',false)->
        join('ciudades','locales.idCiudad','=','ciudades.id','inner',false)->
        where('ciudades.nombre','=',e($ciudad))->
        groupBy('locales.id')->
        orderBy('locales.id','asc')->
        select('locales.*','locales_fotos.nombreImg','ciudades.nombre AS ciudad')->
        get();
        if(count($locales) > 0)
        $codigoEstado = 200;
        return response($locales,$codigoEstado);
        
    }
    
    function getByCategoria($categoria){
        $codigoEstado = 404;
        $locales = DB::table('locales')->
        join('locales_fotos','locales.id','=','locales_fotos.idLocal','inner',false)->
        join('ciudades','locales.idCiudad','=','ciudades.id','inner',false)->
        where('locales.idCategoria','=',e($categoria))->
        groupBy('locales.id')->
        orderBy('locales.id','asc')->
        select('locales.*','locales_fotos.nombreImg','ciudades.nombre AS ciudad')->
        get();
        if(count($locales) > 0)
        $codigoEstado = 200;
        return response($locales,$codigoEstado);
    }
    
    public function store(Request $request)
    {
        // XDDDDD, 1 hora pensando que no funciona pero es el getAll quien me jode la vida 
        try{
            $codigoEstado = 500;

            $local = new Locales();
    
            $local->nombre = e($request->nombre);
            $local->latitud = e($request->latitud);
            $local->longitud = e($request->longitud);
            $local->direccion = e($request->direccion);
            $local->idCategoria = intval($request->idCategoria);
            $local->idCiudad = intval($request->idCiudad);
            $local->precio = intval($request->precio);
    
            if($local->save() == true)
                $codigoEstado = 201;
            return response($local,$codigoEstado);

        }catch(Exception $e){
            return response(null,$codigoEstado);
        }

    }

    public function update(Request $request, $id)
    {

        try{
            $codigoEstado = 404;

            $local = Locales::find($id);
    
            if($local != null){
                if($local->update($request->all()))
                    $codigoEstado = 200;
            }

            return response($local,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
 
    }

    public function destroy($id)
    {
        try{
            $codigoEstado = 404;
    
            $local = Locales::find($id);
            
            if($local!=null){
                if($local->delete())
                    $codigoEstado = 200;
            }
            return response($local,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
    }
}
