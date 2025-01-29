<?php
session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al login
    header("Location: menu.php");
    exit;
}

// Aquí va el contenido del dashboard para usuarios autenticados
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parqueadero JJ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="../ecomerce/css/main.css">
    <link rel="stylesheet" href="admin/css/main.css">
</head>

<body>

    <div class="wrapper">
        <header class="header-mobile">
            <h1 class="logo">Parqueadero JJ</h1>
            <button class="open-menu" id="open-menu">
                <i class="bi bi-list"></i>
            </button>
        </header>
        <aside>
            <button class="close-menu" id="close-menu">
                <i class="bi bi-x"></i>
            </button>
            <header>
                <h1 class="logo">Parqueadero JJ</h1>
            </header>
            <nav>
                <ul class="menu">
                    <li>
                        <a href="../ecomerce/menu.php"><button class="boton-menu boton-categoria"><i class="bi bi-hand-index-thumb-fill"></i>Todos los productos</button></a>
                    </li>
                    <li>
                        <button id="menu_items" class="boton-menu boton-categoria active"><i class="bi bi-hand-index-thumb-fill"></i>Indices del Menú</button>
                    </li>
                    <li>
                        <button id="abrigos" class="boton-menu boton-categoria"><i class="bi bi-hand-index-thumb"></i> Abrigos</button>
                    </li>
                    <li>
                        <button id="camisetas" class="boton-menu boton-categoria"><i class="bi bi-hand-index-thumb"></i> Camisetas</button>
                    </li>
                    <li>
                        <button id="pantalones" class="boton-menu boton-categoria"><i class="bi bi-hand-index-thumb"></i> Pantalones</button>
                    </li>
                    <li>
                        <a href="php/logout.php"><button id="pantalones" class="boton-menu boton-categoria"><i class="bi bi-hand-index-thumb"></i> Cerrar Sesión</button></a>
                    </li>
                </ul>
            </nav>
            <footer>
                <p class="texto-footer"></p>
            </footer>
        </aside>
        <main>
            <h2 class="titulo-principal" id="titulo-principal">Indices del Menú</h2>
            <div id="contenedor-form" class="contenedor-productos2">
                <!-- Esto se va a rellenar con JS -->
            </div>
        </main>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="../ecomerce/js/menu.js"></script>
    <script src="admin/js/form.js"></script>
</body>