<?php
session_start();
include '../../../conn.php'; // Conexión a la base de datos

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar si los campos están vacíos
    if (empty($email) || empty($password)) {
        echo "Por favor ingresa tus credenciales.";
        exit;
    }

    // Verificar si el usuario existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Correo o contraseña incorrectos......']);
        exit;
    }

    $user = $result->fetch_assoc();

    // Verificar la contraseña utilizando password_verify()

    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Genera un hash seguro de la contraseña
    if (password_verify($password, $user['password'])) {
        // Si la contraseña es correcta, iniciar sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_rol'] = $user['rol'];

        echo json_encode(['success' => true, 'message' => '¡Bienvenido!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Correo o contraseña incorrectos.']);
    }
}
