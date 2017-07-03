@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($vehiclee))
  <h1>Mostrando Clientes</h1>
  <p>El cliente solicitado no existe</p>
  @else
  <h1 style="text-align: center;">Vehiculo placa: {{ $vehiclee->license_plate_or_detail }}</h1>

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
    <label>Observacion: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $vehiclee->observation }}">
  </div>
  @endif

  <a href="{{ url('/vehicles') }}"
  class="btn btn-primary">
  Ver todos los vehiculos
</a>
</div>
@stop
