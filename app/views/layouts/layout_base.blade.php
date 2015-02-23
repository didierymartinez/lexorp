<!doctype html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>
@section('head')
{{ HTML::style('bootstrap/css/bootstrap.css') }}
{{ HTML::style('css/main.css')}}
{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/main.js') }}
{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
@show

<body>
<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{URL::to('/home')}}"><span class="glyphicon glyphicon-home"></span>  </a>     
  </div>      

  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::user()->sys)                    
      <li class="dropdown {{ (Request::is('admin/user*|admin/role*') ? ' active' : '') }}">
        <a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/user') }}}">
          <span class="glyphicon glyphicon-wrench"></span> Sistema<span class="caret"></span>
        </a>
      <ul class="dropdown-menu">
        <li class="dropdown-submenu pull-left">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios Sistema</a>
          <ul class="dropdown-menu">
              @if(Entrust::can('ver_usuarios'))
              <li><a href="{{URL::to('users')}}">Usuarios</a></li>
              @endif
              @if(Entrust::can('ver_roles'))
              <li><a href="{{URL::to('roles')}}">Roles</a></li>
              @endif
          </ul>
        </li>
      </ul>
      </li>
      @endif            
      <li class="pull-right"><a href="{{URL::to('logout')}}"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>           
    </ul>    
    <span class="navbar-text pull-right"> {{ Auth::user()->first_name; }}</span> 
  </div>
</div>

<nav class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="{{URL::to('createusuario')}}">Crear</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Biblioteca <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="{{URL::to('libros')}}"><span style="font-size:16px;" class="glyphicon glyphicon-book"></span> Libros</a></li>
            <li><a href="{{URL::to('createusuario')}}"><span style="font-size:16px;" class="glyphicon glyphicon-barcode"></span> Inventario</a></li>
          </ul>
        </li>
         
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Prestamos <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-retweet"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="{{URL::to('prestamos')}}">Crear</a></li>                        
          </ul>
        </li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Configuración <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="#">Roles</a></li>
            <li><a href="./users/get">Usuarios Sistema</a></li>
            <li class="divider"></li>
            <li><a href="#">Aplicación</a></li>            
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="main">
<div class="container">
  @if(Session::has('message'))
  <div class="alert {{ Session::get('message')['type']  }} alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>{{ Session::get('message')["title"]  }}</strong> {{ Session::get('message')["message"]  }}
  </div>
  @endif


  @yield('content')
</div>

</div>


</body>
</html>