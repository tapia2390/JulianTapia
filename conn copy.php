<?php
 
//MySQLi Procedural

$servername = "localhost";
$username = "root";
$password = "";
$database = "u337928779_mt2"; 
$conn = mysqli_connect($servername,$username,$password,$database);
if (!$conn) {
	die("Error de conexión: " . mysqli_connect_error() . " Código: " . mysqli_connect_errno());

}

/*
$conn = mysqli_connect("localhost","u337928779_mt","LJF|V7=p","u337928779_mt");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}*/

/**
$servername = "localhost";
$username = "u337928779_wit_networ";
$password = "Witnetwork2023*";
$database = "u337928779_wit";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa";
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

*/
 
?>
