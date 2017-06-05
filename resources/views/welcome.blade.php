<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Auto Decoracion Palmares</title>

  <!-- Fonts -->
  <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/css.css') }}" rel="stylesheet">
  <link href="{{ asset('js/bootstrap.min.js') }}" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body> 
  <nav class="navbar navbar-default home">
    <div class="container-fluid">
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
            <a class="btn btn-default linksHomeH" href="{{ url('/home') }}">Home</a>
            @else
            <a class="btn btn-default linksHome" href="{{ url('/login') }}">Iniciar Sesion</a>
            @endif
          </div>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <div class="flex-center position-ref full-height">


    <div class="jumbotron">
      <div class="content">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              <img class="imgs img-responsive" src="img/logo.jpg" alt="Logo">
            </div>

            <div class="item">
              <img class="imgs" src="http://i534.photobucket.com/albums/ee347/Tillor87/Palmares/DSC07989.jpg" alt="Prque">
            </div>

            <div class="item">
              <img class="imgs" src="img/logo.jpg" alt="Logo">
            </div>
          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next" >
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-default" id="footer">
</div> 
</body>
</html>
