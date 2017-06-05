<?php
//require('C:\xampp\htdocs\AutoDecoracionPalmares\textmagic\TextMagicAPI.php');
//require('../../textmagic/inTextMagicAPI.php');

$usuario = 'noeliaurpa';
$password = 'Noelia111495';

$enrutador = new TextMagicAPI(array(
	'username' => $usuario,
	'password' => $password
	));
try {
	$respuesta = $enrutador->send('AutoDecoracion Palmares le informa que su vehículo está listo, lo puede venir a retirar cuando guste.', array(50689559602), true);
	var_dump($respuesta);
} catch (Exception $e) {
	echo("Se produjo un error. ".$e);
}

?>
