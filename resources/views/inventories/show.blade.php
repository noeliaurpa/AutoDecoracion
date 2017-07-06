@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($inventor))
  <h1>Mostrando Artículos del inventario</h1>
  <p>El artículo solicitado no existe</p>
  @else
  <h1 style="text-align: center;"> {{ $inventor->article->name }}</h1>

  <div class="form-group">
    <label>Nombre del artículo:</label>
    <input readonly="true" type="text" class="form-control" value="{{ $inventor->article->name }}">
  </div>
  <div class="form-group">
    <label>Código del artículo: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $inventor->article->code  }}">
  </div>
  <div class="form-group">
    <label>Precio de venta: </label>
    <input readonly="true" type="text" class="form-control" value="₡{{ $inventor->article->sale_price }}">
  </div>
  <div class="form-group">
    <label>Cantidad: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $inventor->article->unit_or_quantity }}">
  </div>
  @endif

  <a href="{{ url('/inventory') }}"
  class="btn btn-primary">
  Ver todos los artículos del inventario
</a>
</div>
@stop
