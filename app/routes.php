<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('login.login');
});

Route::get('test',function(){
	//$Articulo = Articulo::find(1)->articulo;
	//return get_class($Articulo);

	$Movimiento = Movimiento::find(1)->movimiento;
	return $Movimiento;

	//return Libro::find(1)->articulos;
});

Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

Route::resource('/home','HomeController');
Route::resource('/users','UserController');
Route::resource('/roles','RolesController');

Route::resource('/prestamos','PrestamosController');
Route::post('prestamos/crearprestamo',array('as' => 'prestamos.crearprestamo', 'uses' => 'PrestamosController@crearprestamo'));

Route::resource('/libros','LibrosController');
Route::resource('/articulos','ArticulosController');
//Route::get('/libros/get/{id}',array('as' => 'libros.get', 'uses' => 'LibrosController@get'));


Route::resource('/tiposarticulos','TiposArticulosController');



Route::get('createusuario', array('as' => 'users.createusuario', 'uses' => 'UserController@createusuario'));
Route::get('users.storeUsuario', array('as' => 'users.storeUsuario', 'uses' => 'UserController@createusuario'));
Route::post('users.storeUsuario','UserController@storeUsuario');

Route::get('/permisos','PermisosController@index');
Route::get('/permisos/asignar','PermisosController@asignar');
Route::get('/permisos/desasignar','PermisosController@desasignar');
