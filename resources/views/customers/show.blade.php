@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">
  @if(is_null($cliennt))
  <h1>Mostrando Clientes</h1>
  <p>El cliente solicitado no existe</p>
  @else
  <h1 style="text-align: center;">{{ $cliennt->name }}</h1>
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
