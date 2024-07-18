<?php
	include('../conn.php');
	
	
	$id_caja=$_POST['id_caja'];
	$inicio_monedas=$_POST['inicio_monedas'];
	$fin_monedas=$_POST['fin_monedas'];
	$fin_billetes =$_POST['fin_billetes'];
	$observaciones=$_POST['observaciones'];

	// Configura la zona horaria a la de tu ubicación (opcional)
	date_default_timezone_set('America/Bogota');

	// Obtiene la fecha actual
	$fecha_ingreso = date('Y-m-d H:i:s');
	
	$sql = "UPDATE caja
         SET inicio_monedas = $inicio_monedas,
		 	fin_mondesa = $fin_monedas,
             fin_billetes = $fin_billetes,
             observaciones = '$observaciones'
         WHERE id = $id_caja";
	$result =mysqli_query($conn,$sql);

	
	
	echo $result;

?>