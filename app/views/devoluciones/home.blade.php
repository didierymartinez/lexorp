@extends('layouts.layout_base')
 
@section('title')
    Crear Prestamo
@stop

@section('head')
@parent

    {{ HTML::script('js/libros/devoluciones.js') }}

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
        #alertaslibro .alert {padding: 4px;}
        .badge-notify{background:rgb(0, 136, 204);  position:relative;  top: -20px;  left: -7px; }
    </style>
@stop



@section('content')


<div class="wizard" id="devoluciones-wizard" data-title="Realizar Devolución">
            

    <div class="wizard-card"  data-cardname="seleccion"> 
        <div class="row">
        <div class="col-md-12"><h3>Seleccione Libros</h3></div>
        <div class="col-md-8"><div id="alertaslibro"><div class="alert alert-dismissable">&nbsp;</div></div></div>
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

        

        <table id="articulosDevolucion" class="table table-condensed">
            <th>Placa</th><th>Titulo</th><th>Fecha</th><th>Quitar</th>
        </table>        

      
    </div>

            <div class="wizard-card">
                <h3>Observaciones o Multas</h3>

                <div class="wizard-input-section">
                    <p>Multas</p>

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