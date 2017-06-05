@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($provideer))
  <h1>Mostrando Proveedor</h1>
  <p>El proveedor solicitado no existe</p>
  @else
  <h1 style="text-align: center;">Mostrando: {{ $provideer->name }}</h1>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Nombre: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $provideer->name }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Numero: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $provideer->number_provider }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Direccion: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $provideer->address_provider }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Correo Electronico: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $provideer->email }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Telefono de fax: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $provideer->fax_provider }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Observacion: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $provideer->observation }}">
  </div>
  <br>
  @endif


  <a href="{{ url('/Providers') }}"
  class="btn btn-primary">
  Ver todos los proveedores
</a>
</div>
@stop
