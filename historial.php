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
					</tr>
				</table>

				
			</div>


			<div style="height:30px;"></div>


			<form method="POST" action="#">
					<div class="col-lg-4">
						<input type="date" class="form-control" id="fechai" name="fechai"  require 
							placeholder="Fecha incio" >
					</div>
					<div class="col-lg-4">
						<input type="date"   class="form-control" id="fechaf" name="fechaf"  require
							placeholder="Fecha fin" >
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
				if (isset($_POST['fechai'])   && isset($_POST['fechaf'])) {
					

					$fi = $_POST['fechai'];
					$ff = $_POST['fechaf'];
					
					$formatoValido = '/^\d{4}-\d{2}-\d{2}$/';
					 $fechai = preg_match($formatoValido, $fi);

					 $fechaf = preg_match($formatoValido,$ff);
			
					$totalParqueadero = mysqli_query($conn, "SELECT SUM(valor_cobrado) AS total FROM moto WHERE   fecha_salida >= "."'$fi'"." AND fecha_salida <=  "."'$ff'");
					$filapar = mysqli_fetch_assoc($totalParqueadero);
					$totalParqueadero2 = $filapar['total'];

					
					
					$totalIngresos = mysqli_query($conn, "SELECT SUM(valor) AS total FROM ingresos WHERE fecha >= "."'$fi'"."  AND  fecha <=  "."'$ff'");
					$filain = mysqli_fetch_assoc($totalIngresos);
					$totalIngresos2 = $filain['total'];


					 $totalEgresos = mysqli_query($conn, "SELECT SUM(valor) AS total FROM egresos WHERE fecha >= "."'$fi'"."  AND  fecha <=  "."'$ff'");
					 $filae = mysqli_fetch_assoc($totalEgresos);
					 $totalEgresos2 = $filae['total'];

					} else {

					$totalParqueadero = mysqli_query($conn, "SELECT SUM(valor_cobrado) AS total FROM moto WHERE DATE(fecha_salida)= CURDATE();");
					$filapar = mysqli_fetch_assoc($totalParqueadero);
					$totalParqueadero2 = $filapar['total'];

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
					<td> <?php echo "$".number_format((int)$totalParqueadero2,0,',','.');?> </td>
						<td> <?php echo "$".number_format((int)$totalIngresos2,0,',','.'); ?> </td>
						<td> <?php echo "$".number_format((int)$totalEgresos2,0,',','.'); ?> </td>
						<td>
						<?php 
							$totaldia = ($totalParqueadero2+$totalIngresos2)-$totalEgresos2;
							echo "$".number_format((int)$totaldia,0,',','.'); 
						?> 
						</td>
					</tr>
				</tbody>
			</table>
			
		</div>


	</div>
</body>

</html>