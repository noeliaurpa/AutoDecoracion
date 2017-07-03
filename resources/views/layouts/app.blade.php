<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Auto Decoracion Palmares</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css.css') }}" rel="stylesheet">
    <link href="{{ asset('js/app.js') }}" rel="stylesheet">
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default home">
          <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img class="logo" type="image" src="{{ asset('img/logo.jpg') }}"></a>
            </div>

            <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="true">

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right" style="margin: 7px;">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <div class="top-right links">
                        <a class="btn btn-default linksHome" href="{{ route('login') }}">Iniciar Sesion</a>
                        <!--a class="btn btn-default linksHome" href="{{ route('register') }}">Registrar</a-->
                    </div>
                    @else 

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                           {{ Auth::user()->name }} <span class="caret"></span>
                       </a>
                       @if (Auth::user()->workstation == "Administrador")
                       <ul class="dropdown-menu" role="menu">
                        <li class = "lipadding dropdown"><a class="btn btn-default linksHome" href="{{ route('register') }}">Registrar</a></li>
                        <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('Providers/')}}" role="button">Proveedores</a> </li>
                        <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('articles/')}}" role="button">Articulos</a> </li>
                        <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('customers/')}}" role="button">Clientes</a> </li>
                        <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('vehicles/')}}" role="button">Vehículos</a> </li>
                        <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('Providers/')}}" role="button">Inventario</a> </li>
                        <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('invoices/')}}" role="button">Facturas</a> </li>
                        <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('Providers/')}}" role="button">Caja Chica</a> </li>
                        <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('Providers/')}}" role="button">Notificaciones</a> </li>
                        <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('Providers/')}}" role="button">Reportes</a> </li>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Cerrar Sesion
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @else 
                    <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('Providers/')}}" role="button">Proveedores</a> </li>
                    <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('articles/')}}" role="button">Articulos</a> </li>
                    <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('customers/')}}" role="button">Clientes</a> </li>
                    <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('vehicles/')}}" role="button">Vehículos</a> </li>
                    <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('Providers/')}}" role="button">Inventario</a> </li>
                    <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('invoices/')}}" role="button">Facturas</a> </li>
                    <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('Providers/')}}" role="button">Caja Chica</a> </li>
                    <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('Providers/')}}" role="button">Notificaciones</a> </li>
                    <li class = "lipadding dropdown"><a class="menuPrincipal" href="{{ URL::to('Providers/')}}" role="button">Reportes</a> </li>
                    <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Cerrar Sesion
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            @endif
        </li>
        @endif
    </ul>
</div>
</div>
</nav>
</div>
<div class="row ancho">
    <div class="container barra">

        <!-- Sección de contenido principal -->
        @yield('content')
    </div>
</div>

@section('footer')

<!-- JavaScripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
@show

</body>
</html>
