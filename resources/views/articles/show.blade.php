@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($articlee))
  <h1>Mostrando Articulos</h1>
  <p>El articulo solicitado no existe</p>
  @else
  <h1 style="text-align: center;">Mostrando: {{ $articlee->name }}</h1>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Nombre del articulo: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $articlee->name }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Codigo: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $articlee->code }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Precio de venta: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $articlee->sale_price }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Precio de compra: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $articlee->purchase_price }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Unidad o Cantidad: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $articlee->unit_or_quantity }}">
  </div>
  <br>
  @endif


  <a href="{{ url('/articles') }}"
  class="btn btn-primary">
  Ver todos los articulos
</a>
</div>
@stop
