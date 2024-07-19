<!DOCTYPE html>
<html>

<head>
	<title>Parqueadero JT</title>
	<meta charset="UTF-8">
	<script src="libs/jquery.min.js"></script>
	<link rel="stylesheet" href="libs/bootstrap.min.css" />
	<script src="libs/bootstrap.min.js"></script>
	<script src="js/save.js"></script>
</head>

<body>
	<div class="container">
		<div style="height:50px;"></div>
		<div class="well" style="margin:auto; padding:auto; width:100%;">
			<span style="font-size:25px; color:blue">
				<center><strong>Historial</strong></center>
			</span>
			<div style="height:50px;"></div>
			<div class="container-fluid">

			<table class="table table-striped table-bordered table-hover">
					<tr>
						<td>
							<a href="index.php" class="btn btn-warning" style="width: 100%;"><span class="glyphicon glyphicon-road"></span>
								Parqueadero</a>
						</td>
						<td>
							<a href="lavadas.php"  class="btn btn-primary" style="width: 100%;"><span
									class="	glyphicon glyphicon-tint"></span> Lavadas</a>
						</td>
						<td>
							<a href="ingresos.php"  class="btn btn-warning" style="width: 100%;"><span
									class="	glyphicon glyphicon-usd"></span> Ingresos</a>
						</td>
						<td>
							<a href="gastos.php"  class="btn btn-primary" style="width: 100%;"><span
									class="	glyphicon glyphicon-tags"></span> Gastos</a>

						</td>

						<td>
							<a href="historial.php" class="btn btn-danger" style="width: 100%;"><span
									class="glyphicon glyphicon-repeat"></span> Historial</a>

						</td>
						<td>
							<a href="caja.php" class="btn btn-warning" style="width: 100%;"><span class="glyphicon glyphicon-piggy-bank"></span>
								Caja</a>
						</td>
					</tr>
				</table>


			</div>


			<div style="height:30px;"></div>


			<form method="POST" action="#">

					<div class="col-lg-4">

			<label>Seleccione la fecha Incio:</label>
						<input type="date" class="form-control" id="fechai" name="fechai"  require
							placeholder="Fecha incio" value="<?php if (isset($_POST['fechai'])) {
    echo $_POST['fechai'];
}?>">
					</div>
					<div class="col-lg-4">

			<label>Seleccione la fecha Fin:</label>
						<input type="date"   class="form-control" id="fechaf" name="fechaf"  require
							placeholder="Fecha fin" value="<?php if (isset($_POST['fechaf'])) {
    echo $_POST['fechaf'];
}?>" >
					</div>
					<div class="col-lg-4">
					<br/>
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>
							Consultar</button>
							<a href="historialIndividual.php">Individual</a>

					</div>
				</form>
				<br><br>

			<div style="height:30px;"></div>
			<?php
include 'conn.php';

// Establecer la zona horaria a Colombia
date_default_timezone_set('America/Bogota');

$dia = date('d'); // Día actual (en formato de dos dígitos, con ceros iniciales si es necesario)
$mes = date('m'); // Mes actual (en formato de dos dígitos, con ceros iniciales si es necesario)
$ano = date('Y'); // Año actual (en formato de cuatro dígitos)

$fecha = $ano . "-" . $mes . "-" . $dia;
//echo $fecha;

