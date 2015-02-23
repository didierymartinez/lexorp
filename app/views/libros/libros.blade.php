@extends('layouts.layout_base')
 
@section('title')
    Catalogo de Libros
@stop

@section('head')
@parent
{{ HTML::style('css/wizard.css')}}
{{ HTML::style('chosen/chosen.css')}}
@stop


@section('content')
       
        @if(Entrust::can('crear_usuarios'))
            <button type="submit" class="btn btn-success" id="crearlibro">
                <i class="glyphicon glyphicon-plus-sign "></i> Crear
            </button>
            


    <div class="wizard" id="satellite-wizard" data-title="Adicionar Libro">
          
            <div class="wizard-card" data-cardname="Titulo">
                <h3>Título</h3>

                <div class="wizard-input-section">
                    Título Principal
                    <div class="form-group">
                        <div class="col-sm-6">
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
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <label for="amount" class="col-sm-3 control-label">ISBN</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="amount" name="amount">
                        </div>
                        <label for="amount" class="col-sm-3 control-label">Colección</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="amount" name="amount">
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

        @endif
        <br>
        <table class="table table-hover">
            <thead>
                <tr><th>Identificación</th><th>Nombre</th><th>Apellido</th><th>Rol</th><th>Email</th></tr>
            </thead>
            @if(isset($users))
                <tbody>
                @foreach($users as $user)
                    <tr><td>{{ $user->identificacion }}</td>                        
                        <td>{{ $user->first_name }}</td><td>{{ $user->last_name  }}</td>
                        <td>{{ $user->rol->name }}</td>
                        <td>{{ $user->email }}</td>
                        @if($user->sys != true)
                            <td>                                            
                              <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  <span class="glyphicon glyphicon-cog"></span> Acción
                                  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                  <li>
                                        @if(Entrust::can('editar_usuarios'))
                                            {{ Form::open(array('method'=> 'GET', 'route' => array('users.edit', $user->id))) }}
                                            {{ Form::submit('Editar', array('class'=> 'btn btn-link btnEditar')) }}
                                            {{ Form::close() }}
                                        @endif
                                  </li>
                                  <li>
                                        @if(Entrust::can('eliminar_usuarios'))
                                            {{ Form::open(array('method'=> 'DELETE', 'class'=>'deleteform', 'route' => array('users.destroy', $user->id))) }}
                                            {{ Form::submit('Eliminar', array('class'=> 'btn btn-link')) }}
                                        {{ Form::close() }}
                                  </li>
                                </ul>
                              </div>
                          @endif     

                            </div>
                            </td>

                       @endif
                    </tr>
                @endforeach
                    </tbody>
            @endif
        </table>


{{ HTML::script('js/utilidades.js') }}
{{ HTML::script('chosen/chosen.jquery.js') }}
{{ HTML::script('js/libros/crear.js') }}

@stop