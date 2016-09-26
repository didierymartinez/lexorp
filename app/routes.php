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
	//return libro::find(1)->articulos->first()->items->count();

	//$Articulo = Articulo::find(1);
	//return $Articulo->ultimomovimiento;


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


    //return libro::find(1)->articulos->first()->items->first()->movimientos()->where('movimiento_type', '=', 'Prestamo')->first();
	//return  libro::find(1)->articulos->first()->items->first()->tag->epc;
    //return Tag::where('epc', '=', '9230-2010-0000-001A-0000-0705')->get()->first()->objeto->identificacion;

    $Movimiento = libro::find(1)->disponibles();

    foreach($Movimiento as $libro){
        $libro->epc = ($libro->tag_id != null) ? $libro->Tag->epc : null;
    }

    return $Movimiento;

    //return Articulo::find(2)->articulo;

	
	//return libro::find(1)->enPrestamo();

	

	//return	item::whereHas('movimientos', function($q)
	//		{
	//		    $q->where('movimiento_type', '=', 'Prestamo');

	//		})->get();

});

Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

Route::resource('/home','HomeController');
Route::resource('/users','UserController');
Route::resource('/usuariosbiblioteca','UsuariosBibliotecaController');
Route::resource('/tags','TagsController');
Route::resource('/roles','RolesController');

Route::resource('/prestamos','PrestamosController');
Route::resource('/devoluciones','DevolucionesController');

Route::post('devoluciones/buscarArticulo',array('as' => 'devoluciones.buscarArticulo', 'uses' => 'DevolucionesController@buscarArticulo'));
Route::get('inventario/tags',array('as' => 'inventario.tags', 'uses' => 'InventarioController@tags'));

Route::post('prestamos/buscarArticulo',array('as' => 'prestamos.buscarArticulo', 'uses' => 'PrestamosController@buscarArticulo'));
Route::post('prestamos/crearprestamo',array('as' => 'prestamos.crearprestamo', 'uses' => 'PrestamosController@crearprestamo'));



Route::resource('/libros','LibrosController');

Route::resource('/inventario','InventarioController');
Route::post('inventario/buscarXestado',array('as' => 'inventario.buscarXestado', 'uses' => 'InventarioController@buscarXestado'));



Route::resource('/articulos','ArticulosController');
//Route::get('/libros/get/{id}',array('as' => 'libros.get', 'uses' => 'LibrosController@get'));


Route::resource('/tiposarticulos','TiposArticulosController');


Route::get('/permisos','PermisosController@index');
Route::get('/permisos/asignar','PermisosController@asignar');
Route::get('/permisos/desasignar','PermisosController@desasignar');
