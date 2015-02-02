@extends('layouts.layout_base')
 
@section('title')
    Crear Usuarios
@stop

@section('content')
        {{ Form::open(array('method' => 'POST', 'route' => array('prestamos.store'), 'class' => 'form-horizontal col-md-6')) }}
       
        <div class="form-group">
            {{Form::label('identificacion', $usuario);}}            
        </div>

         <button type="submit" class="btn btn-success ">
            <i class="glyphicon glyphicon-plus-sign "></i> Crear
        </button>
        {{ Form::close() }}
@stop