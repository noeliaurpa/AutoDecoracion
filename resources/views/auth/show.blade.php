@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($articlee))
  <h1>Mostrando Articulos</h1>
  <p>El articulo solicitado no existe</p>
  @else
  <h1 style="text-align: center;">{{ $articlee->name }}</h1>
  <div class="form-group">
    <label>Nombre del articulo: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $articlee->name }}">
  </div>
  <div class="form-group">
    <label>Codigo: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $articlee->code }}">
  </div>
  <div class="form-group">
    <label>Precio de venta: </label>
    <input readonly="true" type="text" class="form-control" value="₡{{ $articlee->sale_price }}">
  </div>
  <div class="form-group">
    <label>Precio de compra: </label>
    <input readonly="true" type="text" class="form-control" value="₡{{ $articlee->purchase_price }}">
  </div>
  <div class="form-group">
    <label>Unidad o Cantidad: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $articlee->unit_or_quantity }}">
  </div>
  @endif

  <a href="{{ url('/articles') }}"
  class="btn btn-primary">
  Ver todos los articulos
</a>
</div>
@stop
