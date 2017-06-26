@extends('layouts.appLR')

@section('content')

<div class="col-md-10 col-xs-10">

	<h1 style="text-align:center;">Listado de Proveedores</h1>
	<?php echo Form::open(['url' => 'Providers', 'method' => 'GET', 'class' => 'navbar-form pull-right']); ?>

	<div class="input-group">
		<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
		<?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar proveedor', 'aria-describedby' => 'search']); ?>
	</div>
	<h6 style="text-align: center; background: #eeeeee; border-radius: 21%;">Precione enter para buscar</h6>
	<?php echo Form::close(); ?>
	<div class="table-responsive">
		@if(count($provideer)>0)
		@if (Auth::user()->workstation == "Administrador")
		<table  class="table table-hover">
			<tr class="backtabletr">
				<th>Nombre</th>
				<th>Telefono</th>
				<th>Direccion</th>
				<th>Correo Electronico</th>
				<th>Ver</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
			@foreach ($provideer as $provider)
			<tr class="backtabletd"> 
				{{-- Columna NOMBRE del proveedor --}}
				<td>
					{{ $provider->name }}
				</td>
				<td>
					{{ $provider->number_provider }}
				</td>
				<td>
					{{ $provider->address_provider }}
				</td>
				<td>
					{{ $provider->email }}
				</td>
				{{-- Columna botón SHOW --}}
				<td>
					<a class="btn btn-default btn-sm"
					href="{{ URL::to('Providers/' . $provider->id) . '/show' }}" role="button">
					<span class="glyphicon glyphicon-eye-open"></span>
				</a>
			</td>
			{{-- Columna botón EDIT --}}
			<td>
				<a class="btn btn-default btn-sm"
				href="{{ URL::to('Providers/' . $provider->id . '/edit') }}" role="button">
				<span class="glyphicon glyphicon-pencil"></span>
			</a>
		</td>
		{{-- Columna botón DELETE --}}
		<td>
			<!-- Utilizar el método DESTROY /Providers/{id} -->
			<form
			action="{{ url('/Providers', $provider->id) }}"
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
		<th>Nombre</th>
		<th>Telefono</th>
		<th>Direccion</th>
		<th>Correo Electronico</th>
		<th>Ver</th>
	</tr>
	@foreach ($provideer as $provider)
	<tr class="backtabletd"> 
		{{-- Columna NOMBRE del proveedor --}}
		<td>
			{{ $provider->name }}
		</td>
		<td>
			{{ $provider->number_provider }}
		</td>
		<td>
			{{ $provider->address_provider }}
		</td>
		<td>
			{{ $provider->email }}
		</td>
		{{-- Columna botón SHOW --}}
		<td>
			<a class="btn btn-default btn-sm"
			href="{{ URL::to('Providers/' . $provider->id) . '/show' }}" role="button">
			<span class="glyphicon glyphicon-eye-open"></span>
		</a>
	</td>
</tr>
@endforeach
</table>
@endif
</div>
@else
<p>No se encontró ningún registro de proveedores</p>
@endif
@if (Auth::user()->workstation == "Administrador")
<a href="{{ url('/Providers/create') }}"
class="btn btn-primary btn-sm">
Registrar nuevo proveedor
</a>
@endif
<a href="{{ url('/home') }}"
class="btn btn-primary btn-sm">
Inicio
</a>

</div>
@stop
