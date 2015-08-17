@extends('layouts.layout_base')
 
@section('title')
    Home
@stop

@section('content')

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
          <div class="col-md-12">
                      
              <div class="btn-group btn-group-justified">                
                <a href="{{URL::to('libros')}}" class="btn btn-primary col-sm-3">
                  <i class="glyphicon glyphicon-book"></i><br>
                  Biblioteca
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
              
              <div class="well">Mensajes <span class="badge pull-right">3</span></div>
              
              <hr>
              
              <div class="panel panel-default">
                  <div class="panel-heading"><h4>Estado Prestamos</h4></div>
                  <div class="panel-body">
                    
                    <small>Al dia</small>
                    <div class="progress">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%">
                        <span class="sr-only">72% Complete</span>
                      </div>
                    </div>
                    <small>Por Vencer</small>
                    <div class="progress">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                        <span class="sr-only">60% Complete (warning)</span>
                      </div>
                    </div>
                    <small>Vencidos</small>
                    <div class="progress">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                        <span class="sr-only">80% Complete</span>
                      </div>
                    </div>

                  </div><!--/panel-body-->
              </div><!--/panel-->
  
       </div><!--/col-->
      <div class="col-md-12">
              
      </div><!--/col-span-6-->
     
      </div><!--/row-->
  
    </div>

@stop