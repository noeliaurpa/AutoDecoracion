@extends('layouts.appLR')

@section('content')
@parent

<div class="col-md-5">
	<h1>Nuevo Articulo</h1>
	<hr>
</div>
<div class="col-md-7">
	<form action=" {{ url('/articles') }}" method="post">
		<input type="hidden" name="_token"
		value="{{ csrf_token() }}">
		@include('articles.partials.form',['submitButtonText'=>'Agregar'])
	</form>
	@include('errors.list')
</div>

@stop
