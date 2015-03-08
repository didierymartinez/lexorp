@extends('layouts.layout_base')
 
@section('title')
    Catalogo de Libros
@stop

@section('head')
@parent
{{ HTML::style('css/wizard.css')}}
{{ HTML::style('chosen/chosen.css')}}
{{ HTML::style('css/bootstrap-table.min.css')}}
{{ HTML::script('js/bootstrap-table.min.js') }}
@stop


@section('content')
       
        @if(Entrust::can('crear_usuarios'))
            <button type="submit" class="btn btn-success" id="crearlibro">
                <i class="glyphicon glyphicon-plus-sign "></i> Crear
            </button>
            


    <div class="wizard" id="libros-wizard" data-title="Adicionar Libro">
          
            <div class="wizard-card" data-cardname="Titulo">
                <h3>Título</h3>

                <div class="wizard-input-section">
                    Título Principal
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input type="hidden" class="form-control" id="id" name="id" >
                            <input type="text" class="form-control" id="titulo" name="titulo" data-validate="Requerido", autofocus>
                        </div>
                    </div>
                </div>

                <div class="wizard-input-section">
                    Subtítulo

                    <div class="form-group">
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" class="form-control" id="subtitulo" name="subtitulo" />                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wizard-input-section">
                    Título Idioma Original
                    <div class="form-group">
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" class="form-control" id="titulooriginal" name="titulooriginal" />                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wizard-card wizard-card-overlay" data-cardname="Autor">
                <h3>Autor</h3>

                <div class="wizard-input-section">
                    <p>
                        Puede seleccionar uno o varios Autores.
                    </p>

                    {{ Form::select('autores', $Autores, null, array(
                            'id' => 'autores',
                            'class' => 'chzn-select form-control', 
                            'data-validate' => 'Requerido',
                            'data-placeholder' => 'Lista de Autores', 
                            'style' => 'width:350px;',
                            'multiple',                             
                            'required' => 'required')) 
                    }}                 
                </div>
            </div>

            <div class="wizard-card wizard-card-overlay" data-cardname="Edicion">
                <h3>Editorial</h3>

                <div class="wizard-input-section">
                     {{ Form::select('editorial_id', $Editoriales, null, array(
                            'id' => 'editorial_id',
                            'class' => 'chzn-select form-control', 
                            'data-validate' => 'Requerido',
                            'data-placeholder' => 'Editoariales', 
                            'style' => 'width:350px;', 
                            'required' => 'required')) 
                    }}  
                </div>

                <div class="wizard-input-section">
                    <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Año</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="anoedicion" name="anoedicion">
                        </div>
                        <label for="edicion" class="col-sm-3 control-label">Edición</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edicion" name="edicion">
                        </div>
                        <label for="isbn" class="col-sm-3 control-label">ISBN</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="isbn" name="isbn">
                        </div>
                        <label for="coleccion" class="col-sm-3 control-label">Colección</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="coleccion" name="coleccion">
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

        @endif
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
                    <th data-field="NombreEditorial" data-sortable="true">Editorial</th>
                    <th data-field="isbn" data-sortable="true">ISBN</th>
                    <th data-field="coleccion" data-sortable="true" data-visible="false">Colección</th>
                    <th data-field="created_at" data-sortable="true" data-visible="false"> Creado</th>
                    
                </tr>
            </thead>
        </table>


{{ HTML::script('js/bootbox.min.js') }}
{{ HTML::script('js/utilidades.js') }}
{{ HTML::script('chosen/chosen.jquery.js') }}
{{ HTML::script('js/libros/crud.js') }}


@stop