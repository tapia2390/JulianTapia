<?php
ini_set('session.cookie_httponly', 1);
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="ecomerce/css/main.css"> <!-- Personaliza tu CSS -->
    <link rel="stylesheet" href="ecomerce/css/login.css"> <!-- Personaliza tu CSS -->
</head>

<body>
    <div class="container">
        <a href="ecomerce/menu.php" style="display: unset !important;"><button class="producto-agregar2">
                < </button></a>
        <h2>Iniciar sesión</h2>

        <!-- Mensajes de error o éxito -->
        <div class="error" id="error-message" style="display: none;">Correo o contraseña incorrectos.</div>
        <div class="success" id="success-message" style="display: none;">Bienvenido!</div>

        <form method="POST" action="login.php">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>

        <footer>

        </footer>
    </div>
    <script src="ecomerce/js/login.js"></script>
</body>

</html>