<?php

class InventarioController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Request::ajax()){
			$libros = Libro::all();	
			$CatalogoLibros = array();	

			foreach($libros as $libro){          		
          		foreach ($libro->autores as $autor) {
          			$libro->NombresAutores = $libro->NombresAutores ." - " . $autor->NombreCompleto;
          		}
          		$libro->NombresAutores = substr($libro->NombresAutores, 3);
          		$libro->NombreEditorial = $libro->editorial->nombre;
          		$libro->ejemplaresTotal = $libro->articulos->first()->items->count();
          		$libro->ejemplaresPrestados = $libro->CantidadenPrestamo();
          		$libro->ejemplaresDisponibles = intval($libro->ejemplaresTotal) - intval($libro->ejemplaresPrestados);
          		
          		array_push($CatalogoLibros, $libro); 

        	}   
	        return Response::json($CatalogoLibros);
    	}else{	
			$Autores = Autor::orderBy('nombres')->get();
			$Autores = $Autores->lists('NombreCompleto', 'id');
			$editoriales = Editorial::orderBy('nombre')->get();			
			$editoriales = $editoriales->lists('nombre', 'id');	
			array_unshift($editoriales, '' );
			return View::make('libros.inventario',array('Autores' => $Autores, 'Editoriales' => $editoriales, 'libros' => Libro::all()));
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
		$datosAdquisicion = json_decode(Input::get('adquisicion'), true);
		$datosEjemplares = json_decode(Input::get('items'), true);
		
		$Adquisicion = new Adquisicion;
		$Adquisicion->fill($datosAdquisicion);
		$Adquisicion->save();

		foreach($datosEjemplares as $ejemplar){ 
				unset($ejemplar['id']);
				Item::create($ejemplar);
		}
		
		return $datosEjemplares;
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


	public function buscarXestado()
	{
		if(Request::ajax()){

			switch (Input::get('idEstado')) {
				case 'enprestamo':
					$Libros = libro::find(Input::get('idLibro'))->enPrestamo();
					break;
				
				case 'disponibles':
					$Libros = libro::find(Input::get('idLibro'))->disponibles();
					break;

				case 'total':
					$Libros = libro::find(Input::get('idLibro'))->total();
					break;	
			}

	        

	        return Response::json($Libros);
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
