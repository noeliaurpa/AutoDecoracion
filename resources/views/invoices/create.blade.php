@extends('layouts.appLR')

@section('content')
@parent
<div class="col-md-10 col-xs-10">
	<h2 class="page-header">
		Nueva Factura
	</h2>
	<div class="well well-sm">
		<div class="row">
			<div class="col-xs-10">
				<input id="nameClient" class="form-control" type="text" placeholder="Nombre del cliente"/>
			</div>
			<div class="col-xs-2">
				<input id="numInvoice" class="form-control" type="text" placeholder="numero de factura" readonly>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-4">
				<input id="brand" class="form-control" type="text" placeholder="Marca del vehículo" readonly/>
			</div>
			<div class="col-xs-4">
				<input id="model" class="form-control" type="text" placeholder="Modelo del vehículo" readonly/>
			</div>
			<div class="col-xs-4">
				<input id="license" class="form-control awesomplete" type="text" placeholder="placa" data-list="#mylicense" data-multiple/>
				<ul id="mylicense" hidden >
					@foreach($vehicle as $key)
					<li id="plate" name="{{ $key->id }}" value="{{ $key->license_plate_or_detail }}">{{$key->license_plate_or_detail}}</li>
					@endforeach 
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-7">
			<input id="articlee" class="form-control awesomplete" type="text" placeholder="Nombre del articulo" data-list="#myarticle" data-multiple>
			<ul id="myarticle" hidden>
				@foreach($article as $key)
				<li id="articles" name="{{ $key->id }}" value="{{ $key->name }}">{{$key->name}}</li>
				@endforeach
			</ul>
		</div>
		<div class="col-xs-2">
			<input id="quantity" class="form-control" type="number" placeholder="cantidad">
		</div>
		<div class="col-xs-2">
			<input id="price" class="form-control" type="text" placeholder="Precio">	
		</div>
		<div class="col-xs-1">
			<button onclick="add(this)" class="btn btn-primary form-control" id="btn-agregar">
				<i class="glyphicon glyphicon-plus"></i>
			</button>
		</div>
	</div>

	<hr/>

	<table id="detailInvoice" class="table table-striped">
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
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4" class="text-right"><b>Impuesto de venta</b></td>
				<td id="impuestoDVenta" class="text-right">$ 00.00</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Sub total</b></td>
				<td id="subtotal" class="text-right">$ 00.00</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Total</b></td>
				<td id="total" class="text-right">$ 00.00</td>
			</tr>
		</tfoot>
	</table>
	<div>
		<button onclick="saveData()" class="btn btn-primary form-control">Guardar</button>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
//esto quiere decir que si se selecciona una opcion del input que tiene el id license
document.getElementById('license').addEventListener('awesomplete-selectcomplete',function(){
	//coloco en una variable todos los vehículos y los clientes que vienen del controlador
	var vehicle = "{{$vehicle}}";
	var client = "{{$client}}";
	//les quité a las variables de arriba las comillas que traia
	var vehi = vehicle.split("&quot;");
	var cli = client.split("&quot;");
	// hice un for para recorrer los vehículos
	var numero = 0;
	for (var i = 0; i <= vehi.length; i++) {
		//si donde está seleccionado es igual al texto del input con el id license
		if(vehi[i] == document.getElementById("license").value){
			//coloque la marca y el modelo
			document.getElementById("brand").value = vehi[i+4];
			document.getElementById("model").value = vehi[i+8];
			//realicé otro for para recorrer los clientes
			for (var y = 0; y <= cli.length; y++) {
				if(cli[y] == "provider_id"){
					y++;
				}else{

				//si donde está seleccionado es igual a el id del clientes que tiene el vehículo seleccionado
				if(cli[y] == vehi[i-5]){
					//se coloca el nombre del cliente en el input que tiene el ip nameClien
					document.getElementById("nameClient").value = cli[y+3];
				}else{
				}

			}
		};
	}else{
	}
};
});

//si se selecciona una opcion del input que tiene el id articlee
document.getElementById('articlee').addEventListener('awesomplete-selectcomplete',function(){
	//creo una variable que contiene todos los articulos que vienen desde el controlador
	var article = "{{$article}}";
	//quito las comillas de la variable anterior
	var artic = article.split("&quot;");
	//realizo un for para recorrer todos los articulos
	for (var i = 0; i <= artic.length; i++) {
		//si donde está seleccionado es igual al nombre del articulo seleccionado
		if(artic[i] == document.getElementById("articlee").value){
			//se le coloca el precio del articulo en el campo que tiene el id price
			document.getElementById("price").value = artic[i+7].split(":")[1].split(",")[0];
		}else{

		}
		
	};
});


