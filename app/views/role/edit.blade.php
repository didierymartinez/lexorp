@extends('layouts.layout_base')
 
@section('title')
    Editar Rol
@stop


@section('content')
{{ Form::Model($role, array('method' => 'PUT', 'route' => array('roles.update', $role->id), 'class' => 'form-horizontal col-md-6')) }}

<div class="form-group">
    {{Form::label('name', 'Nombre');}}
    {{Form::text('name', null, array('class' => 'form-control'));}}
</div>
<button type="submit" class="btn btn-primary ">
    <i class="glyphicon glyphicon-floppy-disk"></i> Guardar
</button>

{{ Form::close() }}

@stop