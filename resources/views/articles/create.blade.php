@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent

<div class="col-md-10 col-xs-10 visible-md visible-lg hidden-xs hidden-md">
	<h1>Nuevo Articulo</h1>
	<hr>
	<form action=" {{ url('/articles') }}" method="post">
		<input type="hidden" name="_token"
		value="{{ csrf_token() }}">
		@include('articles.partials.form',['submitButtonText'=>'Agregar'])
	</form>
	@include('errors.list')
</div>
<script type="text/javascript">

</script>
@stop
