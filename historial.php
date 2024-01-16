<!DOCTYPE html>
<html>

<head>
	<title>Parqueadero JT</title>
	<script src="libs/jquery.min.js"></script>
	<link rel="stylesheet" href="libs/bootstrap.min.css" />
	<script src="libs/bootstrap.min.js"></script>
	<script src="js/save.js"></script>
</head>

<body>
	<div class="container">
		<div style="height:50px;"></div>
		<div class="well" style="margin:auto; padding:auto; width:80%;">
			<span style="font-size:25px; color:blue">
				<center><strong>Historial</strong></center>
			</span>
			<div style="height:50px;"></div>
			<div class="container-fluid">

		

				<table class="table table-striped table-bordered table-hover">
					<tr>
						<td>
							<a href="index.php" class="btn btn-warning" style="width: 100%;"><span
									class="glyphicon glyphicon-edit"></span>
								Parqueadero</a>
						</td>
						<td>
							<a href="ingresos.php" class="btn btn-danger" style="width: 100%;"><span
									class="glyphicon glyphicon-check"></span> Ingresos</a>
						</td>
						<td>
							<a href="gastos.php" class="btn btn-warning" style="width: 100%;"><span
									class="glyphicon glyphicon-edit"></span> Gastos</a>

						</td>
					</tr>
				</table>

				
			</div>


			<div style="height:30px;"></div>


			<form method="POST" action="#">
					<div class="col-lg-4">
						<input type="text" class="form-control" id="fechai" name="fechai" require
							placeholder="Fecha incio">
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="fechaf" name="fechaf" require
							placeholder="Fecha fin">
					</div>
					<div class="col-lg-4">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>
							Consultar</button>

					</div>
				</form>
				<br>

			<div style="height:30px;"></div>
			<?php 
			include('conn.php');
				$contaor = 0;
				if (isset($_POST['fechai']) && isset($_POST['fechaf']) ) {
					$fechai = $_POST['fechai'];
					$fechaf = $_POST['fechaf'];


					$totalParqueadero = mysqli_query($conn, "SELECT SUM(valor) AS total FROM moto WHERE DATE(fecha_ingreso) BETWEEN '".$fechai."' AND DATE(fecha_salida) '".$fechaf."';");
					$filapar = mysqli_fetch_assoc($totalEgresos);
					$totalParqueadero2 = $filapar['total'];

					
					$totalIngresos = mysqli_query($conn, "SELECT SUM(valor) AS total FROM ingresos WHERE DATE(fecha) BETWEEN '".$fechai."' AND '".$fechaf."';");
					$filain = mysqli_fetch_assoc($totalEgresos);
					$totalIngresos2 = $filain['total'];


					 $totalEgresos = mysqli_query($conn, "SELECT SUM(valor) AS total FROM egresos WHERE DATE(fecha) BETWEEN '".$fechai."' AND '".$fechaf."';");
					 $filae = mysqli_fetch_assoc($totalEgresos);
					 $totalEgresos2 = $filae['total'];

					} else {

					 $totalIngresos = mysqli_query($conn, "SELECT SUM(valor) AS total FROM ingresos WHERE DATE(fecha) = CURDATE();");
					 $filain = mysqli_fetch_assoc($totalIngresos);
					 $totalIngresos2 = $filain['total'];

					 $totalEgresos = mysqli_query($conn, "SELECT SUM(valor) AS total FROM egresos WHERE DATE(fecha) = CURDATE();");
					 $filae = mysqli_fetch_assoc($totalEgresos);
					 $totalEgresos2 = $filae['total'];

					}

					//egresos


				?>

			<table class="table table-striped table-bordered table-hover">
				<thead>
					<th>Parqueadero</th>
					<th>Ingresos</th>
					<th>Gastos</th>
					<th>Total</th>
					
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td> <?php echo "$".$totalIngresos2;?> </td>
						<td> <?php echo "$".$totalEgresos2;?> </td>
						<td></td>
					</tr>
				</tbody>
			</table>
			
		</div>


	</div>
</body>

</html>