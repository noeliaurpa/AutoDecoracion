@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10">
	<h1>Editando: {!! $cliennt->name  !!}</h1>
	<hr>
	<form method="POST"	action="{{ url('/customers', $cliennt->id) }}" accept-charset="UTF-8">
		<input type="hidden" name="_method" value="PATCH">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		@include('customers.partials.form',
		['submitButtonText'=>'Actualizar'])
	</form>
</div>
<div class="row">
	<div class="col-md-5">
		@include('errors.list')
	</div>
</div>
@stop
