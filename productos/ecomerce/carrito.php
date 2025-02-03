<?php
// Inicia la sesión
session_start();
?>

<!DOCTYPE html>
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
            <nav>
                <ul>
                    <li>
                        <a class="boton-menu boton-volver" href="../ecomerce/menu.php">
                            <i class="bi bi-arrow-return-left"></i> Seguir comprando
                        </a>
                    </li>
                    <li>
                        <a class="boton-menu boton-carrito active" href="./carrito.php">
                            <i class="bi bi-cart-fill"></i> Carrito
                        </a>
                    </li>


                </ul>
            </nav>
            <footer>
                <a href="../login.php">
                    <?php if (isset($_SESSION['user_email'])): ?>
                        <p class="texto-footer"><b class="boton-menu"><?php echo $_SESSION['user_email']; ?></b></p>
                    <?php else: ?>
                        <p class="texto-footer"><b class="boton-menu">Iniciar sesión</b></p>
                    <?php endif; ?>
                </a>
            </footer>
        </aside>
        <main>
            <h2 class="titulo-principal">Carrito</h2>
            <div class="contenedor-carrito">
                <p id="carrito-vacio" class="carrito-vacio">Tu carrito está vacío. <i class="bi bi-emoji-frown"></i></p>

                <div id="carrito-productos" class="carrito-productos disabled">
                    <!-- Esto se va a completar con el JS -->
                </div>

                <div id="carrito-acciones" class="carrito-acciones disabled">
                    <div class="carrito-acciones-izquierda">
                        <button id="carrito-acciones-vaciar" class="carrito-acciones-vaciar">Vaciar carrito</button>
                    </div>
                    <div class="carrito-acciones-derecha">
                        <div class="carrito-acciones-total">
                            <p>Total:</p>
                            <p id="total">$0</p>
                        </div>
                        <?php if (isset($_SESSION['user_email'])): ?>
                            <button id="carrito-acciones-comprar" class="whatsapp-btn carrito-acciones-comprar">Vender ahora</button>
                        <?php else: ?>


                            <button class="whatsapp-btn whatsapp-button producto-agregar-btn" id="whatsapp-btn">
                                <img src="https://cdn-icons-png.flaticon.com/512/220/220236.png" width="20px" alt="WhatsApp">
                            </button>
                        <?php endif; ?>

                    </div>
                </div>

                <p id="carrito-comprado" class="carrito-comprado disabled">Muchas gracias por tu compra. <i class="bi bi-emoji-laughing"></i></p>

            </div>
        </main>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/carrito.js"></script>
    <script src="./js/menu.js"></script>
</body>

</html>