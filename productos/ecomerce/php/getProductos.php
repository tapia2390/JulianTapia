<?php
// Archivo: getProductos.php
header('Content-Type: application/json'); // Respuesta JSON

// Conexión a la base de datos
include '../../../conn.php'; // Archivo que contiene la conexión a la BD

$query = "SELECT p.id, p.nombre AS titulo, p.cantidad,p.referencia,p.fecha_registro,p.menu_item_id,p.imagen, p.precio, p.descripcion,m.categoria AS menu
          FROM productos p
            JOIN menu_items m ON p.menu_item_id = m.id";




$result = mysqli_query($conn, $query);

$productos = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Convertir la imagen de BLOB a base64
        $imagenBase64 = base64_encode($row['imagen']); // Convierte el BLOB a base64
        $productos[] = [
            'id' => $row['id'],
            'titulo' => $row['titulo'],
            'precio' => $row['precio'],
            'cantidad' => $row['cantidad'],
            // La imagen ahora está en formato base64 para ser mostrada en el navegador
            'imagen' => $row['imagen'],
            'menu_item_id' => [
                'id' => strtolower($row['menu_item_id']), // ID para asociarlo con botones
                'nombre' => $row['menu_item_id'], // Nombre de la categoría
            ],
            'menu' => $row['menu'],
            'descripcion' => $row['descripcion'],
            'referencia' => $row['referencia'],
        ];
    }
}

// Devolver productos como JSON
echo json_encode($productos);

mysqli_close($conn); // Cerrar la conexión
