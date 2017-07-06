@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($vehiclee))
  <h1>Mostrando Clientes</h1>
  <p>El cliente solicitado no existe</p>
  @else
  <h1 style="text-align: center;">Vehículo placa: {{ $vehiclee->license_plate_or_detail }}</h1>

  <div class="form-group">
    <label>Nombre del cliente:</label>
    <input readonly="true" type="text" class="form-control" value="{{ $vehiclee->clieen->name }}">
  </div>
  <div class="form-group">
    <label>Placa: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $vehiclee->license_plate_or_detail  }}">
  </div>
  <div class="form-group">
    <label>Marca: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $vehiclee->brand }}">
  </div>
  <div class="form-group">
    <label>Modelo: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $vehiclee->model }}">
  </div>
  <div class="form-group">
    <label>Observación: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $vehiclee->observation }}">
  </div>
  @endif

  <a href="{{ url('/vehicles') }}"
  class="btn btn-primary">
  Ver todos los vehículos
</a>
</div>
@stop
