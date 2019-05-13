<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use response;
use App\Http\Controllers\Controller;
use App\Categorias;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();
        return $categorias;
    }

    public function store(Request $request)
    {
        $codigoEstado = 401;

        $categoria = new Categorias();
        $categoria->nombre = e($request->nombre);
        //probar sin avatar para ver si revienta
        if(e($request->avatar) != null)
            $categoria->avatar = e($request->avatar);

        if($categoria->save()){
            $codigoEstado = 201;
        }

        return response($categoria,$codigoEstado);
    }

    public function show($id)
    {
        $codigoEstado = 404;
        $categoria = Categorias::find($id);
        if($categoria != null)
            $codigoEstado = 200;
        return response($categoria,$codigoEstado);
    }

    public function update(Request $request, $id)
    {

        try{
            $codigoEstado = 404;

            $categoria = Categorias::find($id);
    
            if($categoria != null){
                if($categoria->update($request->all()))
                    $codigoEstado = 200;
            }

            return response($categoria,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
 
    }

    public function destroy($id)
    {
        try{
            $codigoEstado = 404;
    
            $categoria = Categorias::find($id);
            
            if($categoria!=null){
                if($categoria->delete())
                    $codigoEstado = 200;
            }
            return response($categoria,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
    }
}
