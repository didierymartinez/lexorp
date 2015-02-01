@extends('layouts.layout_base')
 
@section('title')
    Home
@stop


@section('content')


<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail">        
			<div class="caption">
				<nav class="navbar navbar-default" role="navigation">
					<div class="container-fluid">
						<div class="navbar-header">
							<a class="navbar-brand" href="#"><span class="glyphicon glyphicon-user caption"></span>USUARIOS</a>
						</div>
					</div>
				</nav>
			</div>

<div class="block-menu" role="complementary">
	<ul class="nav bs-docs-sidenav">				  
	<li><a href="{{URL::to('users')}}">Crear</a></li>
	<li><a href="{{URL::to('roles')}}">Actualizar</a></li>
	<li><a href="{{URL::to('roles')}}">Inactivar</a></li>
	     <li data-toggle="collapse" data-target="#informes"> 
				<a href="#glyphicons">Informes<span class="caret"></span></a>
		    <ul class="nav-list collapse" id="informes">
				<li><a href="{{URL::to('users')}}">Prestamos</a></li>
				<li><a href="{{URL::to('users')}}">Inactivos</a></li>
			</ul>
		</li>
	</ul>
</div>

		
		</div>
	</div>
	
</div>


@stop