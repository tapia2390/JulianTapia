<?php
	include('../conn.php');
	
	


	$idMoto =$_POST['idMoto'];
	$placa=$_POST['placa2'];
	$descripcion=$_POST['descripcion'];
	$valor_cobrado =$_POST['valor_cobrado'];
	$fecha_salida =$_POST['fecha_salida'];
	$estado =$_POST['estado2'];
	$cascos =$_POST['cascos'];
	$ubicacion =$_POST['ubicacion'];



	$sql = "UPDATE moto 
        SET 
            valor_cobrado = '$valor_cobrado',
            fecha_salida = '$fecha_salida',
            estado = '$estado'
        WHERE id = $id ";

		echo $sql;

			$result =mysqli_query($conn,$sql);
	
	
	echo $result;

?>