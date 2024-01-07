<?php
	include('conn.php');
	
	$id=$_GET['id'];
	
	$placa=$_POST['placa'];
	$descripcion=$_POST['descripcion'];
	$cascos=$_POST['cascos'];
	
		
		echo "<script> alert('uno')</script>";
		$sql1= "update moto set placa='$placa', descripcion='$descripcion', cascos='$cascos' where id='$id'";
		mysqli_query($conn,$sql1);
	
	

	header('location:index.php');

?>