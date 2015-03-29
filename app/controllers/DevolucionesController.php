<?php

class DevolucionesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('devoluciones.home');
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
			$articulosdevolucion = json_decode(Input::get('articulosdevolucion'), true);

       		foreach($articulosdevolucion as $libro){
          		$devolucion = new Devolucion();
          		$devolucion->inventario_id = $libro;
          		$devolucion->save();          	
        	}           			

	        return $articulosdevolucion;
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

			        	$respuesta[$Articulo->articulo_type] = $Articulo->articulo;	
			         	
			        }
		        	
		        //}
		        
	    	}

	    	return Response::json($respuesta);
    	}			
	}
}
