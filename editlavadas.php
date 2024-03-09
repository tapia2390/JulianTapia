<?php
	include('conn.php');
	
	$id=$_GET['id'];
	
	$placa=$_POST['placa'];
	$descripcion=$_POST['descripcion'];
	$cascos=$_POST['cascos'];
	$ubicacion=$_POST['ubicacion'];
	
	
		$sql1= "update lavadas	 set placa='$placa', descripcion='$descripcion', cascos='$cascos', ubicacion= '$ubicacion' where id='$id'";
		mysqli_query($conn,$sql1);
	
	

	header('location:lavadas.php');

?>