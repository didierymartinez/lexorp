@extends('layouts.layout_base')
@section('title')
    Tipo Articulos
@stop
@section('content')

  {{ Form::open(array('method' => 'get', 'route' => array('tiposarticulos.create'))) }}
  <button type="submit" class="btn btn-success ">
      <i class="glyphicon glyphicon-plus-sign "></i> Crear
  </button>
  {{ Form::close() }}

   <br>
 
  <table class="table table-condensed">
    <thead>
        <tr><th>Tipo</th></tr>
    </thead>
    @if(isset($tiposarticulos))
    <tbody>
      @foreach($tiposarticulos as $tipoarticulos)
      <tr>
        <td>{{ $tipoarticulos->Tipo }}</td>
        <td>                                            
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <span class="glyphicon glyphicon-cog"></span> Acción
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li>
                {{ Form::open(array('method'=> 'GET', 'route' => array('tiposarticulos.edit', $tipoarticulos->id))) }}
                {{ Form::submit('Editar', array('class'=> 'btn btn-link')) }}
                {{ Form::close() }}
              </li>
              <li>
                {{ Form::open(array('method'=> 'DELETE', 'route' => array('tiposarticulos.destroy', $tipoarticulos->id))) }}
                {{ Form::submit('Eliminar', array('class'=> 'btn btn-link')) }}
                {{ Form::close() }}
              </li>
            </ul>
          </div>          
        </td>
      </tr>
      @endforeach
    </tbody>
    @endif
  </table>
  
  
@stop