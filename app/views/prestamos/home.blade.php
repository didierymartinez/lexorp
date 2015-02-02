@extends('layouts.layout_base')
 
@section('title')
    Realizar Prestamos
@stop


@section('content')


<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-md-offset-4">
	    <div class="account-wall">
        <h4 class="text-center login-title">Buscar Usuario</h4>
				{{ Form::open(array('method' => 'get', 'route' => array('prestamos.create'))) }}
				<input type="text" class="form-control" name="identificacion" placeholder="Identificación" required autofocus>
	      <br>
	      <button class="btn btn-default btn-block" type="submit">
	      	<span class="glyphicon glyphicon-search" aria-hidden="true"></span> 
		      Buscar
		    </button>
	      {{ Form::close() }}
	    </div>
		</div>
	</div>
</div>


@stop