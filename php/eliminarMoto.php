<?php
	include('../conn.php');
	
	$id=$_POST['id'];
	$sql ="delete from moto where id='$id'";

	$result =mysqli_query($conn,$sql);

	
	
	echo $result;

?>