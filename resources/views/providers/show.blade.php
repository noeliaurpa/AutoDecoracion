@extends('layouts.appLR')

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
    <label>Numero: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $provideer->number_provider }}">
  </div>
  <div class="form-group">
    <label>Direccion: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $provideer->address_provider }}">
  </div>
  <div class="form-group">
    <label>Correo Electronico: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $provideer->email }}">
  </div>
  <div class="form-group">
    <label>Telefono de fax: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $provideer->fax_provider }}">
  </div>
  <div class="form-group">
    <label>Observacion: </label>
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
