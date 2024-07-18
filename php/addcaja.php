<?php
	include('../conn.php');
	
	$inicio_monedas=$_POST['inicio_monedas'];
	$fin_monedas=$_POST['fin_monedas'];
	$fin_billetes =$_POST['fin_billetes'];
	$observaciones=$_POST['observaciones'];

	// Configura la zona horaria a la de tu ubicación (opcional)
	date_default_timezone_set('America/Bogota');

	// Obtiene la fecha actual
	$fecha_ingreso = date('Y-m-d H:i:s');
	
	$sql ="insert into caja (inicio_monedas, fin_mondesa, fin_billetes,observaciones,fecha) values ('$inicio_monedas', '$fin_monedas', '$fin_billetes','$observaciones','$fecha_ingreso')";

	$result =mysqli_query($conn,$sql);

	
	
	echo $result;

?>