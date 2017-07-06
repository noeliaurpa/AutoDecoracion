@extends('layouts.appLR')

@section('content')

<div class="col-md-8 col-xs-8">
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
    <div class="row rowCalendar">
        <div id="calendar"></div>
    </div>
</div>
<div class="col-md-2 col-xs-2">
 <div class="container">

    {!! Form::open(['route' => 'quotes.store', 'method' => 'post', 'role' => 'form']) !!}
    <div id="responsive-modal" class="modal fade" tabindex="-1" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Registro de una nueva cita</h4>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('title', 'Nombre de la persona') !!}
                        {!! Form::text('title', old('title'), ['class' => 'form-control', 'required' => 'required', 'maxlength' => '100']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('date_start', 'Fecha de inicio') !!}
                        {!! Form::text('date_start', old('date_start'), ['class' => 'form-control', 'readonly' => 'true']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('time_start', 'Hora inicio') !!}
                        {!! Form::text('time_start', old('time_start'), ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('date_end', 'Fecha hora fin') !!}
                        {!! Form::text('date_end', old('date_end'), ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('color', 'Color') !!}
                        <div class="input-group colorpicker">
                            {!! Form::text('color', old('color'), ['class' => 'form-control', 'required' => 'required']) !!}
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('GUARDAR', ['class' => 'btn btn-success']) !!}
                    <button type="button"class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <div id='calendar'></div>
    
    <div id="modal-quote" class="modal fade" tabindex="-1" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Detalle de la cita</h4>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('_title', 'Nombre de la persona') !!}
                        {!! Form::text('_title', old('_title'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('_date_start', 'Fecha de inicio') !!}
                        {!! Form::text('_date_start', old('_date_start'), ['class' => 'form-control', 'readonly' => 'true']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('_time_start', 'Hora inicio') !!}
                        {!! Form::text('_time_start', old('_time_start'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('_date_end', 'Fecha hora fin') !!}
                        {!! Form::text('_date_end', old('_date_end'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('_color', 'Color') !!}
                        <div class="input-group colorpicker">
                            {!! Form::text('_color', old('_color'), ['class' => 'form-control']) !!}
                            <span class="input-group-addon">
                                <i></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="delete" data-href="{{ url('quotes') }}" data-id="" class="btn btn-danger">ELIMINAR</a>
                    <button type="button"class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
{!! Html::script('js/app.js') !!}
{!! Html::script('vendor/seguce92/fullcalendar/lib/moment.min.js') !!}
{!! Html::script('vendor/seguce92/fullcalendar/fullcalendar.min.js') !!}
{!! Html::script('vendor/seguce92/bootstrap-datetimepicker/js/bootstrap-material-datetimepicker.js') !!}
{!! Html::script('vendor/seguce92/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') !!}
{!! Html::script('vendor/seguce92/fullcalendar/locale/es.js') !!}
<script>

var BASEURL = "{{ url('/') }}"
$(document).ready(function() {

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
        },
                    navLinks: true, // can click day/week titles to navigate views
                    editable: true,
                    selectable: true, //el selectable permite que cada dia se pueda seleccionar
                    selectHelper: true, // permite agregar un nuevo evento a nuestro calendario

                    select: function(start) {
                        start = moment(start.format());
                        $('#date_start').val(start.format('YYYY-MM-DD'));
                        $('#responsive-modal').modal('show');
                    },

                    events: BASEURL + '/quotes',

                    eventClick: function(event, jsEvent, view) {
                        var date_start = event.start.format('YYYY-MM-DD');
                        var time_start = event.start.format('HH:mm:ss');
                        var date_end = event.end.format('YYYY-MM-DD HH:mm:ss');
                        var title = event.title;
                        var color = event.color;
                        var id = event.id;
                        $('#modal-quote #delete').attr('data-id', id);
                        $('#modal-quote #_title').val(title);
                        $('#modal-quote #_date_start').val(date_start);
                        $('#modal-quote #_time_start').val(time_start);
                        $('#modal-quote #_date_end').val(date_end);
                        $('#modal-quote #_color').val(color);
                        $('#modal-quote').modal('show');
                    }
                });
});

$('.colorpicker').colorpicker();

$('#time_start').bootstrapMaterialDatePicker({ 
    date: false,
    shortTime: false,
    format: 'HH:mm:ss'
});

$('#date_end').bootstrapMaterialDatePicker({ 
    date: true,
    shortTime: false,
    format: 'YYYY-MM-DD HH:mm:ss'
});

$('#delete').on('click', function(){
    var x = $(this);
    var delete_url = x.attr('data-href') + '/' + x.attr('data-id');

    $.ajax({
        url: delete_url,
        type: 'DELETE',
        success: function(){
            $('#modal-quote').modal('hide');
            window.location.reload();
        },
        error: function(result){
            $('#modal-quote').modal('show');
            alert(result.message);
        }
    });
});

</script>

@endsection