@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">
	<h2 class="page-header">
		Factura # {{$invoicereport->number}}
	</h2>
	<div class="well well-sm">
		<div class="row">
			<div class="col-xs-10">
				<input id="nameClient" name="nameClient" class="form-control" type="text" placeholder="Nombre del cliente" value="{{$invoicereport->client->name}}"readonly/>
			</div>
			<div class="col-xs-2">
				<input id="numInvoice" name="numInvoice" class="form-control" type="text" placeholder="numero de factura" value="{{$invoicereport->number}}" readonly>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-4">
				<input id="brand" name="brand" class="form-control" type="text" placeholder="Marca del vehículo" value="{{$invoicereport->vehicle->brand}}" readonly/>
			</div>
			<div class="col-xs-4">
				<input id="model" name="model" class="form-control" type="text" placeholder="Modelo del vehículo" value="{{$invoicereport->vehicle->model}}"readonly/>
			</div>
			<div class="col-xs-4">
				<input id="license" name="license" class="form-control awesomplete" type="text" placeholder="placa" data-list="#mylicense" value="{{$invoicereport->vehicle->license_plate_or_detail}}" readonly/>
			</div>
		</div>
	</div>
	<hr/>

	<table name="detailInvoice" id="detailInvoice" class="table table-striped">
		<thead>
			<tr>
				<th style="width:40px"></th>
				<th>Artículo</th>
				<th style="width:100px">Cantidad</th>
				<th style="width:100px">Precio</th>
				<th style="width:100px">Total</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($invoicereport->invoicearticle as $article)
			<tr>
				<td></td>
				<td>{{$article->article->name}}</td>
				<td>{{$article->quantity}}</td>
				<td>{{$article->price}}</td>
				<td>{{$article->total}}</td>
			</tr>

			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4" class="text-right"><b>Impuesto de venta ₡</b></td>
				<td name="IV" id="impuestoDVenta" class="text-right">{{$invoicereport->iv}}</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Sub total ₡</b></td>
				<td id="subtotal" class="text-right">{{$invoicereport->subtotal}}</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Total ₡</b></td>
				<td id="total" class="text-right">{{$invoicereport->total}}</td>
			</tr>
		</tfoot>
	</table>
	<div>
		<a href="{{ url('/invoices') }}" class="btn btn-primary"> Ver todas las facturas </a>
	</div>
</div>
@stop