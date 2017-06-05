@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">
	<h2 class="page-header">
		Nueva Factura
	</h2>
	<div class="well well-sm">
		<div class="row">
			<div class="col-xs-6">
				<input id="vehicle" class="form-control" type="text" placeholder="Vehículo">
			</div>
			<div class="col-xs-6">
				<input id="address" class="form-control" type="text" placeholder="placa" readonly>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-7">
			<input id="article" class="form-control" type="text" placeholder="Nombre del articulo">
		</div>
		<div class="col-xs-2">
			<input id="quantity" class="form-control" type="text" placeholder="cantidad">
		</div>
		<div class="col-xs-2">
			<input id="price" class="form-control" type="text" placeholder="Precio">	
		</div>
		<div class="col-xs-1">
			<button class="btn btn-primary form-control" id="btn-agregar">
				<i class="glyphicon glyphicon-plus"></i>
			</button>
		</div>
	</div>

	<hr/>

	<table class="table table-striped">
		<thead>
			<tr>
				<th style="width:40px"></th>
				<th>Articulo</th>
				<th style="width:100px">Cantidad</th>
				<th style="width:100px">Precio</th>
				<th style="width:100px">Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<button class="btn btn-danger btn-xs btn-block">X</button>
				</td>
				<td>Producto A</td>
				<td class="text-right">10</td>
				<td class="text-right">$ 120.00</td>
				<td class="text-right">$ 1200.00</td>
			</tr>
			<tr>
				<td>
					<button class="btn btn-danger btn-xs btn-block">X</button>
				</td>
				<td>Producto A</td>
				<td class="text-right">10</td>
				<td class="text-right">$ 120.00</td>
				<td class="text-right">$ 1200.00</td>
			</tr>
			<tr>
				<td>
					<button class="btn btn-danger btn-xs btn-block">X</button>
				</td>
				<td>Producto A</td>
				<td class="text-right">10</td>
				<td class="text-right">$ 120.00</td>
				<td class="text-right">$ 1200.00</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4" class="text-right"><b>IVA</b></td>
				<td class="text-right">$ 1200.00</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Sub total</b></td>
				<td class="text-right">$ 1200.00</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Total</b></td>
				<td class="text-right">$ 1200.00</td>
			</tr>
		</tfoot>
	</table>
</div>
<script>

var options = {
	url: function(q) {
		return "{{url('invoices/findClient?q=')}}" + q;
	},

	getValue: "name"
};

$("#vehicle").easyAutocomplete(options);


</script>
@stop