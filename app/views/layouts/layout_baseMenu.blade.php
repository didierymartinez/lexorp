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
    padding-top: 40px;
}

 
    </style>
</head>
<body>
    
<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">

      <div class="container">
     



        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{URL::to('/home')}}"><span class="glyphicon glyphicon-home"></span>  </a>
          
          <!-- MENU APLICACION -->
          <!-- USUARIOS -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/user') }}}">
                    <span class="glyphicon glyphicon-user"></span> Usuarios<span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="{{URL::to('users')}}">Crear</a></li>
                    <li><a href="{{URL::to('roles')}}">Actualizar</a></li>
                    <li><a href="{{URL::to('roles')}}">Inactivar</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="{{URL::to('roles')}}">Informes</a></li>
                  </ul>
                </li>                                    
              </ul>    

          <!-- LIBROS -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/user') }}}">
                    <span class="glyphicon glyphicon-th-list"></span> Libros<span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="{{URL::to('users')}}">Crear</a></li>
                    <li><a href="{{URL::to('roles')}}">Actualizar</a></li>
                    <li><a href="{{URL::to('roles')}}">Inactivar</a></li>
                    <li><a href="{{URL::to('roles')}}">Relacionar con Tags</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="{{URL::to('roles')}}">Inventarios</a></li>
                  </ul>
                </li>                                    
              </ul>    


          <!-- TAGS -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/user') }}}">
                    <span class="glyphicon glyphicon-tags"></span> Tags<span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="{{URL::to('users')}}">Crear</a></li>
                    <li><a href="{{URL::to('roles')}}">Actualizar</a></li>
                    <li><a href="{{URL::to('roles')}}">Inactivar</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="{{URL::to('roles')}}">Informes</a></li>
                  </ul>
                </li>                                    
              </ul>  


          <!-- PRESTAMOS -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/user') }}}">
                    <span class="glyphicon glyphicon-retweet"></span> Prestamos<span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="{{URL::to('users')}}">Prestamos</a></li>
                    <li><a href="{{URL::to('roles')}}">Devoluciones</a></li>
                    <li><a href="{{URL::to('roles')}}">Informes</a></li>
                    <li><a href="{{URL::to('roles')}}">Historico de Prestamos</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="{{URL::to('roles')}}">Alertas</a></li>
                  </ul>
                </li>                                    
              </ul>  

        </div>      

     


        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">


                  @if (Entrust::hasRole('admin'))                    
                  <li class="dropdown {{ (Request::is('admin/user*|admin/role*') ? ' active' : '') }}">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/user') }}}">
                      <span class="glyphicon glyphicon-cog"></span> Configurar<span class="caret"></span>
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
        </div><!-- /.nav-collapse -->

      </div><!-- /.container -->    
  </div>
  <div class="container">
   @if(Session::has('message'))
       <div class="alert {{ Session::get('message')['type']  }} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>{{ Session::get('message')["title"]  }}</strong> {{ Session::get('message')["message"]  }}
      </div>
    @endif
    @yield('content')
  </div>
</body>
</html>