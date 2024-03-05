<?php
	include('../conn.php');
	
	$id=$_POST['id'];
	$placa=$_POST['placa'];
	$descripcion=$_POST['descripcion'];
	$cascos=$_POST['cascos'];
	$ubicacion=$_POST['ubicacion'];
	
		
	
		$sql1= "update wp_data_code set placa='$placa', descripcion='$descripcion', cascos='$cascos', ubicacion= '$ubicacion' where id='$id'";
		
    	$result =mysqli_query($conn,$sql1);
	echo $result;
	


?>