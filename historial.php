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
					<!--div class="col-lg-4">
						<input type="date" class="form-control" id="fechai" name="fechai"  require 
							placeholder="Fecha incio" >
					</div -->
					<div class="col-lg-4">
					<label>Seleccione la fecha:</label>
						<input type="date"   class="form-control" id="fechaf" name="fechaf"  require
							placeholder="Fecha fin" value="<?php if (isset($_POST['fechaf'])) {
								echo $_POST['fechaf'];
							} ?>" >
					</div>
					<div class="col-lg-4">
					<br/>					
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>
							Consultar</button>

					</div>
				</form>
				<br><br>

			<div style="height:30px;"></div>
			<?php 
			include('conn.php');
			
			
			// Establecer la zona horaria a Colombia
                date_default_timezone_set('America/Bogota');

				$dia = date('d'); // Día actual (en formato de dos dígitos, con ceros iniciales si es necesario)
                $mes = date('m'); // Mes actual (en formato de dos dígitos, con ceros iniciales si es necesario)
                $ano = date('Y'); // Año actual (en formato de cuatro dígitos)
                
                $fecha =  $ano."-".$mes."-". $dia;
                //echo $fecha;
                
				$contaor = 0;
				if (isset($_POST['fechaf'])) {
					

					$ff = $_POST['fechaf'];
					
					$formatoValido = '/^\d{4}-\d{2}-\d{2}$/';
					
					 $fechaf = preg_match($formatoValido,$ff);
			
			       // $sql =  "SELECT SUM(valor_cobrado) AS total FROM moto WHERE   fecha_salida >= "."'$fi'"." AND fecha_salida <=  "."'$ff'";
			         $sql ="SELECT SUM(valor_cobrado) AS total FROM moto WHERE fecha_salida >= '$ff' AND fecha_salida < DATE_ADD('$ff', INTERVAL 1 DAY);";
					 //echo $sql;
					 $totalParqueadero = mysqli_query($conn,	$sql);
					 $filapar = mysqli_fetch_assoc($totalParqueadero);
					 $totalParqueadero2 = $filapar['total'];
 
 
					 $totalLavadas = mysqli_query($conn, "SELECT SUM(valor_cobrado) AS  totallavadas FROM lavadas WHERE  fecha_salida >= '$ff' AND fecha_salida < DATE_ADD('$ff', INTERVAL 1 DAY);");
					 $filalav= mysqli_fetch_assoc($totalLavadas);
					 $totalLavadas = $filalav['totallavadas'];
 
					 
					 $sqlingresos = "SELECT SUM(valor) AS total FROM ingresos WHERE fecha >= '$ff' AND fecha < DATE_ADD('$ff', INTERVAL 1 DAY);";
					 //echo $sqlingresos;
					 $totalIngresos = mysqli_query($conn,$sqlingresos );
					 $filain = mysqli_fetch_assoc($totalIngresos);
					 $totalIngresos2 = $filain['total'];
 
 
					  $totalEgresos = mysqli_query($conn, "SELECT SUM(valor) AS total FROM egresos WHERE fecha >='$ff' AND fecha < DATE_ADD('$ff', INTERVAL 1 DAY);");
					  $filae = mysqli_fetch_assoc($totalEgresos);
					  $totalEgresos2 = $filae['total'];
 
					} else {

					$totalParqueadero = mysqli_query($conn, "SELECT SUM(valor_cobrado) AS total FROM moto WHERE DATE(fecha_salida)= '$fecha';");
					$filapar = mysqli_fetch_assoc($totalParqueadero);
					$totalParqueadero2 = $filapar['total'];


					$totalLavadas = mysqli_query($conn, "SELECT SUM(valor_cobrado) AS totallavadas FROM lavadas WHERE DATE(fecha_salida)=  '$fecha';");
					$filalav = mysqli_fetch_assoc($totalLavadas);
					$totalLavadas = $filalav['totallavadas'];


					 $totalIngresos = mysqli_query($conn, "SELECT SUM(valor) AS total FROM ingresos WHERE DATE(fecha) =  '$fecha';");
					 $filain = mysqli_fetch_assoc($totalIngresos);
					 $totalIngresos2 = $filain['total'];

					 $totalEgresos = mysqli_query($conn, "SELECT SUM(valor) AS total FROM egresos WHERE DATE(fecha) =  '$fecha';");
					 $filae = mysqli_fetch_assoc($totalEgresos);
					 $totalEgresos2 = $filae['total'];

					}

					//egresos


				?>

			<table class="table table-striped table-bordered table-hover">
				<thead>
					<th>Fecha</th>
					<th>Parqueadero</th>
					<th>Lavadas</th>
					<th>Ingresos</th>
					<th>Gastos</th>
					<th>Total</th>
					
				</thead>
				<tbody>
					<tr>
						<td>
							<?php
							if (isset($_POST['fechaf'])) {
								echo $_POST['fechaf'];
							}else{
								echo $fecha;
							}

							?>
						</td>
						<td> <?php echo "$".number_format((int)$totalParqueadero2,0,',','.');?> </td>
						<td> <?php echo "$".number_format((int)$totalLavadas,0,',','.');?> </td>
						<td> <?php echo "$".number_format((int)$totalIngresos2,0,',','.'); ?> </td>
						<td> <?php echo "$".number_format((int)$totalEgresos2,0,',','.'); ?> </td>
						
						<td>
							<?php 
								$totaldia = (($totalParqueadero2+$totalLavadas+$totalIngresos2)-$totalEgresos2);
							
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