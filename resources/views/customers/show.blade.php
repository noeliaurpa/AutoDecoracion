@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($cliennt))
  <h1>Mostrando Clientes</h1>
  <p>El cliente solicitado no existe</p>
  @else
  <h1 style="text-align: center;">Mostrando: {{ $cliennt->name }}</h1>
  @if($cliennt->provider_id == null)
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Nombre del proveedor: </span>
    <input readonly="true" type="text" class="form-control inputP" value="">
  </div>
  @else
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Nombre del proveedor: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $cliennt->proveer->name }}">
  </div>
  @endif
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Nombre: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $cliennt->name }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Telefono: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $cliennt->tell }}">
  </div>
  <br>
  <div class="input-group">
    <span class="input-group-addon spanP" id="basic-addon1">Observacion: </span>
    <input readonly="true" type="text" class="form-control inputP" value="{{ $cliennt->observation }}">
  </div>
  <br>
  @endif


  <a href="{{ url('/customers') }}"
  class="btn btn-primary">
  Ver todos los clientes
</a>
</div>
@stop
