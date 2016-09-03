@extends('layouts.layout_base')
 
@section('title')
    Tags
@stop

@section('content')
<style>
.progress {
    height: 10px;
	    margin-bottom: 0;
	 
}
</style>
<div>
        
      <!-- column 2 --> 
      <ul class="list-inline pull-right">
         <li><a href="#"><i class="glyphicon glyphicon-cog"></i></a></li>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="glyphicon glyphicon-comment"></i>
                <span class="count">3</span>
            </a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="#">1. Tarea Pendiente</a></li>
                  <li><a href="#">2. Revisar Usuarios</a></li>
                  <li><a href="#"><strong>Configurar</strong></a></li>
                </ul>
          </li>
         <li><a href="#"><i class="glyphicon glyphicon-user"></i></a></li>
         <li><a title="Add Widget" data-toggle="modal" href="#addWidgetModal"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a></li>
      </ul>
      <a href="#"><strong><i class="glyphicon glyphicon-home"></i> Inicio</strong></a>  
      
        <hr>
      
    <div class="row">
           
            
          
            <!-- center left--> 
			<div class="progress  col-sm-12">
  <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
    <span class="sr-only">45% Complete</span>
  </div>
</div>
          <div class="col-md-12">
                      
              <div class="btn-group btn-group-justified">                
                <a href="{{URL::to('libros')}}" class="btn btn-primary col-sm-3">
                  <i class="glyphicon glyphicon-record"></i><br>
                  Antenas
                </a>
                <a href="{{URL::to('inventario')}}" class="btn btn-primary col-sm-3">
                  <i class="glyphicon glyphicon-barcode"></i><br>
                  Inventario
                </a>
                <a href="{{URL::to('prestamos')}}" class="btn btn-primary col-sm-3">
                  <i class="glyphicon glyphicon-retweet"></i><br>
                  Prestamos
                </a>
                <a href="{{URL::to('home')}}" class="btn btn-primary col-sm-3">
                  <i class="glyphicon glyphicon-cog"></i><br>
                  Configuración
                </a>
              </div>
			  		

              <hr>
              <div id="content">
	<fieldset>
		<div>
			<button id="iniciarLectura">Iniciar Lectura</button>
			<button id="detenerLectura">Terminar Lectura</button>
		</div>
		<div>
			<label>Estado:</label>
			<span id="connectionStatus"></span>
		</div>
	</fieldset>
</div>
<hr>
              
			  <div class="panel panel-default"> <div class="panel-heading">Tags Encontrados</div> <table id="tagsLeidos" class="table"> <thead> <tr> <th>#</th> <th>EPC</th> <th>Cantidad</th></tr> </thead> <tbody>  </tbody> </table> </div>
              
              <hr>
              

  
       </div><!--/col-->
      <div class="col-md-12">
              
      </div><!--/col-span-6-->
     
      </div><!--/row-->
  
    </div>
{{ HTML::script('js/libros/tags.js') }}
@stop