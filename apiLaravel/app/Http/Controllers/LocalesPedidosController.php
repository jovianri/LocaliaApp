<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\LocalesPedidos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocalesPedidosController extends Controller
{
    public function index()
    {
        $localesPedidos = LocalesPedidos::all();
        return $localesPedidos;
    }

    public function store(Request $request)
    {
        $codigoEstado = 401;

        $localInsertar = new LocalesPedidos();
        $localInsertar->cantidad = e($request->cantidad);
        $localInsertar->idLocal = e($request->idLocal);
        $localInsertar->idPedido= e($request->idPedido);

        if($localInsertar->save())
            $codigoEstado = 201;
        return response($localInsertar,$codigoEstado);
    }

    public function show($id)
    {
        $codigoEstado = 404;
        $localPedido = LocalesPedidos::find($id);
        if($localPedido != null)
            $codigoEstado = 200;
        return response($localPedido,$codigoEstado);
    }

    function getByIdPedido($idPedido){
        $codigoEstado = 404;
        $lineasPedido = DB::table('locales_pedidos')->
        where('idPedido','=',e($idPedido))->
        select('*')->
        get();
        if(count($lineasPedido) > 0)
            $codigoEstado = 200;
        return response($lineasPedido,$codigoEstado);
        
    }

    public function update(Request $request, $id)
    {

        try{
            $codigoEstado = 404;

            $localPedido = LocalesPedidos::find($id);
    
            if($localPedido != null){
                if($localPedido->update($request->all()))
                    $codigoEstado = 200;
            }

            return response($localPedido,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
 
    }

    public function destroy($id)
    {
        try{
            $codigoEstado = 404;
    
            $localPedido = LocalesPedidos::find($id);
            
            if($localPedido!=null){
                if($localPedido->delete())
                    $codigoEstado = 200;
            }
            return response($localPedido,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
    }
}
