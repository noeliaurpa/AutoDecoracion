<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Auto Decoracion Palmares</title>
</head>
<body> 
	<div class="container">
		<form action=" {{ url('/send/create') }}" method="post">
		<div class="cuerpo">
			<div class="form-group">
				{!! Form::label('tell', 'Numero de telefono') !!}
				{!! Form::text('tell', old('tell'), ['class' => 'form-control', 'required' => 'required']) !!}
			</div>
		</div>
		<div class="modal-footer">
			{!! Form::submit('GUARDAR', ['class' => 'btn btn-success']) !!}
			<button type="button"class="btn btn-default" data-dismiss="modal">CANCELAR</button>
		</div>
		</form>
	</body>
	</html>
 