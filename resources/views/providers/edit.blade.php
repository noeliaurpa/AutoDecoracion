@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10">
	<h1>Editando: {!! $provideer->name  !!}</h1>
	<hr>
	<form method="POST"	action="{{ url('/Providers', $provideer->id) }}" accept-charset="UTF-8">
		<input type="hidden" name="_method" value="PATCH">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		@include('providers.partials.form',
		['submitButtonText'=>'Actualizar'])
	</form>
</div>
<div class="row">
	<div class="col-md-5">
		@include('errors.list')
	</div>
</div>
@stop
