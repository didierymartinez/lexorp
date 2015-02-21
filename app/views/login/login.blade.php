<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />  
        <link rel="stylesheet" href="css/login.css" />
    </head>
    <body>
           <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <h1 class="text-center login-title">Bienvenido a Proxel</h1>
                <form class="form-signin" action="{{ url('/login') }}" method="POST">
                <input type="text" class="form-control" name="identificacion" placeholder="Identificación" required autofocus>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <div class="col-sm-12 col-md-12">
                    <div class="row">
                    @if(Session::has('message'))
                    <p class="alert alert-danger">{{ Session::get('message') }}</p>
                    @endif
                    </div>
                </div>
                <button class="btn btn-default btn-block" type="submit">
                <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> 
                    Ingresar</button>
                </form>
                <br>                                
                
            </div>


        </div>
    </div>
</div>
    </body>
</html>

