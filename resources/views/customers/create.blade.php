@extends('layouts.appLR')

@section('content')
@parent

<div class="col-md-5">
	<h1>Nuevo Cliente</h1>
	<hr>
</div>
<div class="col-md-7">
	<form action=" {{ url('/customers') }}" method="post">
		<input type="hidden" name="_token"
		value="{{ csrf_token() }}">
		@include('customers.partials.form',['submitButtonText'=>'Agregar'])
	</form>
	@include('errors.list')
</div>

@stop
