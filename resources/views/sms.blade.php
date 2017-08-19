@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent

<div class="col-md-10 col-xs-10 visible-md visible-lg hidden-xs hidden-md">
	<div class="input-group">
		@if(Session::has('flash_message'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡ATENCIÓN!</strong> {{Session::get('flash_message')}}.
		</div>
		@endif
	</div>
	<h1>Nuevo Mensaje</h1>
	<hr>
	<form action=" {{ url('/send/create') }}" method="post">
		<input type="hidden" name="_token"
		value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-xs-10">
				<input id="nameClient" name="nameClient" class="form-control awesomplete" type="text" placeholder="nombre del cliente" data-list="#myname" data-multiple />
				<ul id="myname" hidden >
					@foreach($cliennt as $key)
					<li id="nameC" name="{{ $key->id }}" value="{{ $key->name }}">{{$key->name}}</li>
					@endforeach 
				</ul>
			</div>
			<div class="col-xs-2">
				<input id="tellClient" name="tellClient" class="form-control" type="text" placeholder="numero de telefono" readonly>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-10">
				<input id="message" name="message" class="form-control awesomplete" type="text" placeholder="mensaje" data-list="#mymessage" data-multiple />
				<ul id="mymessage" hidden >
					@foreach($mesage as $key)
					<li id="messaje" name="{{ $key->id }}" value="{{ $key->message }}">{{$key->message}}</li>
					@endforeach 
				</ul>
			</div>
			<div class="col-xs-2">
				<button onclick="disabled = true;this.form.submit()" type="submit" class="btn btn-primary form-control">Enviar mensaje</button>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-12">
				<a class="btn btn-danger" href="{{ URL::to('message/') }}">Cancelar</a>
			</div>
		</div>
	</form>
	@include('errors.list')
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
//esto quiere decir que si se selecciona una opcion del input que tiene el id license
document.getElementById('nameClient').addEventListener('awesomplete-selectcomplete',function(){
	//coloco en una variable todos los vehículos y los clientes que vienen del controlador
	var client = "{{$cliennt}}";
	//les quité a las variables de arriba las comillas que traia
	var cli = client.split("&quot;");
	// hice un for para recorrer los vehículos
	for (var i = 0; i <= cli.length; i++) {
		//si donde está seleccionado es igual al texto del input con el id license
		if(cli[i] == document.getElementById("nameClient").value){
			//coloque la marca y el modelo
			document.getElementById("tellClient").value = "506"+cli[i+4];


		}
	};
});

</script>
@stop
