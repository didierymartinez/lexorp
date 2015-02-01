<?php

class UserController extends \BaseController {

    
    public function __construct()
    {
        $this->beforeFilter('ver_usuarios', array('only' => 'index') );
        $this->beforeFilter('crear_usuarios', array('only' => 'create') );
        $this->beforeFilter('crear_usuarios', array('only' => 'store') );
        $this->beforeFilter('editar_usuarios', array('only' => 'edit') );
        $this->beforeFilter('editar_usuarios', array('only' => 'update') );
        $this->beforeFilter('eliminar_usuarios', array('only' => 'delete') );
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::where('sys','!=','1')->get();			
        foreach($users as $user){
            $user['rol'] = $user->roles()->first();
        }
        return View::make('users.users', array('users' => $users));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $roles = Role::all()->lists('name','id');
		return View::make('users.create', array('roles' => $roles));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createusuario()
	{
        $roles = Role::all()->lists('name','id');
		return View::make('users.createusuario', array('roles' => $roles));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
        $input['password'] = Hash::make($input['password']);//hacemos un hash de la contraseña
        
        $user = User::create($input);
        $user->attachRole(Role::find(Input::get('rol')));
        $message = array(
			    "type" => "alert-success",
			    "title" => "Creado:",
			    "message" => "Se registró el usuario ".Input::get('first_name')
			);
        return Redirect::route('users.index')->with('message',$message);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeUsuario()
	{
		$input = Input::all();
        $input['password'] = Hash::make($input['password']);//hacemos un hash de la contraseña
        $user = User::create($input);
        $user->attachRole(Role::find(3));
        $message = array(
			    "type" => "alert-success",
			    "title" => "Creado:",
			    "message" => "Se registró el usuario ".Input::get('first_name')
			);
        return Redirect::route('users.index')->with('message',$message);
	}

	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return 'show'.$id;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = User::find($id);
        $userRole = $user->roles()->first();
        $user['rol'] = $userRole;
		return View::make('users.edit', array('user' => $user, 'roles' => Role::all()->lists('name','id')));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$nombre = Input::get('first_name');
        $apellido = Input::get('last_name');
        $email = Input::get('email');
        $password = Hash::make(Input::get('password'));
        
        $user = User::find($id);
        $user->first_name = $nombre;
        $user->last_name = $apellido;
        $user->email = $email;
        if(!empty(Input::get('password'))){
            $user->password = $password;
        }
        $user->save();
         
        $user->roles()->detach();//no es necesario eliminar la relacion con el antiguo rol ya que la libreria permite tener multiples roles
        
        $user->attachRole(Role::find(Input::get('rol')));
        
        $message = array(
			    "type" => "alert-info",
			    "title" => "Edición:",
			    "message" => "Se actualizó datos del usuario ".$nombre
			);
        return Redirect::route('users.index')->with('message',$message);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);
		 $message = array(
			    "type" => "alert-info",
			    "title" => "Eliminado:",
			    "message" => "Se quitó usuario de la Aplicación"
			);

        return Redirect::route('users.index')->with('message',$message);
	}


}
