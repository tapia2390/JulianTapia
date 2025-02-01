<?php
// Incluir la conexión a la base de datos
include '../../../conn.php';

// Configurar cabecera para recibir y enviar datos JSON
header('Content-Type: application/json');

// Leer los datos enviados desde el cliente
$data = json_decode(file_get_contents("php://input"), true);
$action = isset($_POST['action']) ? $_POST['action'] : null;
// Verificar la operación solicitada
if (!isset($action)) {
    echo json_encode(['success' => false, 'message' => 'Acción no especificada.']);
    exit;
}



try {
    switch ($action) {
        case 'create':
        case  'update':
            // Crear un nuevo producto
            if (empty($_POST['nombre']) || empty($_POST['cantidad']) || empty($_POST['referencia']) || empty($_POST['menu_item_id'])) {
                echo json_encode(['success' => false, 'message' => 'Campos obligatorios no pueden estar vacíos.']);
                exit;
            }

            $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            $referencia = $_POST['referencia'];
            $menu_item_id = $_POST['menu_item_id'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $categoria_id = $_POST['categoria'];




            // Configura la zona horaria a la de tu ubicación (opcional)
            date_default_timezone_set('America/Bogota');

            // Obtiene la fecha actual
            $fecha_ingreso = date('Y-m-d');

            // Subir la imagen
            /*  */




            // Verificar si se ha subido una nueva imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

                $imagen = $_FILES['imagen'];
                $imagen_nombre = time() . "_" . $imagen['name'];
                $imagen_ruta = "../uploads/" . $imagen_nombre;

                $imagen_save = "uploads/" . $imagen_nombre;



                // Mover la imagen al directorio de destino
                if (!move_uploaded_file($imagen['tmp_name'], $imagen_ruta)) {
                    echo json_encode([
                        "success" => false,
                        "message" => "Error al subir la imagen."
                    ]);
                    exit;
                }

                $rutaDestino = $imagen_save;
            } else if (!isset($_POST['rutaImg']) && isset($_POST['imagen']) || $_POST['imagen'] == "undefined" || $_POST['imagen'] == "") {
                $rutaDestino = $_POST['rutaImg'];
            } else {
                $rutaDestino = "uploads/parqueadero.png";
            }



            /*
            $stmt = $conn->prepare("CALL sp_insertar_producto(?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sisssiss", $nombre, $cantidad, $referencia, $menu_item_id, $rutaDestino, $precio, $descripcion, $categoria_id);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Producto guardado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al guardar el producto.']);
            }*/


            if ($action == 'create') {



                $stmt = $conn->prepare("CALL sp_insertar_producto(?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sisssiss", $nombre, $cantidad, $referencia, $menu_item_id, $rutaDestino, $precio, $descripcion, $categoria_id);

                if ($stmt->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Producto guardado correctamente.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al guardar el producto.']);
                }

                $stmt->close();
            } else if ($action == 'update') {

                $id = $_POST['id'];
                // Depuración: Ver los valores antes de ejecutar la consulta
                // error_log("ID: $id, Nombre: $nombre, Cantidad: $cantidad, Referencia: $referencia, Menu ID: $menu_item_id, Imagen: $rutaDestino, Precio: $precio, Descripción: $descripcion, Categoría: $categoria_id");


                /*  $sql = "UPDATE productos 
                SET nombre = '$nombre', 
                    cantidad = $cantidad, 
                    referencia = '$referencia', 
                    menu_item_id = $menu_item_id, 
                    imagen = '$rutaDestino', 
                    precio = $precio, 
                    descripcion = '$descripcion', 
                    categoria_id = $categoria_id 
                WHERE id = $id";

                // Log de la consulta para depuración en consola del navegador
                echo json_encode([
                    'success' => false,
                    'message' => 'Consulta SQL Generada: ' . $sql
                ]);
                exit(); // Detener ejecución aquí si solo quieres ver la consulta
*/






                // Llamar al procedimiento almacenado
                $stmt = $conn->prepare("CALL sp_actualizar_producto(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isisssiss", $id, $nombre, $cantidad, $referencia, $menu_item_id, $rutaDestino, $precio, $descripcion, $categoria_id);

                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        echo json_encode(['success' => true, 'message' => 'Producto actualizado correctamente.' . $categoria_id]);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'No se realizaron cambios en el producto (puede que los datos sean los mismos).']);
                    }
                } else {
                    error_log("Error en la actualización: " . $stmt->error);
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar el producto: ' . $stmt->error]);
                }
            }







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



        case 'delete':
            // Eliminar un producto
            if (empty($_POST['id'])) {
                echo json_encode(['success' => false, 'message' => 'ID es obligatorio.']);
                exit;
            }

            $id = $_POST['id'];

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
