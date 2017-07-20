@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-8 col-xs-8">
	<hr>
	<div class="oval-half-red"><label style="color:white;margin: 27px 27px 27px 178px;">Seleccione una de las siguientes opciones para generar un reporte</label></div>
	<div class="reports">
		<ul>
			<li>
				<input type="radio" name="report" id="1" name="selector">
				<label for="1">Facturas realizadas entre fechas</label>

				<div class="check"></div>
			</li>

			<li>
				<input type="radio" name="report" id="2" name="selector">
				<label for="2">Articulos más vendidos entre fechas</label>

				<div class="check"><div class="inside"></div></div>
			</li>
		</ul>
	</div>
	<label for="date" class="control-label">Fecha de inicio</label>
	<input type="text" id="date" class="form-control" data-dtp="dtp_Nha9v">
</div>
{!! Html::script('js/app.js') !!}
{!! Html::script('variety/styles/fullcalendar/lib/moment.min.js') !!}
{!! Html::script('variety/styles/fullcalendar/fullcalendar.min.js') !!}
{!! Html::script('variety/styles/bootstrap-datetimepicker/js/bootstrap-material-datetimepicker.js') !!}
{!! Html::script('variety/styles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') !!}
{!! Html::script('variety/styles/fullcalendar/locale/es.js') !!}
<script type="text/javascript">
$('#date').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
</script>
@stop
