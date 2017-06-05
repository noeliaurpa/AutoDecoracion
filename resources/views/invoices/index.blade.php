@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">
	<h2 class="page-header">
		Comprobantes
	</h2>
	<a class="btn btn-default btm-lg btn-block" href="{{ url('invoices/create')}}">Nuevo comprobante</a>
	<table class="table table-striped">
		<thead>
			<tr>
				<th style="width:100px" class="text-right">cliente</th>
				<th style="width:160px" class="text-right">iva</th>
				<th style="width:160px" class="text-right">subtotal</th>
				<th style="width:160px" class="text-right">total</th>
				<th style="width:100px" class="text-right">creado</th>
			</tr>
		</thead>
		<tbody>
			<?php for ($i=1; $i <= 10; $i++): ?>
			<?php
				$total = 1180 * $i;
				$subtotal = $total / 1.13;
				$iva = $total - $subtotal;
			?>
			<tr>
				<td>client {{$i}}</td>
				<th class="text-right">{{ number_format($iva, 2)}}</th>
				<th class="text-right">{{ number_format($subtotal, 2)}}</th>
				<th class="text-right">{{ number_format($total, 2)}}</th>
				<th class="text-right">02/02/2017</th>
			</tr>
			<?php endfor; ?>
		</tbody>
	</table>
</div>

@stop
