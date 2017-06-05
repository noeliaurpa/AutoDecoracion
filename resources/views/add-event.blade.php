@extends('layouts.appLR')

@section('content')
<div class="col-md-8 col-xs-8">
	<div class="">
		<div class="container containerCalendar">
			<ol class="breadcrumb">
				<li> <a href="/home"> Calendario</a> </li>
				<li> <a href="/Events"> Añadir cita</a> </li>
			</ol>
			<div class="row">
				<h1 class="text-center healding"> Añadir una cita</h1><hr>
				<form action=" {{ url('/Events/guardar') }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="col-sm-8 col-sm-offset-2" style="height:75px;">
						<div class="col-md-6">
							<div class="form-group">
								<div class="input-group date" id="fechaIni">
									<input type="text" name="fechaIni" class="form-control"/>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="input-group date" id="fechaFin">
									<input type="text" name="fechaFin" class="form-control"/>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="url" class="col-sm-12 control-label">Enlace de la cita</label>
							<div class="col-sm-12">
								<input type="url" name="url" class="form-control" id="url" placeholder="Introduce una url o no :)">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12 control-label">Tipo de cita</label>
							<div class="col-sm-12">
								<select class="form-control" name="class">
									<option value="event-info">Mañana</option>
									<option value="event-success">Tarde</option>
									<option value="event-inverse">Noche</option>
									<option value="event-important">Importante</option>
									<option value="event-special">Especial</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-12 control-label">Titulo</label>
							<div class="col-sm-12">
								<input type="text" name="title" class="form-control" id="title" placeholder="Introduce un titulo">
							</div>
						</div>
						<div class="form-group">
							<label for="body" class="col-sm-12 control-label">Cita</label>
							<div class="col-sm-12">
								<textarea id="body" name="event" class="form-control" rows="3"></textarea>
							</div>
						</div>
						<button style="margin-top: 10px;" type="submit" class="pull-right btn btn-primary" >Guardar Cita</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function () 
{
	$('#fechaIni').datetimepicker();
	$('#fechaFin').datetimepicker();
});
</script>
@endsection
