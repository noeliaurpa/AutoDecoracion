@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($provideer))
  <h1>Mostrando Proveedor</h1>
  <p>El proveedor solicitado no existe</p>
  @else
  <h1 style="text-align: center;">{{ $provideer->name }}</h1>
  <div class="form-group">
    <label>Nombre: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $provideer->name }}">
  </div>
  <div class="form-group">
    <label>Número de teléfono: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $provideer->number_provider }}">
  </div>
  <div class="form-group">
    <label>Dirección: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $provideer->address_provider }}">
  </div>
  <div class="form-group">
    <label>Correo Electrónico: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $provideer->email }}">
  </div>
  <div class="form-group">
    <label>Teléfono de fax: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $provideer->fax_provider }}">
  </div>
  <div class="form-group">
    <label>Observación: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $provideer->observation }}">
  </div>
  <br>
  @endif

  <a href="{{ url('/Providers') }}"
  class="btn btn-primary">
  Ver todos los proveedores
</a>
</div>
@stop
