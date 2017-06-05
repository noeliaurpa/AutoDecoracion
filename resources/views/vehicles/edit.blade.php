@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-5">
	<h1>Editando: {!! $vehiclee->license_plate_or_detail  !!}</h1>
	<hr>
	<form method="POST"	action="{{ url('/vehicles', $vehiclee->id) }}" accept-charset="UTF-8">
		<input type="hidden" name="_method" value="PATCH">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		@include('vehicles.partials.form',
		['submitButtonText'=>'Actualizar'])
	</form>
</div>
<div class="row">
	<div class="col-md-5">
		@include('errors.list')
	</div>
</div>
@stop
