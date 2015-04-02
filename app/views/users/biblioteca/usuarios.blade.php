@extends('layouts.layout_base')
 
@section('title')
    Catalogo de Libros
@stop

@section('head')
@parent
@stop

<style type="text/css">
    .sexo .btn span.glyphicon {         
      opacity: 0;       
    }
    .sexo .btn.active span.glyphicon {        
      opacity: 1;       
    }
</style>

@section('content')
       
       

    <h2>Usuarios Biblioteca</h2>
         @if(Entrust::can('crear_usuarios'))
            <button type="submit" class="btn btn-success" id="crearlibro">
                <i class="glyphicon glyphicon-plus-sign "></i> Crear
            </button>
         @endif   


    <div class="wizard" id="libros-wizard" data-title="Adicionar Usuario">
          
            <div class="wizard-card" data-cardname="Titulo">
                <h3>Datos Personales</h3>

        <div class="col-sm-4 user-image">
            <img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfp1/v/t1.0-1/c23.0.135.135/1653984_10152228375391427_156457130_n.jpg?oh=8b242d31a41f9a670d72512ff0497a4c&oe=5560615B&__gda__=1431785571_749377786dff582c212c8e928d5521ad"
             class="img-circle">
        </div>

        <div class="span4">
            <div class="bs-callout bs-callout-info" id="callout-glyphicons-location">
                <button type="button" class="btn btn-default btn-md">
                  <span class="glyphicon glyphicon-camera" aria-hidden="true"></span> Tomar
                </button>
                <button type="button" class="btn btn-default btn-md">
                  <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Subir
                </button>
            </div>            
        </div>

<br>
                <div class="wizard-input-section">
                    <div class="row">                        

                        <div class="col-xs-6 col-sm-6 col-md-6">                        
                            <div class="form-group">
                                Identificación
                                <input type="hidden" class="form-control" id="id" name="id" >
                                <input type="text" name="first_name" id="identificacion" class="form-control input-sm" data-validate="Requerido">
                            </div> 
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">                        
                            <div class="form-group">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    Tipo
                                    <select data-placeholder="Seleccione" style="width:200px;" class="chzn-select form-control">
                                                <option value=""></option>
                                                <option value="CE">Cédula de Ciudadania</option>
                                                <option value="TI">Tarjeta de Identidad</option>
                                                <option value="RC">Registro Civil</option>
                                                <option value="CE">Cédula de Extranjería</option>
                                    </select>

                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="row">                        
                        <div class="col-xs-6 col-sm-6 col-md-6">                        
                            <div class="form-group">
                                Nombres
                                <input type="text" name="nombres" id="first_name" class="form-control input-sm" data-validate="Requerido">
                            </div> 
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">                        
                            <div class="form-group">
                                Apellidos
                                <input type="text" name="last_name" id="last_name" class="form-control input-sm" data-validate="Requerido">
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-xs-6 col-sm-6 col-md-6">                        
                            <div class="form-group">
                                Sexo
                                <br>
                                <div class="btn-group sexo" data-toggle="buttons">
            
                                    <label class="btn btn-primary">
                                        <input type="radio" name="options" id="option1" autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>


                                    <label class="btn btn-danger" style="background-color:#DDA5A3; border-color:#DDA5A3">
                                        <input type="radio" name="options" id="option2" autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>
                                
                                </div>
                            </div> 
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">                        
                            <div class="form-group">
                                Fecha Nacimiento
                                <input type="text" name="fechanacimiento" id="fechanacimiento" class="form-control input-sm" data-validate="Requerido">
                            </div>
                        </div>
                    </div>
                </div>                    
                

            </div>

            <div class="wizard-card wizard-card-overlay" data-cardname="Autor">
                <h3>Datos Contacto</h3>

                <div class="wizard-input-section">
                    <p>
                        Puede seleccionar uno o varios Autores.
                    </p>

                                    
                </div>
            </div>

             <div class="wizard-card" data-cardname="Edicion">
                <h3>Referencias</h3>

                <div class="wizard-input-section">                    
                    <div class="form-group">
                        <div class="col-sm-6">
                            

                        </div>
                    </div>
                </div>

                <div class="wizard-input-section">
                   <div class="form-group">
                              <label for="anoedicion" class="col-sm-2">Año</label>
                        <div class="col-sm-8">
                            <div class="input-group">

                                    <input type="text" class="form-control" id="anoedicion" name="anoedicion">
                              
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wizard-input-section">
                   <div class="form-group">                   
                        <label for="edicion" class="col-sm-2 ">Edición</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                    <input type="text" class="form-control" id="edicion" name="edicion">                            
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wizard-input-section">
                   <div class="form-group">
                        <label for="isbn" class="col-sm-2">ISBN</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                    <input type="text" class="form-control" id="isbn" name="isbn">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wizard-input-section">
                   <div class="form-group">
                        <label for="coleccion" class="col-sm-2">Colección</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                    <input type="text" class="form-control" id="coleccion" name="coleccion">
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
    
                    <a class="btn btn-default create-another-server">Crear Nuevo Libro</a>
                    <span style="padding:0 10px"> o </span>
                    <a class="btn btn-success im-done">Terminar</a>
                </div>
            </div>
            
        </div>

        
        <br>
        
        <table id="table-libros" data-toggle="table" data-url="libros" data-height="630" data-pagination="true" 
            data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1">
            <thead>
                <tr>                    
                    <th data-field="operate" data-formatter="operateFormatter" data-width="10" data-events="operateEvents"></th>
                    <th data-field="titulo" data-sortable="true" data-switchable="false">Titulo</th>
                    <th data-field="subtitulo" data-sortable="true" data-visible="false">Sub-Titulo</th>
                    <th data-field="titulooriginal" data-sortable="true" data-visible="false">Titulo Original</th>
                    <th data-field="NombresAutores" data-sortable="true">Autor</th>                    
                    <th data-field="anoedicion" data-sortable="true" data-visible="false">Año Edición</th>
                    <th data-field="edicion" data-sortable="true" data-visible="false">Edición</th>
                    <th data-field="NombreEditorial" data-sortable="true">Editorial</th>
                    <th data-field="isbn" data-sortable="true">ISBN</th>
                    <th data-field="coleccion" data-sortable="true" data-visible="false">Colección</th>
                    <th data-field="created_at" data-sortable="true" data-visible="false"> Creado</th>
                    
                </tr>
            </thead>
        </table>


{{ HTML::script('js/bootbox.min.js') }}
{{ HTML::script('chosen/chosen.jquery.js') }}
{{ HTML::script('js/usuarios/crud.js') }}


@stop