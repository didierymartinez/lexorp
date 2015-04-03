@extends('layouts.layout_base')

@section('title')
Usuarios Biblioteca
@stop

@section('head')
@parent
@stop


@section('content')

<h2>Usuarios Biblioteca</h2>
@if(Entrust::can('crear_usuarios'))
<button type="submit" class="btn btn-success" id="crearusuario">
 <i class="glyphicon glyphicon-plus-sign "></i> Crear
</button>
@endif   

<div class="wizard" id="usuarios-wizard" data-title="Adicionar Usuario">

   <div class="wizard-card" data-cardname="Titulo">
      <h3>Datos Personales</h3>
      <!-- <div class="col-sm-4 user-image">
         <img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfp1/v/t1.0-1/c23.0.135.135/1653984_10152228375391427_156457130_n.jpg?oh=8b242d31a41f9a670d72512ff0497a4c&oe=5560615B&__gda__=1431785571_749377786dff582c212c8e928d5521ad"
         class="img-circle">
      </div> -->

      <div class="span4">
         <div class="bs-callout bs-callout-info" id="callout-glyphicons-location">
            <!-- <button type="button" class="btn btn-default btn-md">
               <span class="glyphicon glyphicon-camera" aria-hidden="true"></span> Tomar
            </button>
            <button type="button" class="btn btn-default btn-md">
               <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Subir
            </button> -->
         </div>            
      </div>

      <br>
      <div class="wizard-input-section">
         <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">                        
               <div class="form-group">
                  Identificación
                  <input type="hidden" class="form-control" id="id" name="id" >
                  <input type="text" name="identificacion" id="identificacion" class="form-control input-sm" >
               </div> 
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">                        
               <div class="form-group">
                  <div class="col-xs-4 col-sm-4 col-md-4">
                     Tipo
                     {{ Form::select('tipoidentificacion', $tiposidentificacion, null, array(
                     'id' => 'tipoidentificacion',
                     'class' => 'chzn-select form-control', 
                     'data-validate' => 'Requerido',
                     'data-placeholder' => 'Tipo Identificacion', 
                     'style' => 'width:200px;', 
                     'required' => 'required')) 
                     }}
                     
                  </div>
               </div> 
            </div>
         </div>

         <div class="row">                        
            <div class="col-xs-6 col-sm-6 col-md-6">                        
               <div class="form-group">
                  Nombres
                  <input type="text" name="nombres" id="nombres" class="form-control input-sm" >
               </div> 
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">                        
               <div class="form-group">
                  Apellidos
                  <input type="text" name="apellidos" id="apellidos" class="form-control input-sm" >
               </div>
            </div>
         </div>
         <div class="row">                        
           <div class="col-xs-6 col-sm-6 col-md-6">                        
               <div class="form-group">
                  <div class="col-xs-4 col-sm-4 col-md-4">
                  Sexo
                  <select id="sexo" name="sexo" data-placeholder="Seleccione" style="width:200px;" class="chzn-select form-control">
                     <option value=""></option>
                     <option value="M">Masculino</option>
                     <option value="F">Femenino</option>
                  </select>
                  </div>
               </div> 
            </div>
             <div class="col-xs-6 col-sm-6 col-md-6">                        
                <div class="form-group">
                  Fecha Nacimiento
                  <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control input-sm" >
               </div>
            </div>
         </div>
         <br><br><br><br><br>
      </div>                    
   </div>

   <div class="wizard-card wizard-card-overlay" data-cardname="Autor">
      <h3>Datos Contacto</h3>
      <div class="wizard-input-section">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group">
                  Dirección
                  <input type="text" name="direccion" id="direccion" class="form-control input-sm" >
               </div>             
            </div>        
            <div class="col-xs-6 col-sm-6 col-md-6">                        
               <div class="form-group">
                  Telefono Fijo
                  <input type="number" name="tel_fijo" id="tel_fijo" class="form-control input-sm" >
               </div> 
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">                        
               <div class="form-group">
                  Celular
                  <input type="number" name="celular" id="celular" class="form-control input-sm" >
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group">
                  Email
                  <input type="email" name="email" id="email" class="form-control input-sm" >
               </div>             
            </div>
         </div>
      </div>
   </div>

   <div class="wizard-card">
      <h3>Adicional</h3>

      <div class="wizard-input-section">
         <p>Información Adicional</p>

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

         <a class="btn btn-default create-another-server">Crear Nuevo Usuario</a>
         <span style="padding:0 10px"> o </span>
         <a class="btn btn-success im-done">Terminar</a>
      </div>
   </div>

</div>


<br>

<table id="table-usuarios" data-toggle="table" data-url="usuariosbiblioteca" data-height="630" data-pagination="true" 
data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-row-style="rowStyle">
<thead>
  <tr>                    
    <th data-field="operate" data-formatter="operateFormatter" data-width="10" data-events="operateEvents"></th>
    <th data-field="identificacion" data-sortable="true" data-switchable="false">Identificación</th>
    <th data-field="NombreCompleto" data-sortable="true">Nombres</th>
    <th data-field="tipoidentificacionDesc" data-sortable="true">Tipo Ident.</th>
    <th data-field="sexo" data-sortable="true">Sexo</th>                    
    <th data-field="fecha_nacimiento" data-sortable="true">Fecha Nacimiento</th>
    <th data-field="direccion" data-sortable="true">Dirección</th>
    <th data-field="tel_fijo" data-sortable="true">Tel. Fijo</th>
    <th data-field="celular" data-sortable="true">Celular</th>
    <th data-field="email" data-sortable="true">Email</th>
    <th data-field="activo" data-sortable="true">Activo</th>    
 </tr>
</thead>
</table>


{{ HTML::script('js/bootbox.min.js') }}
{{ HTML::script('chosen/chosen.jquery.js') }}
{{ HTML::script('js/usuarios/crud.js') }}


@stop