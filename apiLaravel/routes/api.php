<?php

Route::resource('imagenes','ImagenesController',
                ["only"=>["index","store","update","destroy"]]);

Route::resource('locales','LocalesController',
                ["only"=>["index","store","update","destroy"]]);
Route::get('locales/id={id}','LocalesController@getLocal')->name('getLocal');
Route::get('locales/categoria={categoria}','LocalesController@getByCategoria')->name('getLocalesByCategoria');
Route::get('locales/ciudad={ciudad}','LocalesController@getByCiudad')->name('getLocalesByCiudad');

Route::resource('categorias','CategoriasController',
                ["only"=>["index","store","show","update","destroy"]]);

Route::resource('ciudades','CiudadesController',
                ["only"=>["index","store","show","update","destroy"]]);


Route::resource('fotosLocales','FotosLocalesController',
                ["only"=>["index","store","show","update","destroy"]]);

Route::resource('pedidos','PedidosController',
                ["only"=>["index","store","update","destroy"]]);
Route::get('pedidos/id={id}','PedidosController@show')->name('getById');

Route::get('pedidos/idUsuario={idUsuario}','PedidosController@getByIdUsuario')->name('getByIdUsuario');


Route::resource ('localesPedidos','localesPedidosController',
                ["only"=>["index","store","update","destroy"]]);

Route::get('localesPedidos/id={id}','localesPedidosController@show')->name('getById');

Route::get('localesPedidos/idPedido={idPedido}','localesPedidosController@getByIdPedido')->name('getByIdPedido');
//cambiar en vue la llamada del registro a usuarios a secas con method post o no jaja
Route::resource('usuarios','UsuariosController',
                ["only"=>["index","store","show","update","destroy"]]);

Route::post('login','UsuariosController@comprobarUsuario')->name('comprobarUsuario');
// Route::post('registro','UsuariosController@registrar')->name('registrarUsuario');

