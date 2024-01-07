<?php
	include('conn.php');
	
	
	$placa=$_POST['placa2'];
	$query=  "select * from moto  where estado=1  and placa LIKE '%$placa%' ";
	echo $query;
	mysqli_query($conn,$query);


	

?>