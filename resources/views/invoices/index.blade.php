@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">
	<div>
		<?php echo Form::open(['url' => 'invoices', 'method' => 'GET', 'class' => 'navbar-form pull-right']); ?>

		<div class="input-group">
			<span title="Precione enter para buscar" class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
			<?php echo Form::text('name', null, ['title' => 'Precione enter para buscar','class' => 'form-control search', 'placeholder' => 'Buscar factura por nombre del cliente o proveedor', 'aria-describedby' => 'search']); ?>
		</div>
		<?php echo Form::close(); ?>
		<h2 class="page-header">
			Listado de facturas de ventas
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
					@if($invoice->Client_or_Provider == 2)
					<tr>
						@if($invoice->state == 1)
						<td id= "{{$invoice->id}}"><a class="btn btn-success" href="{{ URL::to('invoices/' . $invoice->id) . '/download' }}">Descargar <span class="glyphicon glyphicon-download-alt"></span></a></td>
						@else
						<th></th>
						@endif
						<td id= "{{$invoice->id}}"><a class="nameLink" href="{{ URL::to('invoices/' . $invoice->id) . '/show' }}">{{$invoice->nameClient}}</a></td>
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
					@endif
					@endforeach
				</tbody>
			</table>
		</div>
		<a class="btn btn-primary" href="{{ url('invoices/create')}}">Facturar al cliente</a>
	</div>
	<div>
		<?php echo Form::open(['url' => 'invoices', 'method' => 'GET', 'class' => 'navbar-form pull-right']); ?>

		<div class="input-group">
			<span title="Precione enter para buscar" class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
			<?php echo Form::text('name', null, ['title' => 'Precione enter para buscar','class' => 'form-control search', 'placeholder' => 'Buscar factura por nombre del proveedor', 'aria-describedby' => 'search']); ?>
		</div>
		<?php echo Form::close(); ?>
		<h2 class="page-header">
			Listado de facturas de compras
		</h2>
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
					@if($invoice->Client_or_Provider == 1)
					<tr>
						@if($invoice->state == 1)
						<td id= "{{$invoice->id}}"><a class="btn btn-success" href="{{ URL::to('invoices/' . $invoice->id) . '/downloadReportPurchase' }}">Descargar <span class="glyphicon glyphicon-download-alt"></span></a></td>
						@else
						<td></td>
						@endif
						<td id= "{{$invoice->id}}"><a class="nameLink" href="{{ URL::to('invoices/' . $invoice->id) . '/showReportPurchase' }}">{{$invoice->nameClient}}</a></td>
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
						<td class="text-right" id= "{{$invoice->id}}"><a class="btn btn-danger" href="{{ URL::to('invoices/' . $invoice->id) . '/annularReportPurchase' }}"><span class="glyphicon glyphicon-remove"></span></a></td>
						@else

						@endif
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>
		</div>
		<a class="btn btn-primary" href="{{ url('invoices/createReportPurchase')}}">Facturar al proveedor</a>
	</div>
	<hr>
</div>
@stop
