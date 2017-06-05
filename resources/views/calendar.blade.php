<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Calendario</title>
	<!-- ... -->
	<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="/bower_components/bootstrap-calendar/css/calendar.css" />
	<link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
	<script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
	<script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="/bower_components/bootstrap-calendar/js/language/es-ES.js"></script>
</head>
<body>
	<div class="container">
		<ol class="breadcrumb">
			<li> <a href="/Calendar"> Calendario</a> </li>
			<li> <a href="/Events"> Añadir evento</a> </li>
		</ol>
		<div class="row">
			<div class="page-header">
				<div class="pull-right form-inline">
					<div class="btn-group">
						<button class="btn btn-primary" data-calendar-nav="prev"><< Anterior</button>
						<button class="btn" data-calendar-nav="today">Hoy</button>
						<button class="btn btn-primary" data-calendar-nav="next">Siguiente >></button>
					</div>
					<div class="btn-group">
						<button class="btn btn-warning" data-calendar-view="year">Año</button>
						<button class="btn btn-warning active" data-calendar-view="month">Mes</button>
						<button class="btn btn-warning" data-calendar-view="week">Semana</button>
						<button class="btn btn-warning" data-calendar-view="day">Dia</button>
					</div>
				</div>
			</div>
			<label class="checkbox">
				<input type="checkbox" value="#events-modal" id="events-in-modal">Abrir eventos en una ventana modal
			</label>
		</div><hr>
		<div class="row">
			<div id="calendar"></div>
		</div>
		<!-- ventana modal para el calendario -->
		<div class="modal fade" id="events-modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Modal title</h4>
					</div>
					<div class="modal-body" style="height: 400px;">
						<p>One fine body&hellip;</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-defaul" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
					</div>
				</div>
			</div>
		</div>
	</div>



	<script type="text/javascript" src="/bower_components/underscore/underscore-min.js"></script>
	<script type="text/javascript" src="/bower_components/bootstrap-calendar/js/calendar.js"></script>
	<script type="text/javascript">
	(function($)
	{
		//creamos la fecha actual
		var date = new Date();
		var yyyy = date.getFullYear().toString();
		var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
		var dd = date.getDate().toString();

		//Establecemos los valores del calendario
		var options = {
			events_source:'./CalendarController/getAll',
			view: 'month',
			language: 'es-Es',
			tmpl_path: './bower_components/bootstrap-calendar/tmpls/',
			tmpl_cache: false,
			day: yyyy+"-"+mm+"-"+dd,
			time_start: '08:00',
			time_end: '17:00',
			time_split: '30',
			width: '50%',
			onAfterEventsLoad: function(events)
			{
				if (!events) 
				{
					return;
				}
				var list = $('#eventlist');
				list.html('');

				$.each(events, function(key, val)
				{
					$(document.createElement('li'))
					.html('<a href="' + val.url + '">'+ val.title + '</a>')
					.appendTo(list);
				});		
			},
			onAfterViewLoad: function(view)
			{
				$('.page-header h3').text(this.getTitle());
				$('.btn-group button').removeClass('active');
				$('button[data-calendar-view="' + view + '"]').addClass('active');
			},
			classes:{
				month:{
					general: 'label'
				}
			}
		};
		var calendar = $('#calendar').calendar(options);

		$('.btn-group button[data-calendar-nav]').each(function()
		{
			var $this = $(this);
			$this.click(function()
			{
				calendar.navigate($this.data('calendar-nav'));
			});
		});

		$('.btn-group button[data-calendar-view]').each(function()
		{
			var $this = $(this);
			$this.click(function()
			{
				calendar.view($this.data('calendar-view'));
			});
		});

		$('#first_day').change(function(){
			var value = $(this).val();
			value = value.length ? parseInt(value) : null;
			calendar.setOptions({first_day: value});
			calendar.view();
		});

		$('#events-in-modal').change(function()
		{
			var val = $(this).is(':checked') ? $(this).val() : null;
			calendar.setOptions(
				{
					modal: val,
					modal_type: 'iframe'
				}
			);
		});
	}(jQuery));
	</script>
</body>
</html>
