<?php

class AuthController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function login()
	{
		$identificacion = Input::get('identificacion');
		$password = Input::get('password');

		if (Auth::attempt(['identificacion' => $identificacion, 'password' => $password]))
        {
        	$message = array(
			    "type" => "alert-success",
			    "title" => "Bienvenido!!",
			    "message" => ""
			);
			return Redirect::to('home')->with('message',$message);    

        }

         else {
		    return Redirect::to('/')
		        ->with('message', 'Usuario o Contraseña Incorrecta')
		        ->withInput();
		}   
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function logout()
	{
        Session::flush();
		Auth::logout();
        return Redirect::to('/');
	}


}
