<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parqueadero J.J</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>


<body>

    <div class="wrapper">
        <header class="header-mobile">
            <h1 class="logo" id="volver">Parqueadero J.J</h1>
            <button class="open-menu" id="open-menu">
                <i class="bi bi-list"></i>
            </button>
        </header>
        <aside>
            <button class="close-menu" id="close-menu">
                <i class="bi bi-x"></i>
            </button>
            <header>
                <h1 class="logo" id="volver">Parqueadero J.J</h1>
            </header>

            <footer>
                <p class="texto-footer "><b class="boton-menu"> Iniciar Session </b></p>
            </footer>
        </aside>
        <main>
            <a href="menu.php"><button class="producto-agregar2">
                    < </button></a>
            <h2 class="titulo-principal" id="titulo-principal"></h2>
            <div id="contenedor-detalle" class="contenedor-productos2">
                <!-- Esto se va a rellenar con JS -->
            </div>
        </main>
    </div>

    <script src="./js/detalle.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</body>


</html>