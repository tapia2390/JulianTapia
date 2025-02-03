<?php
// Conexión a la base de datos
include '../../../conn.php'; // Archivo que contiene la conexión a la BD


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir el producto_id desde la solicitud GET
$producto_id = isset($_GET['producto_id']) ? intval($_GET['producto_id']) : 0;

// Llamar al procedimiento almacenado
$sql = "CALL obtenerVentasPorProducto($producto_id)";

$result = $conn->query($sql);

$ventas = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ventas[] = $row;
    }
}

$conn->close();

// Devolver los resultados en formato JSON
echo json_encode($ventas);
