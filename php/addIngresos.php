<?php
	include('../conn.php');

	$valor=$_POST['valor'];
	$descripcion=$_POST['descripcion'];
    $nuevo=intval($valor);  

	// Configura la zona horaria a la de tu ubicación (opcional)
	date_default_timezone_set('America/Bogota');

	// Obtiene la fecha actual
	$fecha_ingreso = date('Y-m-d H:i:s');
	
	$result = mysqli_query($conn,"insert into ingresos (descripcion, fecha,valor) values ('$descripcion', '$fecha_ingreso', '$nuevo')");
	echo $result;

?>