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
	return libro::find(1)->articulos->first()->items->count();

	//$Articulo = Articulo::find(1);
	//return $Articulo->movimientos;


		// $usuarionuevo = new UsuarioBiblioteca;

		// $usuarionuevo->identificacion = '3766';
  //               $usuarionuevo->tipoidentificacion= 'CC';
  //               $usuarionuevo->nombres = 'Isidora';
  //               $usuarionuevo->apellidos = 'Arguello';
  //               $usuarionuevo->sexo= 'F';
  //               $usuarionuevo->fecha_nacimiento = '18/05/1962';
  //               $usuarionuevo->direccion= 'Calle 143 # 118 - 20 ';
  //               $usuarionuevo->tel_fijo = '4935660';
  //               $usuarionuevo->celular = '3208100605';
  //              $usuarionuevo-> email = 'arguelloisidora@gmail.com';


		// $usuarionuevo->save();
		
		// $usuario = User::where('identificacion', '=', '80549322')->get()->first();

      	

		// 	$usuario->NombreCompleto = $usuario->NombreCompleto;
		// 	$usuario->activo = ($usuario->activo == "1") ? "Si" : "No";
		// 	$usuario->tipoidentificacionDesc = $usuario->tipoIdentificacion;

		// return $usuario;

		//[{"titulo":"bsdf","subtitulo":"adfa","titulooriginal":"adf","anoedicion":"1900","edicion":"adf","isbn":"3234","coleccion":"234","infoadicional":""}]
      //$Item = Item::find(2);

      //return   $Item->prestamos;

	//$Movimiento = Movimiento::find(1)->movimiento;
	//return $Movimiento;

	//return Libro::find(1)->articulos;
});

Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

Route::resource('/home','HomeController');
Route::resource('/users','UserController');
Route::resource('/usuariosbiblioteca','UsuariosBibliotecaController');
Route::resource('/roles','RolesController');

Route::resource('/prestamos','PrestamosController');
Route::resource('/devoluciones','DevolucionesController');

Route::post('devoluciones/buscarArticulo',array('as' => 'devoluciones.buscarArticulo', 'uses' => 'DevolucionesController@buscarArticulo'));

Route::post('prestamos/buscarArticulo',array('as' => 'prestamos.buscarArticulo', 'uses' => 'PrestamosController@buscarArticulo'));
Route::post('prestamos/crearprestamo',array('as' => 'prestamos.crearprestamo', 'uses' => 'PrestamosController@crearprestamo'));



Route::resource('/libros','LibrosController');
Route::resource('/articulos','ArticulosController');
//Route::get('/libros/get/{id}',array('as' => 'libros.get', 'uses' => 'LibrosController@get'));


Route::resource('/tiposarticulos','TiposArticulosController');


Route::get('/permisos','PermisosController@index');
Route::get('/permisos/asignar','PermisosController@asignar');
Route::get('/permisos/desasignar','PermisosController@desasignar');
