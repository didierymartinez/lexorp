@extends('layouts.layout_base')
 
@section('title')
    Home
@stop


@section('content')

<div class="container">
	<div class="row">
		<a href="{{URL::to('users/get')}}">
		    <button type="button" class="btn btn-default btn-lg">
		  		<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Administrar
			</button>
		</a>
		<a href="{{URL::to('createusuario')}}">
		    <button type="button" class="btn btn-default btn-lg">
		  		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo
			</button>
		</a>
    </div>
</div>



@stop