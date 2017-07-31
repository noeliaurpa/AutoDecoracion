@extends('layouts.appLR')
<!--this two lines are for drop down the menu-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--........................................-->
@section('content')
@parent
<div class="col-md-10 col-xs-10">
	<h2 class="page-header" style="color:#831608;">
		Nueva Factura
	</h2>
	<!--form action=" {{ url('/invoices') }}" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}"-->
	<div class="well well-sm">
		<div class="row">
			<div class="col-xs-10">
				<input id="nameClient" name="nameClient" class="form-control" type="text" placeholder="Nombre del cliente"/>
			</div>
			<div class="col-xs-2">
				<input id="numInvoice" value="{{$numInvoice+1}}" name="numInvoice" class="form-control" type="text" placeholder="numero de factura" readonly>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-4">
				<input id="brand" name="brand" class="form-control" type="text" placeholder="Marca del vehículo"/>
			</div>
			<div class="col-xs-4">
				<input id="model" name="model" class="form-control" type="text" placeholder="Modelo del vehículo"/>
			</div>
			<div class="col-xs-4">
				<input id="license" name="license" class="form-control awesomplete" type="text" placeholder="placa" data-list="#mylicense" data-multiple />
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
			<input id="price" class="form-control" type="number" placeholder="Precio">	
		</div>
		<div class="col-xs-1">
			<a onclick="add(this)" class="btn btn-primary form-control" id="btn-agregar">
				<span class="glyphicon glyphicon-plus"></span>
			</a>
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
				<th style="width:105px">Total</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4" class="text-right"><b>Impuesto de venta ₡</b></td>
				<td name="IV" id="impuestoDVenta" class="text-right">0</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Sub total ₡</b></td>
				<td id="subtotal" class="text-right">0</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Total ₡</b></td>
				<td id="total" class="text-right">0</td>
			</tr>
		</tfoot>
	</table>
	<div class="form-group">
		<button onclick="saveData()" id="save" class="btn btn-primary">Guardar</button>
		<a class="btn btn-danger" href="{{ URL::to('invoices/') }}">Cancelar</a>
	</div>

	<!--/form-->
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
	for (var i = 0; i <= vehi.length; i++) {
		//si donde está seleccionado es igual al texto del input con el id license
		if(vehi[i] == document.getElementById("license").value){
			//coloque la marca y el modelo
			document.getElementById("brand").value = vehi[i+4];
			document.getElementById("model").value = vehi[i+8];
			//realicé otro for para recorrer los clientes
			for (var y = 0; y <= cli.length; y++) {
				//si donde está seleccionado es igual a el id del clientes que tiene el vehículo seleccionado
				if(cli[y] == vehi[i-3]){
					//se coloca el nombre del cliente en el input que tiene el ip nameClien
					document.getElementById("nameClient").value = cli[y+3];
					//document.getElementById("numInvoice").value = "000"+cli[y].split(":")[1].split(",")[0];
				}else{
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
	if(article == "" || quanti == "" || price == ""){
		alert("Debe agregar los campos del nombre del articulo, la cantidad y el precio para poder agregarlo a la factura.");
	}else{
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
			document.getElementById("quantity").value = "";
		}	
	}
}
}
var BASEURL = "{{ url('/') }}"
function saveData(){
	//debugger;
	document.getElementById("save").disabled = true;
	var miTabla = document.getElementsByTagName("table")[0];
	//console.log(miTabla);
	var miybody = miTabla.getElementsByTagName("tbody")[0];
	var arreglo = [];
	//console.log(miybody.rows.length);
	for (var i = 0; i < miybody.rows.length; i++) {

		var miFila = miybody.getElementsByTagName("tr")[i];

		var miCelda1 = miFila.getElementsByTagName("td")[1].innerHTML;
		var miCelda2 = miFila.getElementsByTagName("td")[2].innerHTML;
		var miCelda3 = miFila.getElementsByTagName("td")[3].innerHTML;
		var miCelda4 = miFila.getElementsByTagName("td")[4].innerHTML;
		arreglo.push(miCelda1);
		arreglo.push(miCelda2);
		arreglo.push(miCelda3);
		arreglo.push(miCelda4);
	};
	if(document.getElementById('nameClient').value == ""){
		alert("Se requiere el nombre del cliente");
	}else if(document.getElementById('license').value == ""){
		alert("Se requiere el numero de placa");
	}else if(arreglo.length == 0){
		alert("No se puede completar la factura sin articulos");
	}else{
		$.post(BASEURL + '/invoices', {
			nameC: document.getElementById("nameClient").value,
			brand: document.getElementById("brand").value,
			model: document.getElementById("model").value,
			license: document.getElementById("license").value,
			numInvoice: document.getElementById("numInvoice").value,
			iv: document.getElementById("impuestoDVenta").innerHTML,
			sbt: document.getElementById("subtotal").innerHTML,
			tot: document.getElementById("total").innerHTML,
			detail: arreglo,
		}, function (r) {
			return window.location.href = BASEURL + '/invoices';
		});
	}

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