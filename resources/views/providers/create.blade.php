@extends('layouts.appLR')

@section('content')
@parent

<div class="col-md-5">
	<h1>Nuevo Proveedor</h1>
	<hr>
</div>
<div class="col-md-7">
	<form action=" {{ url('/Providers') }}" method="post">
		<input type="hidden" name="_token"
		value="{{ csrf_token() }}">
		@include('providers.partials.form',['submitButtonText'=>'Agregar'])
	</form>
	@include('errors.list')
</div>

@stop
