@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">

	<h1 style="text-align:center;">Listado de usuarios</h1>
	<div class="input-group">
		@if(Session::has('flash_message'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡ATENCIÓN!</strong> {{Session::get('flash_message')}}.
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
	<?php echo Form::open(['url' => 'users', 'method' => 'GET', 'class' => 'navbar-form pull-right']); ?>

	<div class="input-group">
		<span title="Precione enter para buscar" class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
		<?php echo Form::text('name', null, ['title' => 'Precione enter para buscar','class' => 'form-control search', 'placeholder' => 'Buscar usuarios', 'aria-describedby' => 'search']); ?>
	</div>
	<?php echo Form::close(); ?>
	<div class="table-responsive">
		@if(count($users)>0)
		@if (Auth::user()->workstation == "Administrador")
		<table  class="table table-hover">
			<tr class="backtabletr">
				<th>Nombre</th>
				<th>Correo Electrónico</th>
				<th>Teléfono</th>
				<th>Ocupación</th>
				<th>Salario</th>
				<th>Observación</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
			@foreach ($users as $user)
			<tr class="backtabletd"> 
				{{-- Columna NOMBRE del usuario --}}
				<td>
					{{ $user->name }}
				</td>
				<td>
					{{ $user->email }}
				</td>
				<td>
					{{ $user->tell }}
				</td>
				<td>
					{{ $user->workstation }}
				</td>
				<td>
					₡{{ $user->salary }}
				</td>
				<td>
					{{ $user->observation }}
				</td>
				{{-- Columna botón EDIT --}}
				<td>
					<a class="btn btn-warning btn-sm"
					href="{{ URL::to('users/' . $user->id . '/edit') }}" role="button">
					<span class="glyphicon glyphicon-pencil"></span>
				</a>
			</td>
			{{-- Columna botón DELETE --}}
			<td>
				<!-- Utilizar el método DESTROY /users/{id} -->
				<form onsubmit="return confirmation()"
				action="{{ url('/users', $user->id) }}" method="post">
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
	@endif
</div>
@else
<p>No se encontró ningún registro de usuarios</p>
@endif

<a href="{{ url('/home') }}"
class="btn btn-primary btn-sm">
Inicio
</a>
</div>
<script language="JavaScript"> 
function confirmation(){ 
    //if(confirm("Esta seguro que desea aliminar el proveedor?"))
    if(confirm("ESTA SEGURO QUE DESEA ELIMINAR EL USUARIO O ADMINISTRADOR?"))
    {
        return true;
    }
    return false; 
} 
</script>
@stop
