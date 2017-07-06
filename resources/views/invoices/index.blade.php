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
	<a class="btn btn-primary btm-lg btn-block" href="{{ url('invoices/create')}}">Nueva Factura</a>
	<table class="table table-striped">
		<thead>
			<tr>
				<th style="width:100px" class="text-right">cliente</th>
				<th style="width:160px" class="text-right">I.V.</th>
				<th style="width:160px" class="text-right">subtotal</th>
				<th style="width:160px" class="text-right">total</th>
				<th style="width:100px" class="text-right">creado</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($factura as $invoice)
			<tr>
				<td id= "{{$invoice->id}}"> <a href="{{ URL::to('invoices/' . $invoice->id) . '/show' }}">{{$invoice->client->name}}</a></td>
				<th class="text-right">{{$invoice->iv}}</th>
				<th class="text-right">{{$invoice->subtotal}}</th>
				<th class="text-right">{{$invoice->total}}</th>
				<th class="text-right">{{$invoice->created_at}}</th>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@stop
