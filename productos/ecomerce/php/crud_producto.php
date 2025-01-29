<?php
// Incluir la conexión a la base de datos
include '../../../conn.php';

// Configurar cabecera para recibir y enviar datos JSON
header('Content-Type: application/json');

// Leer los datos enviados desde el cliente
$data = json_decode(file_get_contents("php://input"), true);

// Verificar la operación solicitada
if (!isset($data['action'])) {
    echo json_encode(['success' => false, 'message' => 'Acción no especificada.']);
    exit;
}

$action = $data['action'];

try {
    switch ($action) {
        case 'create':
            // Crear un nuevo producto
            if (empty($data['nombre']) || empty($data['cantidad']) || empty($data['referencia']) || empty($data['menu_item_id'])) {
                echo json_encode(['success' => false, 'message' => 'Campos obligatorios no pueden estar vacíos.']);
                exit;
            }

            $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            $referencia = $_POST['referencia'];
            $menu_item_id = $_POST['menu_item_id'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $categoria_id = $data['categoria_id'];

            // Subir la imagen
            $imagen = $_FILES['imagen'];
            $imagen_nombre = time() . "_" . $imagen['name'];
            $imagen_ruta = "../uploads/" . $imagen_nombre;
            move_uploaded_file($imagen['tmp_name'], $imagen_ruta);




            $stmt = $conn->prepare("CALL sp_insertar_producto(?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sisssiss", $nombre, $cantidad, $referencia, $menu_item_id, $imagen, $precio, $descripcion, $categoria_id);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Producto guardado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al guardar el producto.']);
            }
            $stmt->close();
            break;

        case 'read':
            // Listar todos los productos
            $stmt = $conn->prepare("CALL sp_listar_productos()");
            $stmt->execute();
            $result = $stmt->get_result();

            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }

            echo json_encode(['success' => true, 'data' => $productos]);
            $stmt->close();
            break;

        case 'update':
            // Actualizar un producto existente
            if (empty($data['id']) || empty($data['nombre'])) {
                echo json_encode(['success' => false, 'message' => 'ID y Nombre son obligatorios.']);
                exit;
            }

            $id = $data['id'];
            $nombre = $data['nombre'];
            $cantidad = $data['cantidad'];
            $referencia = $data['referencia'];
            $menu_item_id = $data['menu_item_id'];
            $imagen = $data['imagen'];
            $precio = $data['precio'];
            $descripcion = $data['descripcion'];
            $categoria_id = $data['categoria_id'];

            $stmt = $conn->prepare("CALL sp_actualizar_producto(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iisssisss", $id, $nombre, $cantidad, $referencia, $menu_item_id, $imagen, $precio, $descripcion, $categoria_id);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Producto actualizado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar el producto.']);
            }
            $stmt->close();
            break;

        case 'delete':
            // Eliminar un producto
            if (empty($data['id'])) {
                echo json_encode(['success' => false, 'message' => 'ID es obligatorio.']);
                exit;
            }

            $id = $data['id'];

            $stmt = $conn->prepare("CALL sp_eliminar_producto(?)");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto.']);
            }
            $stmt->close();
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Acción no reconocida.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

// Cerrar conexión
$conn->close();
