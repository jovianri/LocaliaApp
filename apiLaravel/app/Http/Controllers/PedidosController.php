<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pedidos;

class PedidosController extends Controller
{
    
    public function index()
    {
        $pedidos = Pedidos::all();
        return $pedidos;
    }

    public function store(Request $request)
    {
        try{
            $pedido = new Pedidos();

            $pedido->idCliente = e($request->idCliente);
            $pedido->total = e($request->total);
    
            $pedido->save();
            return response($pedido,201);
        }catch(exception $e){
            return response(null,500);
        }
    }

    public function show($id)
    {
        $codigoEstado = 404;
        $pedido = Pedidos::find($id);
        if($pedido!=null)
            $codigoEstado = 200;
        return response($pedido,$codigoEstado);
    }

    function getByIdUsuario($idUsuario){
        $codigoEstado = 404;
        $pedidos = DB::table('pedidos')->
        where('idCliente','=',e($idUsuario))->
	join('locales_pedidos','pedidos.id','=','locales_pedidos.idPedido','inner',false)->
	join('locales','locales.id','=','locales_pedidos.idLocal','inner',false)->
	orderBy('pedidos.id')->
	orderBy('locales_pedidos.idLocal')->
        select('pedidos.*','locales_pedidos.*','locales.nombre as nombreLocal','locales.precio as precioLocal')->
        get();
        if(count($pedidos) > 0)
            $codigoEstado = 200;
        return response($pedidos,$codigoEstado);
        
    }

    public function update(Request $request, $id)
    {

        try{
            $codigoEstado = 404;

            $pedido = Pedidos::find($id);
    
            if($pedido != null){
                if($pedido->update($request->all()))
                    $codigoEstado = 200;
            }

            return response($pedido,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
 
    }

    public function destroy($id)
    {
        try{
            $codigoEstado = 404;
    
            $pedido = Pedidos::find($id);
            
            if($pedido!=null){
                if($pedido->delete())
                    $codigoEstado = 200;
            }
            return response($pedido,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
    }
}
