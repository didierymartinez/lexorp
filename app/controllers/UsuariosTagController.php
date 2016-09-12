<?php

class UsuariosTagController extends \BaseController {


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

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tag = Tag::where('epc', '=', $id)->get()->first();
        if($tag){
            return Response::json($tag->objeto);
        }else{
            return Response::json('');
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
		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
	}


}
