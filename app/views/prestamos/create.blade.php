@extends('layouts.layout_base')
 
@section('title')
    Crear Prestamo
@stop

@section('head')
@parent

    {{ HTML::script('js/libros/prestamos.js') }}

@stop



@section('content')
<input type="hidden" value="{{$usuario->id}}" id="idusuario">

<div class="wizard" id="prestamos-wizard" data-title="Realizar Prestamo">
          
    <div class="wizard-card" data-cardname="Usuario">

        <h3>Usuario</h3>
        
        <div class="col-sm-4 user-image">
            <img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfp1/v/t1.0-1/c23.0.135.135/1653984_10152228375391427_156457130_n.jpg?oh=8b242d31a41f9a670d72512ff0497a4c&oe=5560615B&__gda__=1431785571_749377786dff582c212c8e928d5521ad"
            alt="{{$usuario->first_name}}" title="{{$usuario->first_name}}" class="img-circle">
        </div>

        <div class="span4">
            <div class="bs-callout bs-callout-info" id="callout-glyphicons-location">
                <h4 id="changing-the-icon-font-location">{{  ucwords(strtolower($usuario->NombreCompleto))  }}</h4>
                <p data-readline-background="rgba(0, 0, 0, 0)">{{$usuario->identificacion}}</p>
            </div>

            <div class="user-info-block">
                <ul class="navigation">
                    <li class="active">
                        <a data-toggle="tab" href="#information"><span class="glyphicon glyphicon-user"></span></a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#settings"><span class="glyphicon glyphicon-earphone"></span></a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#email"><span class="glyphicon glyphicon-envelope"></span></a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#events"><span class="glyphicon glyphicon-calendar"></span></a>
                    </li>
                </ul>
            </div>
        
            <div class="tab-content">
                </br></br>
                <div id="information" class="tab-pane active">
                    <div class="row">
                        <div class="col-md-4">
                            <span class="help-block">Tipo Identificación:</span>  
                        </div>
                        <div class="col-md-8">
                            <h4>{{$usuario->tipoidentificacionDesc}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span class="help-block">Identificación:</span>  
                        </div>
                        <div class="col-md-8">
                            <h4>{{$usuario->identificacion}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span class="help-block">Sexo:</span>  
                        </div>
                        <div class="col-md-8">
                            <h4>{{$usuario->sexo}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span class="help-block">Fecha de Nacimiento:</span>  
                        </div>
                        <div class="col-md-8">
                            <h4>{{$usuario->fecha_nacimiento}}</h4>
                        </div>
                    </div>
                </div>
                <div id="settings" class="tab-pane">
                    <div class="row">
                        <div class="col-md-4">
                            <span class="help-block">Telefono Fijo:</span>  
                        </div>
                        <div class="col-md-8">
                            <h4>{{$usuario->tel_fijo}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span class="help-block">Celular:</span>  
                        </div>
                        <div class="col-md-8">
                            <h4>{{$usuario->celular}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span class="help-block">Dirección:</span>  
                        </div>
                        <div class="col-md-8">
                            <h4>{{$usuario->direccion}}</h4>
                        </div>
                    </div>

                </div>
                <div id="email" class="tab-pane">
                    <span class="help-block">Email:</span>  <h4>{{$usuario->email}}</h4>
                </div>
                <div id="events" class="tab-pane">
                    <h4>Ultimo prestamo o prestamos pendientes</h4>
                </div>
            </div>

        </div>
        
    </div>

    <div class="wizard-card"  data-cardname="seleccion"> 
        <div class="row">
        <div class="col-md-12"><h3>Seleccione Libros</h3></div>
        <div class="col-md-8"><div id="alertaslibro" class="alertaswizard"><div class="alert alert-dismissable">&nbsp;</div></div></div>
        <div class="col-md-4" > 
            <span class="pull-right">Total:
            <span class="glyphicon glyphicon-book" aria-hidden="true" style="font-size:20px;"></span> 
            <span id="totalArticulos" class="badge badge-notify">0</span>
            </span>
        </div>    
      </div>

        

        <div class="wizard-input-section">            
            <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control"  name="codigo" id="codigo" required autofocus placeholder="Buscar..."  data-validate="tienelibros">
                  <span class="input-group-btn">
                    <button id="adicionararticulo" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                  </span>
                </div>                
            </div>
        </div>

        <div class="row">
            <div class="col-md-4  col-md-offset-1">
                <div class="btn btn-info btn-block" id="buscar1TagLibro">
                    <span class="glyphicon glyphicon-play" id="imagenEstado" aria-hidden="true"></span>
                    <span id="connectionStatus">Leer 1 libro</span>
                </div>
            </div>

        </div><!--<div class="col-md-4  col-md-offset-2">
                <div class="btn btn-info btn-block" id="buscarTagLibros">
                    <span class="glyphicon glyphicon-play" id="imagenEstado" aria-hidden="true"></span>
                    <span id="connectionStatus">Leer continuamente</span>
                </div>
            </div>-->

        </br>
        

        <table id="articulosprestamo" class="table table-condensed">
            <th>Placa</th><th>Titulo</th><th>Fecha Entrega</th><th>Quitar</th>
        </table>        

      
    </div>

            <div class="wizard-card">
                <h3>Observaciones</h3>

                <div class="wizard-input-section">
                    <p>Observaciones del prestamo</p>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="(opcional)" id="infoadicional" name="infoadicional">
                    </div>
                </div>


                <div class="wizard-error">
                    <div class="alert alert-error">
                        <strong>Ocurrió un problema</strong> con su información.
                        Por favor revise la información e intente guardar nuevamente.
                    </div>
                </div>
    
                <div class="wizard-failure">
                    <div class="alert alert-error">
                        <strong>Ocurrió un problema</strong> al guardar el formulario.
                        Por favor intente mas tarde.
                    </div>
                </div>
    
                <div class="wizard-success">
                    <div class="alert alert-success">
                        <span class="create-server-name"></span>Operación realizada <strong>Correctamente.</strong>
                    </div>
    
                    <a class="btn btn-default create-another-server">Imprimir</a>
                    <span style="padding:0 10px"> o </span>
                    <a class="btn btn-success im-done">Terminar</a>
                </div>
            </div>


</div>






@stop