@extends('layouts.layout_base')
 
@section('title')
    crear roles
@stop

@section('content')
  {{ Form::open(array('method' => 'POST', 'route' => array('tiposarticulos.store'), 'class' => 'form-horizontal col-md-4')) }}

  <div class="form-group">
      {{Form::label('tipo', 'Tipo');}}
      {{Form::text('tipo', '',array('class' => 'form-control'));}}
  </div>
     <button type="submit" class="btn btn-success ">
          <i class="glyphicon glyphicon-plus-sign "></i> Crear
      </button>

  {{ Form::close() }}
@stop