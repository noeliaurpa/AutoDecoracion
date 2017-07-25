@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-8 col-xs-8">
	<hr>
	<div class="oval-half-red"><label style="color:white;margin: 27px 27px 27px 178px;">Seleccione una de las siguientes opciones para generar un reporte</label></div>
	<div class="reports">
		<form action=" {{ url('/reports') }}" method="post">
			<input type="hidden" name="_token"
			value="{{ csrf_token() }}">
			<div class="form-group">
				<ul>
					<li>
						<input type="radio" name="report" id="FacV" value="Facturas de ventas" checked="checked">
						<label for="FacV">Facturas de ventas</label>
						<div class="check"></div>
					</li>
					<li>
						<input type="radio" name="report" id="facC" value="Facturas de compras">
						<label for="facC">Facturas de compras</label>
						<div class="check"></div>
					</li>

					<li>
						<input type="radio" name="report" id="ArtV" value="Articulos más vendidos">
						<label for="ArtV">Articulos más vendidos</label>
						<div class="check"><div class="inside"></div></div>
					</li>
				</ul>
			</div>
		</div>
		<div class="form-group">
			<label for="dateIni" class="control-label">Del</label>
			<input type="text" id="dateIni" name="dateIni" placeholder="Desde que fecha desea ver el reporte" class="form-control" data-dtp="dtp_Nha9v" required>

			<label for="dateEnd" class="control-label">Al</label>
			<input type="text" id="dateEnd" name="dateEnd" placeholder="Hasta que fecha desea ver el reporte"class="form-control" data-dtp="dtp_Nha9v" required>
		</div>
		<hr>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Generar Reporte</button>
			<a href="{{ url('/home') }}" class="btn btn-primary">Inicio</a>
		</div>
	</form>
</div>
{!! Html::script('js/app.js') !!}
{!! Html::script('variety/styles/fullcalendar/lib/moment.min.js') !!}
{!! Html::script('variety/styles/fullcalendar/fullcalendar.min.js') !!}
{!! Html::script('variety/styles/bootstrap-datetimepicker/js/bootstrap-material-datetimepicker.js') !!}
{!! Html::script('variety/styles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') !!}
{!! Html::script('variety/styles/fullcalendar/locale/es.js') !!}
<script type="text/javascript">
$('#dateIni').bootstrapMaterialDatePicker({ weekStart : 0, time: false, lang : 'es' });
$('#dateEnd').bootstrapMaterialDatePicker({ weekStart : 0, time: false, lang : 'es' });
</script>
@stop
