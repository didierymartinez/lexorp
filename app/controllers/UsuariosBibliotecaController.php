<?php

class UsuariosBibliotecaController extends \BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Request::ajax()){
			$usuarios = UsuarioBiblioteca::all();

			foreach ($usuarios as $usuario) {
      			$usuario->NombreCompleto = $usuario->NombreCompleto;
      			$usuario->activo = ($usuario->activo == "1") ? "Si" : "No";
      			$usuario->tipoidentificacionDesc = $usuario->tipoIdentificacion->Descripcion;
      		}
      	
	        return Response::json($usuarios);

    	}else{	
    		$tiposidentificacion = TipoIdentificacion::orderBy('id')->get();			
			$tiposidentificacion = $tiposidentificacion->lists('Descripcion', 'id');	
			array_unshift($tiposidentificacion, '' );
			return View::make('users.biblioteca.usuarios', array('tiposidentificacion' => $tiposidentificacion));
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$datosusuarioNuevo = json_decode(Input::get('usuarioNuevo'), true)[0];

		$usuarioNuevo = new UsuarioBiblioteca;
		$usuarioNuevo->fill($datosusuarioNuevo);
		$usuarioNuevo->save();
                
		
		return $usuarioNuevo;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(Request::ajax()){

			$idUsuario = json_decode(Input::get('idUsuario'), true);

			if($idUsuario != ""){
				$usuario = UsuarioBiblioteca::where('id', '<>', $idUsuario)->where('identificacion', '=', $id)->get()->first();	        
	        	return Response::json(array( 'error' => ($usuario) ? 1 : 0,'mensaje' => ($usuario) ? 'El usuario con identificación   '. $usuario->identificacion.' ya existe': 'Valido' ));				
			}else{
				$usuario = UsuarioBiblioteca::where('identificacion', '=', $id)->get()->first();	        
	        	return Response::json(array( 'error' => ($usuario) ? 1 : 0,'mensaje' => ($usuario) ? 'El usuario con identificación   '. $usuario->identificacion.' ya existe': 'Valido' ));
			}        
    	}	
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(Request::ajax()){

			$datosEditados = json_decode(Input::get('usuarioNuevo'), true)[0];

			$Usuario = UsuarioBiblioteca::find($id);
	        $Usuario->fill($datosEditados);
	        $Usuario->save();	

			return Response::json(array( 'Usuario' => $Usuario ));
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Request::ajax()){	
			
			$usuario = UsuarioBiblioteca::find($id);
			$usuario->activo = !$usuario->activo;
			$usuario->save();

			$user = $usuario->User;
			$user->active = !$user->active;
			$user->save();

			return Response::json($user);
		}
	}


}
