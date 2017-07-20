@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">
	<h2 class="page-header">
		Listado de facturas
	</h2>
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
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th style="width:100px" class="text-left">Descargar</th>
					<th style="width:100px" class="text-left">Cliente</th>
					<th style="width:85px" class="text-right">I.V.</th>
					<th style="width:120px" class="text-right">Subtotal</th>
					<th style="width:120px" class="text-right">Total</th>
					<th style="width:120px" class="text-right">Estado</th>
					<th style="width:90px" class="text-right">Fecha de creación</th>
					<th style="width:90px" class="text-right">Anular</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($factura as $invoice)
				<tr>
					<td id= "{{$invoice->id}}"><a class="btn btn-success" href="{{ URL::to('invoices/' . $invoice->id) . '/download' }}">Descargar <span class="glyphicon glyphicon-download-alt"></span></a></td>
					<td id= "{{$invoice->id}}"><a class="nameLink" href="{{ URL::to('invoices/' . $invoice->id) . '/show' }}">{{$invoice->client->name}}</a></td>
					<th class="text-right">{{$invoice->iv}}</th>
					<th class="text-right">{{$invoice->subtotal}}</th>
					<th class="text-right">{{$invoice->total}}</th>
					@if($invoice->state == 1)
					<th class="text-right">✓</th>
					@else
					<th class="text-right">X</th>
					@endif
					<th class="text-right">{{$invoice->created_at}}</th>
					@if($invoice->state == 1)
					<td class="text-right" id= "{{$invoice->id}}"><a class="btn btn-danger" href="{{ URL::to('invoices/' . $invoice->id) . '/annular' }}"><span class="glyphicon glyphicon-remove"></span></a></td>
					@else
					
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<a class="btn btn-primary" href="{{ url('invoices/create')}}">Nueva Factura</a>
</div>

@stop
