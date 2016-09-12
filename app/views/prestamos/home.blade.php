@extends('layouts.layout_base')
 
@section('title')
    Realizar Prestamo
@stop

@section('titulopagina')
Realizar Prestamo
@stop

@section('content')





<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-sm-offset-4  col-md-offset-4">
	    <div class="account-wall">
        <h4 class="text-center login-title">Buscar Usuario</h4>
				{{ Form::open(array('method' => 'post', 'route' => array('prestamos.crearprestamo'))) }}
				<input type="number" class="form-control" id="txtIdentificacion" name="identificacion" placeholder="Identificación" required autofocus>
	      <br>
		<div class="col-lg-12  col-md-12 col-sm-12">  
		<div class="col-lg-6  col-md-6 col-sm-6"> 			  
				<div class="btn btn-info btn-block" id="buscarTagUsuario">
				<span class="glyphicon glyphicon-play" id="imagenEstado" aria-hidden="true"></span> 
				 <span id="connectionStatus">Leer tag</span> 
				</div>
		
		</div>	
		
		
		<div class="col-lg-6  col-md-6 col-sm-6">  		
			  <button class="btn btn-default btn-block" id="btnBuscar" type="submit">
				<span class="glyphicon glyphicon-search" aria-hidden="true"></span> 
				  Buscar
			  </button>
		</div>

		</div>
	      {{ Form::close() }}
	    </div>
		</div>
	</div>
</div>
{{ HTML::script('js/libros/leerTagUsuario.js') }}
@stop