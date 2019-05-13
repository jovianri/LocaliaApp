<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Usuarios;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuarios::all();
        return $usuarios;
    }

    public function store(Request $request)
    {
        $codigoEstado = 401;

        $usuario = new Usuarios();
        $usuario->nombre = e($request->nombre);
        $usuario->apellidos = e($request->apellidos);
        $usuario->email = e($request->email);
        $usuario->contrasenya = $request->contrasenya;
        $usuario->fechaNacimiento = $request->fechaNacimiento;

        if($usuario->save()){
            $codigoEstado = 201;
        }

        return response($usuario,$codigoEstado);
    }

    public function show($id)
    {
        $codigoEstado = 404;
        $usuario = Usuarios::find($id);
        if($usuario != null)
            $codigoEstado = 200;
        return response($usuario,$codigoEstado);
    }

    public function update(Request $request, $id)
    {

        try{
            $codigoEstado = 404;

            $usuario = Usuarios::find($id);
    
            if($usuario != null){
                if($usuario->update($request->all()))
                    $codigoEstado = 200;
            }

            return response($usuario,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
 
    }

    public function destroy($id)
    {
        try{
            $codigoEstado = 404;
    
            $usuario = Usuarios::find($id);
            
            if($usuario!=null){
                if($usuario->delete())
                    $codigoEstado = 200;
            }
            return response($local,$codigoEstado);
        }catch(Exception $e){
            return response(null,500);
        }
    }

    function comprobarUsuario(Request $request){
        $codigoEstado = 401;
        $datosDevolver = new \stdClass();

        $datosDevolver->logueado = false;
        $datosDevolver->usuario = DB::table('usuarios')->
                                    where('email','=',e($request->email))->
                                    where('contrasenya','=',e($request->contrasenya))->
                                    select('*')->
                                    get();
        if(count($datosDevolver->usuario) > 0){
            $codigoEstado = 200;
            $datosDevolver->usuario = $datosDevolver->usuario[0];
            $datosDevolver->logueado = true;
        }
        return response(json_encode($datosDevolver),$codigoEstado);
    }

}
