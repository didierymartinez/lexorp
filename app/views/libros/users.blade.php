@extends('layouts.layout_base')
 
@section('title')
    Usuarios Sistema
@stop



@section('content')
       
        @if(Entrust::can('crear_usuarios'))
            {{ Form::open(array('method' => 'get', 'route' => array('users.create'))) }}
            <button type="submit" class="btn btn-success ">
                <i class="glyphicon glyphicon-plus-sign "></i> Crear
            </button>
            {{ Form::close() }}
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


@stop