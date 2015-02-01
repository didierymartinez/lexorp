<?php

class TiposArticulosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('tipoarticulos.home')->with('tiposarticulos',TipoArticulos::all());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tipoarticulos.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$tipoarticulos = new TipoArticulos();
		$tipoarticulos->tipo = Input::get('tipo');
		$tipoarticulos->save();

		return Redirect::route('tiposarticulos.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('tipoarticulos.edit', array('tipoarticulos' => TipoArticulos::find($id)));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$tipoarticulos = TipoArticulos::find($id);
        $tipoarticulos->Tipo = Input::get('tipo');
        $tipoarticulos->save();
        return Redirect::route('tiposarticulos.index');

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		TipoArticulos::destroy($id);        
		return Redirect::route('tiposarticulos.index');
	}


}
