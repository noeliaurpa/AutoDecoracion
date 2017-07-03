@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">

	<h1 style="text-align:center;">Listado de Caja chica</h1>
	<?php echo Form::open(['url' => 'smallbox', 'method' => 'GET', 'class' => 'navbar-form pull-right']); ?>

	<div class="input-group">
		<span title="Precione enter para buscar" class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
		<?php echo Form::text('name', null, ['title' => 'Precione enter para buscar','class' => 'form-control search', 'placeholder' => 'Buscar articulos de la caja chica', 'aria-describedby' => 'search']); ?>
	</div>
	<?php echo Form::close(); ?>
	<div class="table-responsive">
		@if(count($smallbox)>0)
		@if (Auth::user()->workstation == "Administrador")
		<table  class="table table-hover">
			<tr class="backtabletr">
				<th>Nombre del articulo</th>
				<th>ver</th>
			</tr>
			@foreach ($smallbox as $smallb)
			<tr class="backtabletd"> 
				{{-- Columna DATOS del smallb --}}
				<td>
					{{ $smallb->article_id }}
				</td>
				{{-- Columna botón SHOW --}}
				<td>
					<a class="btn btn-default btn-sm"
					href="{{ URL::to('smallbox/' . $smallb->id) . '/show' }}" role="button">
					<span class="glyphicon glyphicon-eye-open"></span>
				</a>
			</td>
		</tr>
		@endforeach
	</table>
	@else
	<table  class="table table-hover">
		<tr class="backtabletr">
			<th>Nombre del articulo</th>
			<th>ver</th>
		</tr>
		@foreach ($smallbox as $smallb)
		<tr class="backtabletd">
			{{-- Columna DATOS del Inventario --}}
			<td>
				{{ $smallb->article_id }}
			</td>
			{{-- Columna botón SHOW --}}
			<td>
				<a class="btn btn-default btn-sm"
				href="{{ URL::to('smallbox/' . $smallb->id) . '/show' }}" role="button">
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

@endif
<a href="{{ url('/home') }}"
class="btn btn-primary btn-sm">
Inicio
</a>

</div>
@stop
