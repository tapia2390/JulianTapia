<!DOCTYPE html>
<html lang="es">

<head>


    <link rel="stylesheet" href="admin/css/ventas.css">
</head>

<body>
    <div class="container">
        <h2>Reporte de Ventas</h2>

        <!-- Formulario de Filtros -->
        <div class="form-container">
            <form id="form-filtros">
                <div class="row">
                    <div class="col">
                        <label for="fecha">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control">
                    </div>
                    <div class="col">
                        <label for="producto">Producto</label>
                        <input type="text" name="producto_id" id="producto_id" class="form-control" placeholder="Buscar por producto">
                    </div>

                    <div class="col">
                        <label for="producto"> &nbsp;</label>
                        <button type="submit" class="btn">Buscar</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabla de Resultados -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-ventas">
                    <tr>
                        <td colspan="7" class="text-center">No hay datos disponibles</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="admin/js/ventas.js"></script>