$contaor = 0;
$sumatriaTotal  =0;
if (isset($_POST['fechai']) && isset($_POST['fechaf'])) {

    $ff = $_POST['fechaf'];

    $fi = $_POST['fechai'];

    $fechaInicio = new DateTime($fi);
    $fechaFin = new DateTime($ff);

// Array para almacenar los resultados por día
    $resultadosPorDia = array();

// Iterar día por día desde $fi hasta $ff
    $intervalo = new DateInterval('P1D');
    $periodo = new DatePeriod($fechaInicio, $intervalo, $fechaFin);

    foreach ($periodo as $fecha) {
        $fechaActual = $fecha->format('Y-m-d');

        // Consulta para obtener el total de moto
        $sqlMoto = "SELECT COALESCE(SUM(valor_cobrado), 0) AS total FROM moto WHERE fecha_salida >= '$fechaActual' AND fecha_salida < DATE_ADD('$fechaActual', INTERVAL 1 DAY)";
        $totalMoto = mysqli_query($conn, $sqlMoto);
        $filaMoto = mysqli_fetch_assoc($totalMoto);
        $totalMoto2 = $filaMoto['total'];

        // Consulta para obtener el total de lavadas
        $sqlLavadas = "SELECT COALESCE(SUM(valor_cobrado), 0) AS totallavadas FROM lavadas WHERE fecha_salida >= '$fechaActual' AND fecha_salida < DATE_ADD('$fechaActual', INTERVAL 1 DAY)";
        $totalLavadas = mysqli_query($conn, $sqlLavadas);
        $filaLavadas = mysqli_fetch_assoc($totalLavadas);
        $totalLavadas2 = $filaLavadas['totallavadas'];

        // Consulta para obtener el total de ingresos
        $sqlIngresos = "SELECT COALESCE(SUM(valor), 0) AS total FROM ingresos WHERE fecha >= '$fechaActual' AND fecha < DATE_ADD('$fechaActual', INTERVAL 1 DAY)";
        $totalIngresos = mysqli_query($conn, $sqlIngresos);
        $filaIngresos = mysqli_fetch_assoc($totalIngresos);
        $totalIngresos2 = $filaIngresos['total'];

        // Consulta para obtener el total de egresos
        $sqlEgresos = "SELECT COALESCE(SUM(valor), 0) AS total FROM egresos WHERE fecha >= '$fechaActual' AND fecha < DATE_ADD('$fechaActual', INTERVAL 1 DAY)";
        $totalEgresos = mysqli_query($conn, $sqlEgresos);
        $filaEgresos = mysqli_fetch_assoc($totalEgresos);
        $totalEgresos2 = $filaEgresos['total'];

        // Guardar los resultados en un array asociativo por fecha
        $resultadosPorDia[$fechaActual] = array(
            'totalMoto' => $totalMoto2,
            'totalLavadas' => $totalLavadas2,
            'totalIngresos' => $totalIngresos2,
            'totalEgresos' => $totalEgresos2,
        );
    }

} else {

  // Si $resultadosPorDia está vacío, agregar una entrada con la fecha actual
if (empty($resultadosPorDia)) {
    $fechaActual = date('Y-m-d');
    $resultadosPorDia[$fechaActual] = array(
        'totalMoto' => 0,
        'totalLavadas' => 0,
        'totalIngresos' => 0,
        'totalEgresos' => 0,
        'totalDia' => 0
    );
}

}

//egresos

?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Parqueadero</th>
            <th>Lavadas</th>
            <th>Ingresos</th>
            <th>Gastos</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultadosPorDia as $fecha => $resultados): ?>
            <tr>
                <td><?php echo $fecha; ?></td>
                <td><?php echo "$" . number_format((int) $resultados['totalMoto'], 0, ',', '.'); ?></td>
                <td><?php echo "$" . number_format((int) $resultados['totalLavadas'], 0, ',', '.'); ?></td>
                <td><?php echo "$" . number_format((int) $resultados['totalIngresos'], 0, ',', '.'); ?></td>
                <td><?php echo "$" . number_format((int) $resultados['totalEgresos'], 0, ',', '.'); ?></td>
                <td><?php

$sumatoria = $resultados['totalMoto'] + $resultados['totalLavadas'] + $resultados['totalIngresos'] - $resultados['totalEgresos'];

echo "$" . number_format((int) $sumatoria, 0, ',', '.');

$sumatriaTotal  += $sumatoria
?></td>
            </tr>
        <?php endforeach;?>

        
    </tbody>
</table>
<table  style="border: 0px solid white; width:100%;">
    <tr>
        <td style="float: inline-end; padding-right: 1%;"> <p>Total : <?php echo "$". $sumatriaTotal ?></p> </td>
    </tr>
</table>



		</div>


	</div>
</body>

</html>