<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Auto Decoracion Palmares</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="{{ asset('css/css.css') }}" rel="stylesheet">
  <link href="{{ asset('js/bootstrap.min.js') }}" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body> 
  <nav class="navbar navbar-default home">
    <div class="container-fluid homeCc">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand linka" href="/">AUTODECORACION PALMARES</a>
      </div>

      <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="true">
        <ul class="nav navbar-nav navbar-right" style="margin: 0% 7px 0% 0%;">
          @if (Route::has('register'))
          <div class="top-right links">
            @if (Auth::check())
            <a class="btn btn-primary linksHome" href="{{ url('/home') }}">Home</a>
            @else
            <a class="btn btn-primery linksHome" href="{{ url('/login') }}">Iniciar Sesion</a>
            @endif
          </div>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <div class="flex-center position-ref full-height">


    <div class="content">
      <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
        <!-- Overlay -->
        <div class="overlay"></div>

        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
        </ol>
        
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item slides active">
            <div class="slide-1"></div>
            <div class="hero">
              <hgroup>
                <h1>Estamos ubicados:</h1>        
                <h3>100 metros este de la concretera Palmares</h3>
              </hgroup>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
  <div class="navbar navbar-default" id="footer">
</div> 
</body>
</html>