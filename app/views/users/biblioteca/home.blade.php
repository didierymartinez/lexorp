@extends('layouts.layout_base')
 
@section('title')
    Home
@stop


@section('content')


<div class="container">
	<div class="row">

	    
	<a href="{{URL::to('users/get')}}">
	    <button type="button" class="btn btn-default btn-lg">
	  		<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Inventario
		</button>
	</a>
     <button type="button" class="btn btn-default btn-lg">
  		<span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> Etiquetar
	</button>
     <button type="button" class="btn btn-default btn-lg">
  		<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar
	</button>
     <button type="button" class="btn btn-default btn-lg">
  		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Autores
	</button>
    <button type="button" class="btn btn-default btn-lg">
  		<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Categorias
	</button>
    </div>
</div>


@stop