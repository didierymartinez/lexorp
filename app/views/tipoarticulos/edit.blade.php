@extends('layouts.layout_base')
 
@section('title')
   Editar Tipo Articulos
@stop

@section('content')
    {{ Form::Model($tipoarticulos, array('method' => 'PUT', 'route' => array('tiposarticulos.update', $tipoarticulos->id), 'class' => 'form-horizontal col-md-6')) }}

    <div class="form-group">
        {{Form::label('tipo', 'Tipo');}}
        {{Form::text('tipo', null, array('class' => 'form-control'));}}
    </div>
        <button type="submit" class="btn btn-primary ">
            <i class="glyphicon glyphicon-floppy-disk"></i> Guardar
        </button>

        {{ Form::close() }}
    {{ Form::close() }}

@stop