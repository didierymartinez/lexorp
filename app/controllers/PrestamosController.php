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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Request::ajax()){
			$articulosprestamo = json_decode(Input::get('articulosprestamo'), true);
			$usuario = Input::get('usuario');

       		foreach($articulosprestamo as $libro){
          		$prestamo = new Prestamo();
          		$prestamo->inventario_id = $libro[0];
          		$prestamo->fechadevolucion = date("Y-m-d", strtotime($libro[1])); 
          		$prestamo->usuario_id = $usuario;
          		$prestamo->save();          	
        	}           			

	        return $articulosprestamo;
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

	public function buscarArticulo()
	{
		if(Request::ajax()){
			
			$respuesta = array();	
			$Item = Item::where('placa','=',Input::get('id'))->first();


			if(!$Item){
				
				$respuesta['exito'] = 0;
				$respuesta['mensaje'] = 'Articulo no existe';
			}else{

				//if(Movimiento::find($Item->ultimoMovimiento_id)->movimiento_type == "Prestamo"){
				//	return Response::json('Articulo En Prestamo');		
				//}else{
					$respuesta['exito'] = 1;
					$Articulo = $Item->articulo;		

					$respuesta[get_class($Articulo)] = $Articulo;        
					$respuesta['Item'] = $Item; 

			        if($Articulo->articulo_type == 'Libro'){
				        foreach ($Articulo->articulo->autores as $autor) {
		          			$Articulo->articulo->NombresAutores = $Articulo->articulo->NombresAutores ." - " . $autor->NombreCompleto;
		          		}
		          		
		          		$Articulo->articulo->NombresAutores = substr($Articulo->articulo->NombresAutores, 3);
		          		$Articulo->articulo->NombreEditorial = $Articulo->articulo->editorial->nombre;
		          		
		          		$date = new DateTime();
		          		$date->modify('+8 days');
		          		
		          		$Articulo->articulo->fechadevolucion = $date->format('d/m/Y');

			        	$respuesta[$Articulo->articulo_type] = $Articulo->articulo;	
			         	
			        }
		        	
		        //}
		        
	    	}

	    	return Response::json($respuesta);
    	}			
	}
}
