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
            // Crear un nuevo ítem
            if (empty($data['categoria'])) {
                echo json_encode(['success' => false, 'message' => 'El campo Categoría es obligatorio.']);
                exit;
            }

            $categoria = $data['categoria'];

            $stmt = $conn->prepare("CALL sp_insertar_item(?)");
            $stmt->bind_param("s", $categoria);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Ítem guardado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al guardar el ítem.']);
            }
            $stmt->close();
            break;


        case 'read':
            $stmt = $conn->prepare("CALL sp_listar_items()");
            $stmt->execute();
            $result = $stmt->get_result();

            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }

            echo json_encode(['success' => true, 'data' => $items]);
            $stmt->close();
            break;

        case 'update':
            if (empty($data['id']) || empty($data['nombre'])) {
                echo json_encode(['success' => false, 'message' => 'El ID y el Nombre son obligatorios.']);
                exit;
            }

            $id = $data['id'];
            $nombre = $data['nombre'];

            $stmt = $conn->prepare("CALL sp_actualizar_item(?, ?)");
            $stmt->bind_param("is", $id, $nombre);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Ítem actualizado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar el ítem.']);
            }
            $stmt->close();
            break;

        case 'delete':
            if (empty($data['id'])) {
                echo json_encode(['success' => false, 'message' => 'El ID es obligatorio.']);
                exit;
            }

            $id = $data['id'];

            $stmt = $conn->prepare("CALL sp_eliminar_item(?)");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Ítem eliminado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al eliminar el ítem.']);
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
