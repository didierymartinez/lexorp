@extends('layouts.layout_base')
 
@section('title')
    Crear Usuarios
@stop

@section('head')
@parent
    {{ HTML::script('js/prestamos.js') }}
@stop

@section('content')


{{Form::label('identificacion', $usuario);}}            

<div class="col-sm-6 col-md-2 ">
	<input type="text" class="form-control" name="codigo" id="codigo" required autofocus>
	<button id="adicionarlibro" class="btn btn-default btn-block" type="submit">
		<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar Libro
	</button>
	<br>
</div>




{{ Form::open(array('method' => 'post', 'route' => array('prestamos.store'))) }}
<div class="col-sm-6 col-md-2 ">
	<button class="btn btn-default btn-block" type="submit">
		<span class="glyphicon glyphicon-book" aria-hidden="true"></span> Realizar Prestamo
	</button>
</div>
{{ Form::close() }}


<table id="librosprestamo" class="table table-condensed">
<th>#</th><th>ISBN</th><th>Titulo</th><th>Autor</th>
<tr>
<td>1</td>
<td>15454</td>
<td>Diccionario Español</td>
<td>NKA</td>
</tr>
</table>

@stop