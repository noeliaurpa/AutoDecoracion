@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">

	<h1 style="text-align:center;">Listado de vehículos</h1>
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
	<?php echo Form::open(['url' => 'vehicles', 'method' => 'GET', 'class' => 'navbar-form pull-right']); ?>

	<div class="input-group">
		<span title="Precione enter ara buscar" class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
		<?php echo Form::text('license_plate_or_detail', null, ['title' => 'Precione enter para buscar','class' => 'form-control search', 'placeholder' => 'Buscar vehiculos', 'aria-describedby' => 'search']); ?>
	</div>
	<?php echo Form::close(); ?>
	<div class="table-responsive">
		@if(count($vehiclee)>0)
		@if (Auth::user()->workstation == "Administrador")
		<table class="table table-striped">
			<tr class="backtabletr">
				<th>Nombre del cliente</th>
				<th>Placa</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Observación</th>
				<th>ver</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
			@foreach ($vehiclee as $car)
			<tr class="backtabletd"> 
				{{-- Columna DATOS del Vehiculo --}}
				<td>
					{{ $car->client->name }}
				</td>
				<td>
					{{ $car->license_plate_or_detail }}
				</td>
				<td>
					{{ $car->brand }}
				</td>
				<td>
					{{ $car->model }}
				</td>
				<td>
					{{ $car->observation }}
				</td>
				{{-- Columna botón SHOW --}}
				<td>
					<a class="btn btn-default btn-sm"
					href="{{ URL::to('vehicles/' . $car->id) . '/show' }}" role="button">
					<span class="glyphicon glyphicon-eye-open"></span>
				</a>
			</td>
			{{-- Columna botón EDIT --}}
			<td>
				<a class="btn btn-default btn-sm"
				href="{{ URL::to('vehicles/' . $car->id . '/edit') }}" role="button">
				<span class="glyphicon glyphicon-pencil"></span>
			</a>
		</td>
		{{-- Columna botón DELETE --}}
		<td>
			<!-- Utilizar el método DESTROY /vehicles/{id} -->
			<form
			action="{{ url('/vehicles', $car->id) }}"
			method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="DELETE">
			<button type="submit" class="btn btn-default btn-sm">
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
		<th>Nombre del cliente</th>
		<th>Placa</th>
		<th>Marca</th>
		<th>Modelo</th>
		<th>Observación</th>
		<th>ver</th>
	</tr>
	@foreach ($vehiclee as $car)
	<tr class="backtabletd"> 
		{{-- Columna DATOS del Vehiculo --}}
		<td>
			{{ $car->client->name }}
		</td>
		<td>
			{{ $car->license_plate_or_detail }}
		</td>
		<td>
			{{ $car->brand }}
		</td>
		<td>
			{{ $car->model }}
		</td>
		<td>
			{{ $car->observation }}
		</td>
		{{-- Columna botón SHOW --}}
		<td>
			<a class="btn btn-prin btn-sm"
			href="{{ URL::to('vehicles/' . $car->id) . '/show' }}" role="button">
			<span class="glyphicon glyphicon-eye-open"></span>
		</a>
	</td>
</tr>
@endforeach
</table>
@endif
</div>
@else
<p>No se encontró ningún registro de vehiculos</p>
@endif

@if (Auth::user()->workstation == "Administrador")
<a href="{{ url('/vehicles/create') }}"
class="btn btn-primary">
Registrar nuevo vehículo
</a>
@endif
<a href="{{ url('/home') }}"
class="btn btn-primary">
Inicio
</a>

</div>
@stop
