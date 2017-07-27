@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')

<div class="col-md-10 col-xs-10">

	<h1 style="text-align:center;">Listado de Proveedores</h1>
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
	<?php echo Form::open(['url' => 'Providers', 'method' => 'GET', 'class' => 'navbar-form pull-right']); ?>

	<div class="input-group">
		<span title = "Precione enter para buscar" class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
		<?php echo Form::text('name', null, ['title' => 'Precione enter para buscar', 'class' => 'form-control search', 'placeholder' => 'Buscar proveedor', 'aria-describedby' => 'search']); ?>
	</div>
	<?php echo Form::close(); ?>
	<div class="table-responsive">
		@if(count($provideer)>0)
		@if (Auth::user()->workstation == "Administrador")
		<table  class="table table-striped">
			<tr class="backtabletr">
				<th>Nombre</th>
				<th>Teléfono</th>
				<th>Dirección</th>
				<th>Correo Electrónico</th>
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
					<a class="btn btn-prin btn-sm"
					href="{{ URL::to('Providers/' . $provider->id) . '/show' }}" role="button">
					<span class="glyphicon glyphicon-eye-open"></span>
				</a>
			</td>
			{{-- Columna botón EDIT --}}
			<td>
				<a class="btn btn-warning btn-sm"
				href="{{ URL::to('Providers/' . $provider->id . '/edit') }}" role="button">
				<span class="glyphicon glyphicon-pencil"></span>
			</a>
		</td>
		{{-- Columna botón DELETE --}}
		<td>
			<!-- Utilizar el método DESTROY /Providers/{id} -->
			<form onsubmit="return confirmation()"
			action="{{ url('/Providers', $provider->id) }}"
			method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" onclick="pregunta()" value="DELETE">
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
			<a class="btn btn-prin btn-sm"
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
class="btn btn-primary">
Registrar nuevo proveedor
</a>
@endif
<a href="{{ url('/home') }}"
class="btn btn-primary">
Inicio
</a>
</div>
<script language="JavaScript"> 
function confirmation(){ 
    //if(confirm("Esta seguro que desea aliminar el proveedor?"))
    if(confirm("ESTA SEGURO QUE DESEA ELIMINAR EL PROVEEDOR?"))
    {
        return true;
    }
    return false; 
} 
</script>
@stop
