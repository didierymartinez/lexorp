@extends('layouts.layout_base')
 
@section('title')
    Crear Prestamo
@stop

@section('head')
@parent
    {{ HTML::script('js/prestamos.js') }}
    <style type="text/css">
        
        .user-image img { height: 90px;}
        
        .user-details .user-info-block {width: 76%; position: absolute; top: 12px; background: rgb(255, 255, 255); z-index: 0;}
        .user-info-block .user-heading {width: 100%; text-align: center; margin: 10px 0 0;}
        .user-info-block .navigation {float: left; width: 100%; margin: 0px; padding: 0; list-style: none; border: 1px solid #333;}
        .navigation li {float: left; margin: 0; padding: 0; height: 30px}
        .navigation li a {padding: 4px 30px; float: left; height: 30px; color: #333;}
        .navigation li.active a {background: #333; color: #fff; height: 30px}
        .user-info-block .user-body {float: left; padding: 5%; width: 90%;}
        .user-body .tab-content > div {float: left; width: 100%;}
        .user-body .tab-content h4 {width: 100%; margin: 10px 0; color: #333;}
    </style>
@stop



@section('content')


<div class="row">
    <div class="col-md-3">
        <div class="row">
        <div  class="col-sm-4 user-image">
            <img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfp1/v/t1.0-1/c23.0.135.135/1653984_10152228375391427_156457130_n.jpg?oh=8b242d31a41f9a670d72512ff0497a4c&oe=5560615B&__gda__=1431785571_749377786dff582c212c8e928d5521ad"
                 alt="{{$usuario->first_name}}" title="{{$usuario->first_name}}" class="img-circle">
        </div>
            <div >
                <h3>{{$usuario->first_name  }}<br>{{$usuario->last_name}} </h3>
                <span class="help-block">{{$usuario->identificacion}}</span>
                <input type="hidden" value="{{$usuario->id}}" id="idusuario">
            </div>            
        </div>
        <div class="user-info-block">
            <ul class="navigation">
                <li class="active">
                    <a data-toggle="tab" href="#information">
                        <span class="glyphicon glyphicon-user"></span>
                    </a>
                </li>
                <li class="">
                    <a data-toggle="tab" href="#settings">
                        <span class="glyphicon glyphicon-earphone"></span>
                    </a>
                </li>
                <li class="">
                    <a data-toggle="tab" href="#email">
                        <span class="glyphicon glyphicon-envelope"></span>
                    </a>
                </li>
                <li class="">
                    <a data-toggle="tab" href="#events">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </a>
                </li>
            </ul>
            
        </div>
    </div>
    <div class="col-md-6">
        <div class="tab-content">
            <div id="information" class="tab-pane active">
                <h4>Información del usuario</h4>
            </div>
            <div id="settings" class="tab-pane">
                <h4>Telefonos</h4>
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

<br><br>

<div class="row">
  <div class="col-lg-2">
    <div class="input-group">
      <input type="text" class="form-control"  name="codigo" id="codigo" required autofocus placeholder="Buscar...">
      <span class="input-group-btn">
        <button id="adicionararticulo" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      </span>
    </div>
  </div>

<div class="col-lg-8">
<div id="alertas"></div>   
</div>


<div class="col-lg-2">
    <button id="prestamoGuardar" class="btn btn-primary" type="submit">
        <span class="glyphicon glyphicon-book" aria-hidden="true"></span> Realizar Prestamo
        <span id="totalArticulos" class="badge">0</span>
    </button> 
</div>

<br>
<br>
<br>


<table id="articulosprestamo" class="table table-condensed">
<th>ISBN</th><th>Titulo</th><th>Autor</th><th>Quitar</th>
</table>


@stop