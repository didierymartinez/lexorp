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
          		$libro->ejemplaresPrestados = $libro->enPrestamo();
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
		$autoreslibroNuevo = $datoslibroNuevo['autores'];

		$libroNuevo = new Libro;
		$libroNuevo->fill($datoslibroNuevo);
		$libroNuevo->save();
                
		$libroNuevo->autores()->attach($autoreslibroNuevo);
		
		return $libroNuevo->autores;
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

			$datosEditados = json_decode(Input::get('libroNuevo'), true)[0];

			$Libro = Libro::find($id);
	        $Libro->fill($datosEditados);
	        $Libro->save();	

	        $autoreslibro = $datosEditados['autores'];
	        $Libro->autores()->detach();              
			$Libro->autores()->attach($autoreslibro);
		

			return Response::json(array( 'libro' => $Libro ));
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
			$datosEliminar = json_decode(Input::get('libroNuevo'), true)[0];


        	
	
			if(Libro::find($id)->articulos->first()->items->count() == 0){
				$autoreslibro = $datosEliminar['autores'];
				Libro::find($id)->autores()->detach();			
				Libro::destroy($id);
				$message = array(
				    "type" => "danger",
				    "message" => "Se eliminó libro"
				);			
			}else{
				$message = array(
				    "type" => "danger",
				    "message" => "Este libro tiene ejemplares No se puede Eliminar"
				);
			}

			return Response::json($message);
			
		}
	}


}
