@extends('layouts.layout_base')
 
@section('title')
    Crear Usuarios
@stop

@section('content')



	{{ Form::open(array('method' => 'post', 'route' => array('prestamos.store'))) }}
		{{Form::label('identificacion', $usuario);}}            
<div class="col-sm-6 col-md-2 ">
		<input type="text" class="form-control" name="codigo"  required autofocus>
	  <button class="btn btn-default btn-block" type="submit">
	  	<span class="glyphicon glyphicon-book" aria-hidden="true"></span> 
	    Agregar
	  </button>
<br>

</div>
	  <table class="table table-condensed">
  		<th>#</th><th>ISBN</th><th>Titulo</th><th>Autor</th>
  		<tr>
  			<td>1</td>
  			<td>15454</td>
  			<td>Diccionario Español</td>
  			<td>NKA</td>
  		</tr>
		</table>
	{{ Form::close() }}

@stop