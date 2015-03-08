extends('layouts.layout_base')
 
@section('title')
    Crear Libros
@stop


@section('head')
@parent
{{ HTML::style('css/wizard.css')}}
{{ HTML::style('chosen/chosen.css')}}
@stop



@section('content')

 
       
    <div class="wizard" id="satellite-wizard" data-title="Gestión de Libros">
          
            <div class="wizard-card" data-cardname="Titulo">
                <h3>Título</h3>

                <div class="wizard-input-section">
                    Título Principal
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="id" name="id" >
                            <input type="text" class="form-control" id="titulo" name="titulo" data-validate="Requerido">
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
                                <input type="text" class="form-control" id="subtitulo" name="subtitulo" />                                
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
                            'class' => 'chzn-select form-control', 
                            'data-validate' => 'Requerido',
                            'data-placeholder' => 'Lista de Autores', 
                            'style' => 'width:350px;', 
                            'multiple', 'required' => 'required')) 
                    }}                 
                </div>
            </div>

            <div class="wizard-card wizard-card-overlay" data-cardname="Edicion">
                <h3>Editorial</h3>

                <div class="wizard-input-section">
                    {{ Form::select('autores', $Editoriales, null, array(
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
                        <label for="description" class="col-sm-3 control-label">Edición</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="descripcion" name="descripcion">
                        </div>
                        <label for="amount" class="col-sm-3 control-label">ISBN</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="isbn" name="isbn">
                        </div>
                        <label for="amount" class="col-sm-3 control-label">Colección</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="coleccion" name="coleccion">
                        </div>
                    </div>
                   
                </div>
            </div>

            
            <div class="wizard-card">
                <h3>Resumen</h3>

                <div class="wizard-input-section">
                    <p>Resumen del libro a crear en forma de ficha Bibliografica </p>
                </div>


                <div class="wizard-input-section">
                    <p>Información Adicional</p>

                    <div class="form-group">
                        <input type="text" class="create-server-agent-key form-control" placeholder="(opcional)" data-validate="">
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
                        <span class="create-server-name"></span>Libro Creado <strong>Correctamente.</strong>
                    </div>
    
                    <a class="btn btn-default create-another-server">Crear otro Libro</a>
                    <span style="padding:0 10px"> o </span>
                    <a class="btn btn-success im-done">Terminar</a>
                </div>
            </div>
        </div>

{{ HTML::script('js/utilidades.js') }}
{{ HTML::script('chosen/chosen.jquery.js') }}
{{ HTML::script('js/libros/crear.js') }}

@stop