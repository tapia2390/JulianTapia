<?php
	include('conn.php');
	
	$id=$_GET['id'];
	
	$placa=$_POST['placa'];
	$descripcion=$_POST['descripcion'];
	
	mysqli_query($conn,"update moto set placa='$placa', descripcion='$descripcion' where id='$id'");
	header('location:index.php');

?>