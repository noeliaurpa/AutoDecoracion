@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">

	<h1 style="text-align:center;">Listado de mensajes</h1>
	<div class="input-group">
		@if(Session::has('flash_message'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡ATENCIÓN!</strong> {{Session::get('flash_message')}}.
		</div>
		@endif
	</div>
	<div class="input-group">
        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Excelente!</strong> {{Session::get('success_message')}}.
        </div>
        @endif
    </div>
    <div class="input-group">
        @if(Session::has('update_message'))
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Excelente!</strong> {{Session::get('update_message')}}.
        </div>
        @endif
    </div>
	<?php echo Form::open(['url' => 'message', 'method' => 'GET', 'class' => 'navbar-form pull-right']); ?>

	<div class="input-group">
		<span title="Precione enter para buscar" class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
		<?php echo Form::text('message', null, ['title' => 'Precione enter para buscar','class' => 'form-control search', 'placeholder' => 'Buscar mensaje', 'aria-describedby' => 'search']); ?>
	</div>
	<?php echo Form::close(); ?>
	<div class="table-responsive">
		@if(count($messaje)>0)
		@if (Auth::user()->workstation == "Administrador")
		<table class="table table-striped">
			<tr class="backtabletr">
				<th>Mensaje</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
			@foreach ($messaje as $notification)
			<tr class="backtabletd"> 
				{{-- Columna NOMBRE del articulo --}}
				<td>
					{{ $notification->message }}
				</td>
				{{-- Columna botón EDIT --}}
				<td>
					<a class="btn btn-warning btn-sm"
					href="{{ URL::to('message/' . $notification->id . '/edit') }}" role="button">
					<span class="glyphicon glyphicon-pencil"></span>
				</a>
			</td>
			{{-- Columna botón DELETE --}}
			<td>
				<!-- Utilizar el método DESTROY /message/{id} -->
				<form onsubmit="return confirmation()"
				action="{{ url('/message', $notification->id) }}"
				method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="_method" value="DELETE">
				<button type="submit" class="btn btn-danger btn-sm">
					<span class="glyphicon glyphicon-remove"></span>
				</button>
			</form>
		</td>
	</tr>
	@endforeach
</table>
@else
<table  class="table table-hover">
	<tr class="backtabletr">
		<th>Mensaje</th>
	</tr>
	@foreach ($messaje as $notification)
	<tr class="backtabletd"> 
		{{-- Columna NOMBRE del articulo --}}
		<td>
			{{ $notification->message }}
		</td>
	</tr>
	@endforeach
</table>
@endif
</div>
@else
<p>No se encontró ningún mensaje</p>
@endif

@if (Auth::user()->workstation == "Administrador")
<a href="{{ url('/message/create') }}"
class="btn btn-primary">
Registrar nuevo mensaje
</a>
@endif
<a href="{{ url('/send') }}"
class="btn btn-primary">
Enviar notificación al cliente
</a>
<a href="{{ url('/home') }}"
class="btn btn-primary">
Inicio
</a>

</div>
<script language="JavaScript"> 
function confirmation(){ 
    //if(confirm("Esta seguro que desea eliminar la notificación?"))
    if(confirm("ESTA SEGURO QUE DESEA ELIMINAR LA NOTIFICACIÓN?"))
    {
        return true;
    }
    return false; 
} 
</script>
@stop
