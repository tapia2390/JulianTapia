<?php
// Suponiendo que ya tienes la conexión a la base de datos establecida.
include '../../../conn.php'; // archivo de conexión a la base de datos.

$sql = "SELECT id, categoria FROM menu_items"; // Consulta para obtener los ítems
$result = $conn->query($sql);

// Crear el select
if ($result->num_rows > 0) {
    echo '<select id="menu_item_id" name="menu_item_id" required>';
    echo '<option value="">Seleccione una categoría</option>';

    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . $row['categoria'] . '</option>';
    }

    echo '</select>';
} else {
    echo 'No se encontraron ítems.';
}

$conn->close();
