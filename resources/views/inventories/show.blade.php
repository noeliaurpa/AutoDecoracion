@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($inventor))
  <h1>Mostrando Articulos del inventario</h1>
  <p>El articulo solicitado no existe</p>
  @else
  <h1 style="text-align: center;"> {{ $inventor->article->name }}</h1>

  <div class="form-group">
    <label>Nombre del articulo:</label>
    <input readonly="true" type="text" class="form-control" value="{{ $inventor->article->name }}">
  </div>
  <div class="form-group">
    <label>Código del articulo: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $inventor->article->code  }}">
  </div>
  <div class="form-group">
    <label>Precio de venta: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $inventor->article->sale_price }}">
  </div>
  <div class="form-group">
    <label>Cantidad: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $inventor->article->unit_or_quantity }}">
  </div>
  @endif

  <a href="{{ url('/inventory') }}"
  class="btn btn-primary">
  Ver todos los articulos del inventario
</a>
</div>
@stop
