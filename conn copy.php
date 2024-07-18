<?php
 
//MySQLi Procedural
$conn = mysqli_connect("localhost","u337928779_mt","LJF|V7=p","u337928779_mt");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}


$conn = mysqli_connect("localhost","u337928779_mt","LJF|V7=p","u337928779_mt");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

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
