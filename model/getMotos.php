<?php
	include('../conn.php');
				$contaor = 0;
				if (isset($_POST['placa'])) {
					$placa = $_POST['placa'];

					$query = mysqli_query($conn, "select * from `wp_data_code` where estado=1 and placa LIKE '%$placa%'  ");
				} else {
					$query = mysqli_query($conn, "select * from `wp_data_code` where estado=1 ");

				}
				
// Verificar si la consulta se ejecutó correctamente
if ($query) {
    $response['status'] = 'success'; // Agregar estado de éxito al array de respuesta
    $response['data'] = array(); // Inicializar el array para almacenar los datos

    // Recorrer los resultados de la consulta y agregarlos al array de datos
    while ($row = mysqli_fetch_assoc($query)) {
        $contador++;
        $response['data'][] = array(
            'contador' => $contador,
            'placa' => ucwords($row['placa']),
            'cascos' => ucwords($row['cascos']),
            'ubicacion' => ucwords($row['ubicacion']),
            'descripcion' => ucwords($row['descripcion']),
            'fecha_ingreso' => $row['fecha_ingreso']
            // Agregar más columnas según sea necesario
        );
    }
} else {
    $response['status'] = 'error'; // Agregar estado de error al array de respuesta
    $response['message'] = 'Error al ejecutar la consulta: ' . mysqli_error($conn); // Agregar mensaje de error
}

// Mostrar el array de respuesta como JSON
echo json_encode($response);


?>