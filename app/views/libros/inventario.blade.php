@extends('layouts.layout_base')
 
@section('title')
    Inventario de Libros
@stop

@section('head')
@parent
@stop

@section('titulopagina')
    Inventario de libros
@stop


@section('content')
       


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

             <div class="wizard-card" data-cardname="Edicion">
                <h3>Editorial</h3>

                <div class="wizard-input-section">                    
                    <div class="form-group">
                        <div class="col-sm-6">
                            {{ Form::select('editorial_id', $Editoriales, null, array(
                            'id' => 'editorial_id',
                            'class' => 'chzn-select form-control', 
                            'data-validate' => 'Requerido',
                            'data-placeholder' => 'Editoariales', 
                            'style' => 'width:350px;', 
                            'required' => 'required')) 
                            }}
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


        
        <table id="table-libros" data-toggle="table" data-url="inventario" data-height="630" data-pagination="true" 
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
                    <th data-field="ejemplaresDisponibles"  data-formatter="disponiblesFormatter" data-events="totalEvents" data-sortable="true" data-switchable="false" data-align="center">Disponibles</th>
                    <th data-field="ejemplaresPrestados"  data-formatter="enprestamoFormatter" data-events="totalEvents" data-sortable="true" data-switchable="false" data-align="center">En Prestamo</th>                
                    <th data-field="ejemplaresTotal"  data-formatter="totalFormatter" data-events="totalEvents" data-sortable="true" data-switchable="false" data-align="center">Total Ejemplares</th>
                    
                    
                </tr>
            </thead>
        </table>


{{ HTML::script('js/bootbox.min.js') }}
{{ HTML::script('chosen/chosen.jquery.js') }}
{{ HTML::script('js/libros/inventario.js') }}


@stop