function add(button) {
	var row = button.parentNode.parentNode;
	var cells = row.querySelectorAll('td:not(:last-of-type)');
	addToCartTable(cells);
}

function remove() {
	var row = this.parentNode.parentNode;
	document.querySelector('#detailInvoice tbody').removeChild(row);

	var miTabla = document.getElementsByTagName("table")[0];
	//console.log(miTabla);
	var miybody = miTabla.getElementsByTagName("tbody")[0];
	//console.log(miybody.rows.length);
	var iv = 0;
	var subT = 0;
	var tot = 0;
	var totales = 0;
	if(miybody.rows.length == 0){
		document.getElementById("impuestoDVenta").innerHTML = 0.00;
		document.getElementById("subtotal").innerHTML = 0.00;
		document.getElementById("total").innerHTML = 0.00;
	}else{
		for (var i = 0; i <= miybody.rows.length; i++) {
			var miFila = miybody.getElementsByTagName("tr")[i];
			var miCelda4 = parseFloat(miFila.getElementsByTagName("td")[4].innerHTML);
			totales = totales + miCelda4;
			if((i+1) >= miybody.rows.length){
				iv += totales / 1.13 * 0.13;
				subT += totales / 1.13;
				tot += iv + subT;
				document.getElementById("impuestoDVenta").innerHTML = iv.toFixed(2);
				document.getElementById("subtotal").innerHTML = subT.toFixed(2);
				document.getElementById("total").innerHTML = tot.toFixed(2);
			}	
		}
	}
}
var numero = 1;
function addToCartTable(cells) {
	var To = 0;
	var article = document.getElementById("articlee").value;
	var quanti = document.getElementById("quantity").value;
	var price = document.getElementById("price").value;
	var total = parseFloat(parseInt(quanti)*parseInt(price));
	var newRow = document.createElement('tr');
	var cellRemoveBtn = createCell();
	var id = document.createElement("id");
	cellRemoveBtn.appendChild(createRemoveBtn())
	newRow.appendChild(cellRemoveBtn);
	newRow.appendChild(createCell(article));
	newRow.appendChild(createCell(quanti));
	newRow.appendChild(createCell(price));
	newRow.appendChild(createCell(total));
	newRow.setAttribute("id", numero);
	numero++;

	document.querySelector('#detailInvoice tbody').appendChild(newRow);
	var miTabla = document.getElementsByTagName("table")[0];
	//console.log(miTabla);
	var miybody = miTabla.getElementsByTagName("tbody")[0];
	//console.log(miybody.rows.length);
	var iv = 0;
	var subT = 0;
	var tot = 0;
	var totales = 0;
	for (var i = 0; i <= miybody.rows.length; i++) {
		var miFila = miybody.getElementsByTagName("tr")[i];
		var miCelda4 = parseFloat(miFila.getElementsByTagName("td")[4].innerHTML);
		totales = totales + miCelda4;
		if((i+1) >= miybody.rows.length){
			iv += totales / 1.13 * 0.13;
			subT += totales / 1.13;
			tot += iv + subT;
			document.getElementById("impuestoDVenta").innerHTML = iv.toFixed(2);
			document.getElementById("subtotal").innerHTML = subT.toFixed(2);
			document.getElementById("total").innerHTML = tot.toFixed(2);
		}	
	}
}

function saveData(){
	var miTabla = document.getElementsByTagName("table")[0];
	//console.log(miTabla);
	var miybody = miTabla.getElementsByTagName("tbody")[0];
	var arreglo = [];
	//console.log(miybody.rows.length);
	for (var i = 0; i <= miybody.rows.length; i++) {

		var miFila = miybody.getElementsByTagName("tr")[i];

		var miCelda1 = miFila.getElementsByTagName("td")[1].innerHTML;
		var miCelda2 = miFila.getElementsByTagName("td")[2].innerHTML;
		var miCelda3 = miFila.getElementsByTagName("td")[3].innerHTML;
		var miCelda4 = miFila.getElementsByTagName("td")[4].innerHTML;
		arreglo.push(miCelda1+ "," +miCelda2+ "," +miCelda3+ "," +miCelda4);

	};
	

}

function createRemoveBtn() {
	var btnRemove = document.createElement('button');
	btnRemove.className = 'btn btn-danger btn-xs btn-block';
	btnRemove.onclick = remove;
	btnRemove.innerText = 'X';
	return btnRemove;
}

function createCell(text) {
	var td = document.createElement('td');
	if(text) {
		td.innerText = text;
	}
	return td;
}

function calcular (argument) {
	for (var i = 0; i < Things.length; i++) {
		Things[i]
	};
}
</script>

@stop