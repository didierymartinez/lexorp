@extends('layouts.layout_base')
 
@section('title')
    crear roles
@stop

@section('head')
    @parent
    	<style>
            .role{
                margin-top: 60px;
            }
        </style>	
@stop

@section('content')
    <div class="role">
        {{ Form::open(array('method' => 'POST', 'route' => array('roles.store'), 'class' => 'form-horizontal col-md-6')) }}
        
        <div class="form-group">
            {{Form::label('name', 'Nombre');}}
            {{Form::text('name', '',array('class' => 'form-control'));}}
        </div>
           <button type="submit" class="btn btn-success ">
                <i class="glyphicon glyphicon-plus-sign "></i> Crear
            </button>
 
        {{ Form::close() }}
    </div>

@stop