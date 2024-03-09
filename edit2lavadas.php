<?php
	include('conn.php');
	
	$id=$_POST['_id'];

	$valor_cobrado=$_POST['_valorlavada'];
	$fecha_salida=$_POST['_fecha_salida'];
	


	if(isset($_POST['_valorlavada']) && !empty($_POST['_valorlavada'])) {
		// $_GET['valorlavada'] is not empty
		$valor_cobrado = $_POST['_valorlavada'];
		$sql2= "update lavadas set valor_cobrado='$valor_cobrado', fecha_salida='$fecha_salida', estado= 0 where id='$id'";
		$respuesta =mysqli_query($conn,$sql2);

		echo $respuesta ;
	} else {
		// $_GET['valorlavada'] is empty
		$respuesta = "El dato valorl está vacío.";
		echo $respuesta ;
		// Handle the case when the value is empty, such as displaying an error message or redirecting the user
	}
		
		

	
	
	

?>