@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">

	<h1 style="text-align:center;">Listado de artículos</h1>
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
	<?php echo Form::open(['url' => 'articles', 'method' => 'GET', 'class' => 'navbar-form pull-right']); ?>

	<div class="input-group">
		<span title="Precione enter para buscar" class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
		<?php echo Form::text('name', null, ['title' => 'Precione enter para buscar','class' => 'form-control search', 'placeholder' => 'Buscar articulos', 'aria-describedby' => 'search']); ?>
	</div>
	<?php echo Form::close(); ?>
	<div class="table-responsive">
		@if(count($articlee)>0)
		@if (Auth::user()->workstation == "Administrador")
		<table class="table table-striped">
			<tr class="backtabletr">
				<th>Código</th>
				<th>Nombre del artículo</th>
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
					₡{{ $artic->sale_price }}
				</td>
				<td>
					₡{{ $artic->purchase_price }}
				</td>
				@if($artic->unit_or_quantity <= 0)
				<td class="quantityN">
					{{ $artic->unit_or_quantity }}
				</td>
				@else
				<td>
					{{ $artic->unit_or_quantity }}
				</td>
				@endif
				{{-- Columna botón SHOW --}}
				<td>
					<a class="btn btn-default btn-sm"
					href="{{ URL::to('articles/' . $artic->id) . '/show' }}" role="button">
					<span class="glyphicon glyphicon-eye-open"></span>
				</a>
			</td>
			{{-- Columna botón EDIT --}}
			<td>
				<a class="btn btn-default btn-sm"
				href="{{ URL::to('articles/' . $artic->id . '/edit') }}" role="button">
				<span class="glyphicon glyphicon-pencil"></span>
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
		<th>Código</th>
		<th>Nombre del artículo</th>
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
			<a class="btn btn-prin btn-sm"
			href="{{ URL::to('articles/' . $artic->id) . '/show' }}" role="button">
			<span class="glyphicon glyphicon-eye-open"></span>
		</a>
	</td>
</tr>
@endforeach
</table>
@endif
</div>
@else
<p>No se encontró ningún registro de artículos</p>
@endif

@if (Auth::user()->workstation == "Administrador")
<a href="{{ url('/articles/create') }}"
class="btn btn-primary">
Registrar nuevo artículo
</a>
@endif
<a href="{{ url('/home') }}"
class="btn btn-primary">
Inicio
</a>

</div>
@stop
