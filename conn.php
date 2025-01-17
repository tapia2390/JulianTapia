<?php
 
//MySQLi Procedural

$servername = "localhost";
$username = "root";
$password = "";
$database = "u337928779_mt"; 
$conn = mysqli_connect($servername,$username,$password,$database);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
 
?>