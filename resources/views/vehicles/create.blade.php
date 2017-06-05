@extends('layouts.appLR')

@section('content')
@parent

<div class="col-md-5">
	<h1>Nuevo Vehículo</h1>
	<hr>
</div>
<div class="col-md-7">
	<form action=" {{ url('/vehicles') }}" method="post">
		<input type="hidden" name="_token"
		value="{{ csrf_token() }}">
		@include('vehicles.partials.form',['submitButtonText'=>'Agregar'])
	</form>
	@include('errors.list')
</div>

@stop
