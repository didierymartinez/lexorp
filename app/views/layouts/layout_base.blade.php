<!doctype html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>
@section('head')
{{ HTML::style('bootstrap/css/bootstrap.css') }}
{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
{{ HTML::style('css/main.css')}}
@show
<style type="text/css">
  body {
  margin-left:14%;
  }

  .sidebar-nav {
  position:fixed;
  z-index:10;
  width:14%;
  left:0px;
  bottom:0;
  top:52px; 
  overflow:auto;
  background-color: #e8e8e8;
}

.container{
  margin-top: 60px;
}


</style>
</head>
<body>
<!-- navBar-->    
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
</div><!-- /navBar-->

<!-- leftMenu-->
<div class="sidebar-nav">
<br>

<br>
<br>






<div class="block-menu" role="complementary">
   
<ul class="list-unstyled">
  <li class="nav-header active"> <a href="#" data-toggle="collapse" data-target="#userMenu" class="collapsed"><i class="glyphicon glyphicon-user"></i> Usuarios <span class="caret"></span></a>
    <ul class="list-unstyled collapse" id="userMenu" style="height: 0px;">
      <li><a href="{{URL::to('createusuario')}}">Crear</a></li>
      <li><a href="{{URL::to('roles')}}">Actualizar</a></li>
      <li><a href="{{URL::to('roles')}}">Inactivar</a></li>
      <li data-toggle="collapse" data-target="#userInfo"><a href="#glyphicons">Informes<span class="caret"></span></a>
        <ul class="nav-list collapse" id="userInfo">
          <li><a href="{{URL::to('users')}}">Prestamos</a></li>
          <li><a href="{{URL::to('users')}}">Inactivos</a></li>
        </ul>
      </li>
    </ul>
  </li>
</ul>

<ul class="list-unstyled">
  <li class="nav-header active"> <a href="#" data-toggle="collapse" data-target="#bookMenu" class="collapsed"><i class="glyphicon glyphicon-th-list"></i> Libros <span class="caret"></span></a>
    <ul class="list-unstyled collapse" id="bookMenu" style="height: 0px;">
      <li><a href="{{URL::to('users')}}">Crear</a></li>
      <li><a href="{{URL::to('roles')}}">Actualizar</a></li>
      <li><a href="{{URL::to('roles')}}">Inactivar</a></li>
      <li data-toggle="collapse" data-target="#booksInfo"><a href="#glyphicons">Informes<span class="caret"></span></a>
        <ul class="nav-list collapse" id="booksInfo">
          <li><a href="{{URL::to('users')}}">Prestamos</a></li>
          <li><a href="{{URL::to('users')}}">Inactivos</a></li>
        </ul>
      </li>
    </ul>
  </li>
</ul>

<ul class="list-unstyled">
  <li class="nav-header active"> <a href="#" data-toggle="collapse" data-target="#tagsMenu" class="collapsed"><i class="glyphicon glyphicon-tags"></i> Tags <span class="caret"></span></a>
    <ul class="list-unstyled collapse" id="tagsMenu" style="height: 0px;">
      <li><a href="{{URL::to('users')}}">Crear</a></li>
      <li><a href="{{URL::to('roles')}}">Actualizar</a></li>
      <li><a href="{{URL::to('roles')}}">Inactivar</a></li>
      <li data-toggle="collapse" data-target="#tagsInfo"><a href="#glyphicons">Informes<span class="caret"></span></a>
        <ul class="nav-list collapse" id="tagsInfo">
          <li><a href="{{URL::to('users')}}">Prestamos</a></li>
          <li><a href="{{URL::to('users')}}">Inactivos</a></li>
        </ul>
      </li>
    </ul>
  </li>
</ul>

<ul class="list-unstyled">
  <li class="nav-header active"> <a href="#" data-toggle="collapse" data-target="#prestamoMenu" class="collapsed"><i class="glyphicon glyphicon-retweet"></i> Prestamos <span class="caret"></span></a>
    <ul class="list-unstyled collapse" id="prestamoMenu" style="height: 0px;">
      <li><a href="{{URL::to('prestamos')}}">Crear</a></li>
      <li><a href="{{URL::to('roles')}}">Actualizar</a></li>
      <li><a href="{{URL::to('roles')}}">Inactivar</a></li>
      <li data-toggle="collapse" data-target="#prestamoInfo"><a href="#glyphicons">Informes<span class="caret"></span></a>
        <ul class="nav-list collapse" id="prestamoInfo">
          <li><a href="{{URL::to('users')}}">Prestamos</a></li>
          <li><a href="{{URL::to('users')}}">Inactivos</a></li>
        </ul>
      </li>
    </ul>
  </li>
</ul>


  </div>

</div>
<!-- leftMenu-->

<!-- main-->
<div class="container">
  @if(Session::has('message'))
  <div class="alert {{ Session::get('message')['type']  }} alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>{{ Session::get('message')["title"]  }}</strong> {{ Session::get('message')["message"]  }}
  </div>
  @endif
  @yield('content')
</div>
<!--/main-->

</body>
</html>