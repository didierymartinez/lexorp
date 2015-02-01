@extends('layouts.layout_base')
 
@section('title')
    Crear Usuarios
@stop

@section('head')
    @parent
    	<style>            
            label {
            	font-weight: normal;
			}
        </style>	
@stop

@section('content')

{{ Form::open(array('method' => 'POST', 'route' => array('users.storeUsuario'), 'class' => 'form-horizontal col-md-12')) }}
<fieldset>
<legend>Datos Personales</legend>

	<div class="form-group">
	<div class="col-sm-2">
		{{Form::label('identificacion', 'Identificación');}}
		{{Form::text('identificacion', '',array('class' => 'form-control'));}}
	</div>
	</div> 

	<div class="form-group">
	<div class="col-sm-6">
	{{Form::label('first_name', 'Nombres');}}
	{{Form::text('first_name', '',array('class' => 'form-control'));}}
	</div>

	<div class="col-sm-6">
	{{Form::label('last_name', 'Apellidos');}}
	{{Form::text('last_name', '',array('class' => 'form-control'));}}
	</div>
	</div>

	<div class="form-group">
	{{Form::label('email', 'Email');}}
	{{ Form::email('email', null, array('class' => 'form-control')); }}
	</div>
	<div class="form-group">
	{{Form::label('password', 'Password');}}
	{{ Form::password('password', array('class' => 'form-control')) }}
	</div>
	
</fieldset>
	<button type="submit" class="btn btn-success ">
	<i class="glyphicon glyphicon-plus-sign "></i> Crear
	</button>

{{ Form::close() }}



@stop