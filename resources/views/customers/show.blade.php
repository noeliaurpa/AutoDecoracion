@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($cliennt))
  <h1>Mostrando Clientes</h1>
  <p>El cliente solicitado no existe</p>
  @else
  <h1 style="text-align: center;">{{ $cliennt->name }}</h1>
  @if($cliennt->provider_id == null)
  <div class="form-group">
    <label>Nombre del proveedor: </label>
    <input readonly="true" type="text" class="form-control" value="">
  </div>
  @else
  <div class="form-group">
    <label>Nombre del proveedor: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $cliennt->proveer->name }}">
  </div>
  @endif
  <div class="form-group">
    <label>Nombre: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $cliennt->name }}">
  </div>
  <div class="form-group">
    <label>Telefono: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $cliennt->tell }}">
  </div>
  <div class="form-group">
    <label>Observacion: </label>
    <input readonly="true" type="text" class="form-control" value="{{ $cliennt->observation }}">
  </div>
  @endif


  <a href="{{ url('/customers') }}"
  class="btn btn-primary">
  Ver todos los clientes
</a>
</div>
@stop
