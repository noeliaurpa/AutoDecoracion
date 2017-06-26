@extends('layouts.appLR')

@section('content')
@parent

<div class="col-md-10 col-xs-10 visible-md visible-lg hidden-xs hidden-md">
	<h1>Nuevo Vehículo</h1>
	<hr>
	<form action=" {{ url('/vehicles') }}" method="post">
		<input type="hidden" name="_token"
		value="{{ csrf_token() }}">
		@include('vehicles.partials.form',['submitButtonText'=>'Agregar'])
	</form>
	@include('errors.list')
</div>

@stop
