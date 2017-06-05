@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($vehiclee))
  <h1>Mostrando Clientes</h1>
  <p>El cliente solicitado no existe</p>
  @else
  <h1 style="text-align: center;">Mostrando: {{ $vehiclee->license_plate_or_detail   }}</h1>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Nombre del cliente: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $vehiclee->clieen->name }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Placa: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $vehiclee->license_plate_or_detail  }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Marca: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $vehiclee->brand }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Modelo: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $vehiclee->model }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Observacion: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $vehiclee->observation }}">
  </div>
  <br>
  @endif


  <a href="{{ url('/vehicles') }}"
  class="btn btn-primary">
  Ver todos los vehiculos
</a>
</div>
@stop
