<?php
	include('conn.php');
	
	$id=$_GET['id'];

	$valor_cobrado=$_GET['valor_cobrado'];
	$fecha_salida=$_GET['fecha_salida'];
	

		
		$sql2= "update lavadas set valor_cobrado='$valor_cobrado', fecha_salida='$fecha_salida', estado= 0 where id='$id'";
		

		mysqli_query($conn,$sql2);
	
	header('location:index.php');

?>