@extends('layouts.appLR')

@section('content')
@parent

<div class="col-md-10 col-xs-10 visible-md visible-lg hidden-xs hidden-md">
	<h1>Nuevo Proveedor</h1>
	<hr>
	<form action=" {{ url('/Providers') }}" method="post">
		<input type="hidden" name="_token"
		value="{{ csrf_token() }}">
		@include('providers.partials.form',['submitButtonText'=>'Agregar'])
	</form>
	@include('errors.list')
</div>

@stop
