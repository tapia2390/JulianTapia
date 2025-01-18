 <?php
    include '../../../conn.php'; // Archivo que contiene la conexión a la BD

    // Obtener los datos enviados
    $producto_id = $_POST['producto_id'];
    $cantidad_vendida = $_POST['cantidad'];
    $total_venta = $_POST['total'];
    $observaciones = $_POST['observaciones'];
    $fecha = date("Y-m-d H:i:s");



    // Comprobar la existencia de stock
    $sql = "SELECT cantidad FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        // Producto no encontrado
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado.']);
        exit;
    }


    // Validar si hay suficiente stock
    if ($product['cantidad'] < $cantidad_vendida) {
        echo json_encode(['success' => false, 'message' => 'Stock insuficiente. Disponibles: ' . $product['cantidad']]);
        exit;
    }




    if ($product && $product['cantidad'] >= $cantidad_vendida) {
        // Actualizar stock en la base de datos
        $nuevo_stock = $product['cantidad'] - $cantidad_vendida;
        $sql_update = "UPDATE productos SET cantidad = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $nuevo_stock, $producto_id);
        $stmt_update->execute();

        // Registrar la venta en la tabla de ventas
        $sql_insert = "INSERT INTO ventas (fecha, producto_id, cantidad, total, observaciones) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("siids", $fecha, $producto_id, $cantidad_vendida, $total_venta, $observaciones);
        $stmt_insert->execute();

        // Responder éxito
        echo json_encode(['success' => true, 'message' => 'Venta registrada correctamente.']);
    } else {
        // Si no hay suficiente stock
        echo json_encode(['success' => false, 'message' => 'No hay suficiente stock disponible.']);
    }

    // Cerrar la conexión
    $conn->close();
    ?>
