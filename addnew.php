<?php
	include('conn.php');
	
	


	$placa=$_POST['placa'];
	$descripcion=$_POST['descripcion'];
	$cascos =$_POST['cascos'];
	$ubicacion =$_POST['ubicacion'];

	// Configura la zona horaria a la de tu ubicación (opcional)
	date_default_timezone_set('America/Bogota');

	// Obtiene la fecha actual
	$fecha_ingreso = date('Y-m-d H:i:s');

	$sqlValidarPlaca= $query =  "select placa from `moto` where estado=1 and placa LIKE '%$placa%' ";
	$resultSql =mysqli_query($conn,$sqlValidarPlaca);
	$placaRow = "";
	while ($row = mysqli_fetch_assoc($resultSql)) {
		$placaRow = $row['placa'];
	}

	$variableSinEspaciosRow = preg_replace('/\s+/', '', $placaRow);
	$variableSinEspacios = preg_replace('/\s+/', '', $placa);

	if($variableSinEspaciosRow != $variableSinEspacios ){
		$result =mysqli_query($conn,"insert into moto (placa, descripcion, fecha_ingreso,valor_cobrado,fecha_salida,estado,cascos,ubicacion) values ('$placa', '$descripcion', '$fecha_ingreso',0,'',1,'$cascos','$ubicacion')");

	}else{
		$result ="Placa ya registrada";
	}
	
	
	echo $result;

?>