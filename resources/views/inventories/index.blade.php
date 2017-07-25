@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">

	<h1 style="text-align:center;">Listado de Inventario</h1>
	<?php echo Form::open(['url' => 'inventory', 'method' => 'GET', 'class' => 'navbar-form pull-right']); ?>

	<div class="input-group">
		<span title="Precione enter para buscar" class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
		<?php echo Form::text('name', null, ['title' => 'Precione enter para buscar','class' => 'form-control search', 'placeholder' => 'Buscar  articulos de inventario', 'aria-describedby' => 'search']); ?>
	</div>
	<?php echo Form::close(); ?>
	<div class="table-responsive">
		@if(count($inventor)>0)
		@if (Auth::user()->workstation == "Administrador")
		<table class="table table-striped">
			<tr class="backtabletr">
				<th>Código del artículo</th>
				<th>Nombre del artículo</th>
				<th>Cantidad</th>
				<th>ver</th>
			</tr>
			@foreach ($inventor as $inventario)
			<tr class="backtabletd"> 
				{{-- Columna DATOS del inventario --}}
				<td>
					{{$inventario->article->code}}
				</td>
				@if($inventario->article->unit_or_quantity <= 0)
				<td class="quantityN">
					{{ $inventario->article->name }}
				</td>
				@else
				<td>
					{{ $inventario->article->name }}
				</td>
				@endif
				<td>
					{{ $inventario->article->unit_or_quantity }}
				</td>
				{{-- Columna botón SHOW --}}
				<td>
					<a class="btn btn-prin btn-sm"
					href="{{ URL::to('inventory/' . $inventario->id) . '/show' }}" role="button">
					<span class="glyphicon glyphicon-eye-open"></span>
				</a>
			</td>
		</tr>
		@endforeach
	</table>
	@else
	<table  class="table table-hover">
		<tr class="backtabletr">
			<th>Código del artículo</th>
			<th>Nombre del artículo</th>
			<th>Cantidad</th>
			<th>ver</th>
		</tr>
		@foreach ($inventor as $inventario)
		<tr class="backtabletd"> 
			{{-- Columna DATOS del Inventario --}}
			<td>
				{{$inventario->article->code}}
			</td>
			@if($inventario->article->unit_or_quantity <= 0)
			<td class="quantityN">
				{{ $inventario->article->name }}
			</td>
			@else
			<td>
				{{ $inventario->article->name }}
			</td>
			@endif
			<td>
				{{ $inventario->article->unit_or_quantity }}
			</td>
			{{-- Columna botón SHOW --}}
			<td>
				<a class="btn btn-prin btn-sm"
				href="{{ URL::to('inventory/' . $inventario->id) . '/show' }}" role="button">
				<span class="glyphicon glyphicon-eye-open"></span>
			</a>
		</td>
	</tr>
	@endforeach
</table>
@endif
</div>
@else
<p>No se encontró ningún artículo con ese nombre</p>
@endif

@if (Auth::user()->workstation == "Administrador")

@endif
<a href="{{ url('/home') }}"
class="btn btn-primary">
Inicio
</a>

</div>
@stop
