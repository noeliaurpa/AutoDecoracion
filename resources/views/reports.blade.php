<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Clients</title>
	<style type="text/css">
	body{
		/*background: #272727;*/
		background: white;
	}
	table{
		border-collapse: collapse;
		/*color:white;*/
		color:black;
	}
	td, th{
		border: 1px solid;
	}
	.header{
		height: 190px;	
		text-align: center;
	}
	.logo{
		height: 90px;
		width: 200px;
		border-radius: 50%;
		text-align: center;
		padding: 30px 0px 0px 0px;
	}
	h4{
		padding: 0px;
		margin: 0px;
		/*color: white;*/
		color: black;
	}
	</style>
</head>
<body>
	<div class="header">
		<a><img class="logo" type="image" src="../public/img/logo.jpg"></a>
		<h4>Dirección: 800 metros este de la concretera Palmares</h4>
		<h4>Teléfono: 24536789</h4>
		<h4>Horario: de 8am a 5pm</h4>
		<h4><label name="fecha" type="text" id="fecha" value="<?php echo date("m/d/Y"); ?>" size="10" /><?php echo date("m/d/Y"); ?></label> </h4>
	</div>
	<hr>
	<div>
		<table class="table table-striped">
			<tr>
				<th>Provider id</th>
				<th>Name</th>
				<th>Tell</th>
				<th>Observation</th>
			</tr>
			@foreach($clients as $c)
			<tr>
				<td>{{$c->provider_id}}</td>
				<td>{{$c->name}}</td>
				<td>{{$c->tell}}</td>
				<td>{{$c->observation}}</td>
			</tr>
			@endforeach
		</table>
	</div>
</body>
</html>