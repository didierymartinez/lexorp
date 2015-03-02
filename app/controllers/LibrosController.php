<?php

class LibrosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$Autores = Autor::orderBy('nombres')->get();
		$Autores = $Autores->lists('NombreCompleto', 'id');
		$editoriales = Editorial::orderBy('nombre')->get();			
		$editoriales = $editoriales->lists('nombre', 'id');	
		array_unshift($editoriales, '' );
		return View::make('libros.libros',array('Autores' => $Autores, 'Editoriales' => $editoriales, 'libros' => Libro::all()));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$Autores = Autor::orderBy('nombres')->get();
		$Autores = $Autores->lists('NombreCompleto', 'id');
		$editoriales = Editorial::orderBy('nombre')->get();			
		$editoriales = $editoriales->lists('nombre', 'id');	
		array_unshift($editoriales, '' );
		return View::make('libros.create',array('Autores' => $Autores, 'Editoriales' => $editoriales));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$datoslibroNuevo = json_decode(Input::get('libroNuevo'), true)[0];
		//$libroNuevo = Libro::create($libroNuevo);

		$libroNuevo = new Libro;
		$libroNuevo->fill($datoslibroNuevo);
		$libroNuevo->save();
        
        
		
		
		return $libroNuevo;

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

	        $Libro = Articulo::find(Input::get('id'))->articulo;
	        $Autor = $Libro->autor;

	        return Response::json(array( 'libro' => $Libro ,'autor' => $Autor));
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
