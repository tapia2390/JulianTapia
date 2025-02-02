<!DOCTYPE html>
<?php
include('../../conn.php');
?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parqueadero J.J</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>

    <div class="wrapper">
        <header class="header-mobile">
            <h1 class="logo">Parqueadero J.J</h1>
            <button class="open-menu" id="open-menu">
                <i class="bi bi-list"></i>
            </button>
        </header>
        <aside>
            <button class="close-menu" id="close-menu">
                <i class="bi bi-x"></i>
            </button>
            <header>
                <h1 class="logo">Parqueadero J.J</h1>
            </header>
            <?php

            // Consulta para obtener las categorías del menú
            $query = "SELECT * FROM menu_items WHERE tipo = 'categoria'";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                echo '<nav>';
                echo '<ul class="menu">';

                // Primer elemento "Todos los productos"
                echo '<li>';
                echo '<button id="todos" class="boton-menu boton-categoria active">';
                echo '<i class="bi bi-hand-index-thumb-fill"></i> Todos los productos';
                echo '</button>';
                echo '</li>';

                // Generar el resto de los elementos del menú
                while ($row = mysqli_fetch_assoc($result)) {
                    $categoriaId = strtolower($row['categoria']);
                    $icono = $row['icono'];
                    $categoria = $row['categoria'];

                    echo '<li>';
                    echo '<button id="' . $categoriaId . '" class="boton-menu boton-categoria">';
                    echo '<i class="bi ' . $icono . '"></i> ' . $categoria;
                    echo '</button>';
                    echo '</li>';
                }

                echo '<li>';
                echo '<a class="boton-menu boton-carrito" href="./carrito.html">';
                echo '<i class="bi bi-cart-fill"></i> Carrito <span id="numerito" class="numerito">0</span>';
                echo '</a>';
                echo '</li>';


                echo '</ul>';
                echo '</nav>';
            } else {
                echo '<p>Error al cargar el menú o no hay categorías disponibles.</p>';
            }

            mysqli_close($conn); // Cerrar conexión
            ?>
            <footer>
                <a href="../login.php">
                    <p class="texto-footer "><b class="boton-menu"> Iniciar Session </b></p>
                </a>
            </footer>
        </aside>
        <main>
            <h2 class="titulo-principal" id="titulo-principal">Todos los productos</h2>
            <div id="contenedor-productos" class="contenedor-productos">
                <!-- Esto se va a rellenar con JS -->
            </div>
        </main>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/menu.js"></script>
</body>

</html>