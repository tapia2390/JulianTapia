<?php
	include('conn.php');
	
	


	$placa=$_POST['placa'];
	$descripcion=$_POST['descripcion'];
	$cascos =$_POST['cascos'];

	// Configura la zona horaria a la de tu ubicación (opcional)
	date_default_timezone_set('America/Bogota');

	// Obtiene la fecha actual
	$fecha_ingreso = date('Y-m-d H:i:s');
	
	mysqli_query($conn,"insert into moto (placa, descripcion, fecha_ingreso,valor_cobrado,fecha_salida,estado,cascos) values ('$placa', '$descripcion', '$fecha_ingreso',0,'',1,$cascos)");
	echo 1;

?>