@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($smallb))
  <h1>Mostrando Articulos de la caja chica</h1>
  <p>El articulo solicitado no existe</p>
  @else
  <h1 style="text-align: center;"> {{ $smallb->article->name }}</h1>

  <div class="form-group">
    <label>Nombre del articulo:</label>
    <input readonly="true" type="text" class="form-control" value="{{ $smallb->article->name }}">
  </div>
  <div class="form-group">
    <label>Código del articulo: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $smallb->article->code  }}">
  </div>
  <div class="form-group">
    <label>Precio de venta: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $smallb->article->sale_price }}">
  </div>
  <div class="form-group">
    <label>Cantidad: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $smallb->article->unit_or_quantity }}">
  </div>
  @endif

  <a href="{{ url('/smallbox') }}"
  class="btn btn-primary">
  Ver todos los articulos de la caja chica
</a>
</div>
@stop
