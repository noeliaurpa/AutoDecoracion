@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">

	<h1 style="text-align:center;">Listado de articulos</h1>
	<?php echo Form::open(['url' => 'articles', 'method' => 'GET', 'class' => 'navbar-form pull-right']); ?>

	<div class="input-group">
		<?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar articulos', 'aria-describedby' => 'search']); ?>
		<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
	</div>
	<?php echo Form::close(); ?>
	<div class="table-responsive">
		@if(count($articlee)>0)
		@if (Auth::user()->workstation == "Administrador")
		<table  class="table table-hover">
			<tr class="backtabletr">
				<th>Codigo</th>
				<th>Nombre del articulo</th>
				<th>Precio de venta</th>
				<th>Precio de compra</th>
				<th>Unidad o Cantidad</th>
				<th>Ver</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
			@foreach ($articlee as $artic)
			<tr class="backtabletd"> 
				{{-- Columna NOMBRE del articulo --}}
				<td>
					{{ $artic->code }}
				</td>
				<td>
					{{ $artic->name }}
				</td>
				<td>
					{{ $artic->sale_price }}
				</td>
				<td>
					{{ $artic->purchase_price }}
				</td>
				<td>
					{{ $artic->unit_or_quantity }}
				</td>
				{{-- Columna botón SHOW --}}
				<td>
					<a class="btn btn-default btn-sm"
					href="{{ URL::to('articles/' . $artic->id) . '/show' }}" role="button">
					<input type="image" src="img/see.png"/>
				</a>
			</td>
			{{-- Columna botón EDIT --}}
			<td>
				<a class="btn btn-default btn-sm"
				href="{{ URL::to('articles/' . $artic->id . '/edit') }}" role="button">
				<input type="image" src="img/update.png"/>
			</a>
		</td>
		{{-- Columna botón DELETE --}}
		<td>
			<!-- Utilizar el método DESTROY /articles/{id} -->
			<form
			action="{{ url('/articles', $artic->id) }}"
			method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="DELETE">
			<button type="button" class="btn btn-default btn-sm">
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
		<th>Nombre del articulo</th>
		<th>Codigo</th>
		<th>Precio de venta</th>
		<th>Precio de compra</th>
		<th>Unidad o Cantidad</th>
		<th>Ver</th>
	</tr>
	@foreach ($articlee as $artic)
	<tr class="backtabletd"> 
		{{-- Columna NOMBRE del articulo --}}
		<td>
			{{ $artic->name }}
		</td>
		<td>
			{{ $artic->code }}
		</td>
		<td>
			{{ $artic->sale_price }}
		</td>
		<td>
			{{ $artic->purchase_price }}
		</td>
		<td>
			{{ $artic->unit_or_quantity }}
		</td>
		{{-- Columna botón SHOW --}}
		<td>
			<a class="btn btn-default btn-sm"
			href="{{ URL::to('articles/' . $artic->id) . '/show' }}" role="button">
			<input type="image" src="img/see.png"/>
		</a>
	</td>
</tr>
@endforeach
</table>
@endif
</div>
@else
<p>No se encontró ningún registro de articulos</p>
@endif

@if (Auth::user()->workstation == "Administrador")
<a href="{{ url('/articles/create') }}"
class="btn btn-primary btn-sm">
Registrar nuevo artice
</a>
@endif
<a href="{{ url('/home') }}"
class="btn btn-default btn-sm">
Inicio
</a>

</div>
<div class="input-group">
	@if(Session::has('flash_message'))
	<div class="mensaje">
	{{Session::get('flash_message')}}
	</div>
	@endif
</div>
@stop
