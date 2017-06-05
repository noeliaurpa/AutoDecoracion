@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">

	<h1 style="text-align:center;">Listado de vehículos</h1>
	<?php echo Form::open(['url' => 'vehicles', 'method' => 'GET', 'class' => 'navbar-form pull-right']); ?>

	<div class="input-group">
		<?php echo Form::text('license_plate_or_detail', null, ['class' => 'form-control', 'placeholder' => 'Buscar vehiculos', 'aria-describedby' => 'search']); ?>
		<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
	</div>
	<?php echo Form::close(); ?>
	<div class="table-responsive">
		@if(count($vehiclee)>0)
		@if (Auth::user()->workstation == "Administrador")
		<table  class="table table-hover">
			<tr class="backtabletr">
				<th>Nombre del cliente</th>
				<th>Placa</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Observacion</th>
				<th>ver</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
			@foreach ($vehiclee as $car)
			<tr class="backtabletd"> 
				{{-- Columna DATOS del Vehiculo --}}
				<td>
					{{ $car->client_id }}
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
					<input type="image" src="img/see.png"/>
				</a>
			</td>
			{{-- Columna botón EDIT --}}
			<td>
				<a class="btn btn-default btn-sm"
				href="{{ URL::to('vehicles/' . $car->id . '/edit') }}" role="button">
				<input type="image" src="img/update.png"/>
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
				<input type="image" src="img/delete.png"/>
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
		<th>Observacion</th>
		<th>ver</th>
	</tr>
	@foreach ($vehiclee as $car)
	<tr class="backtabletd"> 
		{{-- Columna DATOS del Vehiculo --}}
		<td>
			{{ $car->client_id }}
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
			<input type="image" src="img/see.png"/>
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
class="btn btn-primary btn-sm">
Registrar nuevo vehiculo
</a>
@endif
<a href="{{ url('/home') }}"
class="btn btn-default btn-sm">
Inicio
</a>

</div>
@stop
