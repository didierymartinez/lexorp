<?php

class PrestamosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('prestamos.home');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	public function crearPrestamo()
	{
		$identificacion = Input::get('identificacion');
		$usuario = User::where('identificacion', '=', $identificacion)->get()->first();
		if($usuario){
			return View::make('prestamos.create')->with('usuario',$usuario);	
		}else{
			$message = array(
			    "type" => "alert-danger",
			    "title" => "Error:",
			    "message" => "Identificación ". $identificacion ." no existe "
			);
        	return Redirect::route('prestamos.index')->with('message',$message);
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Request::ajax()){
			$articulosPrestamo = Input::get('articulosprestamo');

			$usuario = Input::get('usuario');

			$object = json_decode($articulosPrestamo, true);

       		foreach($articulosPrestamo as $libros){
          	//foreach ($libros as $libro){
               // $ids[] = $libros;
        	//}
        	}   
        			

	        return $object[2]['nombre']. count($object) .$usuario;
    	}	
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
