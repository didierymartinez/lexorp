@extends('layouts.layout_base')
@section('title')
    Roles
@stop
@section('head')
    @parent
        {{ HTML::style('css/multi-select.css') }}
        {{ HTML::script('js/jquery.multi-select.js') }}
        <script>
            $(document).on('ready', function(){
                
                rol_id = null;
               $('#select-permisos').multiSelect({
                    selectableHeader: "<div class='custom-header'>NO asignados</div>",
                    selectionHeader: "<div class='custom-header'>Asignados</div>",
                   afterSelect:function(value){//enviamos al servidor el id del permiso seleccionado
                        $.ajax({
                        url : '{{ URL::to("/permisos/asignar") }}',
                        type : 'GET',
                        dataType: 'json',
                        data : {permission_id: value[0], role_id: rol_id}
                    }).done(function(data){
                        console.log(data);
                    });
                   },
                   afterDeselect:function(value){//enviamos al servidor el id del permiso seleccionado
                        $.ajax({
                        url : '{{ URL::to("/permisos/desasignar") }}',
                        type : 'GET',
                        dataType: 'json',
                        data : {permission_id: value[0], role_id: rol_id}
                    }).done(function(data){
                        console.log(data);
                    });
                   }
               });
                
                
                $('.get-permisos').on('click', function(){
                    rol_id = $(this).attr('rol_id');
                    $.ajax({
                        url : '{{ URL::to("/permisos") }}',
                        type : 'GET',
                        dataType: 'json',
                        data : {id: rol_id}
                    }).done(function(data){
                        
                        $.each(data.permisosAsignados ,function(index, value){
                            $('#select-permisos option[value="'+value.id+'"]').attr('selected', true);
                        });
                        $('#select-permisos').multiSelect('refresh');
                    });
                });
            });
        </script>
@stop
@section('content')

        @if(Entrust::can('crear_roles'))
        {{ Form::open(array('method' => 'get', 'route' => array('roles.create'))) }}
        <button type="submit" class="btn btn-success ">
            <i class="glyphicon glyphicon-plus-sign "></i> Crear
        </button>
        {{ Form::close() }}
         @endif
         <br>
        <table class="table table-hover">
            <thead>
                <tr><th>Nombre</th>@if(Entrust::can('editar_roles'))<th>Permisos</th>@endif</tr>
            </thead>
            @if(isset($roles))
                <tbody>
                @foreach($roles as $rol)
                    <tr><td>{{ $rol->name }}</td>
                     @if($rol->name !='admin')   
                        @if(Entrust::can('editar_roles'))
                        <td><a data-toggle="modal" rol_id="{{ $rol->id }}" data-target="#permisos" class="btn btn-warning get-permisos">  <i class="glyphicon glyphicon-pencil"></i> Permisos</a></td>                        
                        @endif
                       <td>                                            
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <span class="glyphicon glyphicon-cog"></span> Acción
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li>
                                    @if(Entrust::can('editar_roles'))
                                        {{ Form::open(array('method'=> 'GET', 'route' => array('roles.edit', $rol->id))) }}
                                        {{ Form::submit('Editar', array('class'=> 'btn btn-link')) }}
                                        {{ Form::close() }}
                                    @endif
                              </li>
                              <li>
                                    @if(Entrust::can('eliminar_usuarios'))
                                        {{ Form::open(array('method'=> 'DELETE', 'route' => array('roles.destroy', $rol->id))) }}
                                        {{ Form::submit('Eliminar', array('class'=> 'btn btn-link')) }}
                                        {{ Form::close() }}
                                     @endif
                              </li>
                            </ul>
                          </div>
                        </div>

                        </td>
                    @endif
                    </tr>
                @endforeach
                    </tbody>
            @endif
        </table>
        
        <div class="modal" id="permisos">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Gestionar permisos</h4>
        </div>
        <div class="modal-body">
          <select id="select-permisos" multiple="multiple">
                @if(isset($permisos))
                    @foreach($permisos as $permiso)
                        <option value="{{ $permiso->id }}">{{ $permiso->display_name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
        </div>
      </div>
    </div>

    </div>

@stop