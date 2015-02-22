@extends('layouts.layout_base')
 
@section('title')
    Crear Usuarios
@stop

@section('content')
        {{ Form::open(array('method' => 'POST', 'route' => array('users.store'), 'class' => 'form-horizontal col-md-6')) }}
       
        <div class="form-group">
            {{Form::label('identificacion', 'Identificación');}}
            {{Form::number('identificacion', '',array('class' => 'form-control', 'required' => 'required'));}}
        </div> 
        <div class="form-group">
            {{Form::label('first_name', 'Nombre');}}
            {{Form::text('first_name', '',array('class' => 'form-control', 'required' => 'required'));}}
        </div>
        <div class="form-group">
            {{Form::label('last_name', 'Apellido');}}
            {{Form::text('last_name', '',array('class' => 'form-control', 'required' => 'required'));}}
        </div>
        <div class="form-group">
            {{Form::label('role', 'Rol');}}
            {{ Form::select('rol', $roles, null, array('class' => 'form-control', 'required' => 'required')) }}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email');}}
            {{ Form::email('email', null, array('class' => 'form-control', 'required' => 'required')); }}
        </div>
        <div class="form-group">
            {{Form::label('password', 'Password');}}
            {{ Form::password('password', array('class' => 'form-control', 'required' => 'required')) }}
        </div>
            <button type="submit" class="btn btn-success ">
                <i class="glyphicon glyphicon-plus-sign "></i> Crear
            </button>
        {{ Form::close() }}
@stop