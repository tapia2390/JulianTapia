<<<<<<< HEAD
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
				<center><strong>Caja</strong></center>
			</span>
			<div style="height:50px;"></div>
			<div class="container-fluid">

				<table class="table table-striped table-bordered table-hover">
					<tr>
						<td>
							<a href="index.php" class="btn btn-warning" style="width: 100%;"><span
									class="glyphicon glyphicon-road"></span>
								Parqueadero</a>
						</td>
						<td>
							<a href="lavadas.php" class="btn btn-primary" style="width: 100%;"><span
									class="	glyphicon glyphicon-tint"></span> Lavadas</a>
						</td>
						<td>
							<a href="ingresos.php" class="btn btn-warning" style="width: 100%;"><span
									class="	glyphicon glyphicon-usd"></span> Ingresos</a>
						</td>
						<td>
							<a href="gastos.php" class="btn btn-primary" style="width: 100%;"><span
									class="	glyphicon glyphicon-tags"></span> Gastos</a>

						</td>

						<td>
							<a href="historial.php" class="btn btn-danger" style="width: 100%;"><span
									class="glyphicon glyphicon-repeat"></span> Historial</a>

						</td>

						<td>
							<a href="caja.php" class="btn btn-warning" style="width: 100%;"><span
									class="glyphicon glyphicon-piggy-bank"></span>
								Caja</a>
						</td>

					</tr>
				</table>

				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
					data-target="#addModal">Registro Caja</button>

			</div>


			<div style="height:50px;"></div>



			<div class="row">

				<form method="POST" action="#">
					<div class="col-lg-4">
						<label>Fecha Incion:</label>
						<input type="date" class="form-control" id="fechai" name="fechai" require
							placeholder="Fecha Incio" value="<?php if (isset($_POST['fechai'])) {
								echo $_POST['fechai'];
							} ?>">
					</div>

					<div class="col-lg-4">
						<label>Fecha Fin:</label>
						<input type="date" class="form-control" id="fechaf" name="fechaf" require
							placeholder="Fecha fin" value="<?php if (isset($_POST['fechaf'])) {
								echo $_POST['fechaf'];
							} ?>">
					</div>
					<div class="col-lg-4">
						<br/>
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>
							Consultar</button>

					</div>
				</form>

				<?php

				// Establecer la zona horaria a Colombia
				date_default_timezone_set('America/Bogota');

				$dia = date('d'); // Día actual (en formato de dos dígitos, con ceros iniciales si es necesario)
				$mes = date('m'); // Mes actual (en formato de dos dígitos, con ceros iniciales si es necesario)
				$ano = date('Y'); // Año actual (en formato de cuatro dígitos)
				
				$fecha = $ano . "-" . $mes . "-" . $dia;
				//echo $fecha;
				
				include 'conn.php';
				$contaor = 0;

				$inicio_monedas =0;
				$fin_mondesa =0;				
				$fin_billetes =0;

				if (isset($_POST['fechai']) && isset($_POST['fechaf']) ) {
					$fi = $_POST['fechai'];
					$ff = $_POST['fechaf'];

					$formatoValido = '/^\d{4}-\d{2}-\d{2}$/';

					$fechaf = preg_match($formatoValido, $ff);

					$query = mysqli_query($conn, "select * from caja where  fecha >= '$fi' AND fecha < DATE_ADD('$ff', INTERVAL 1 DAY);");
				} else {
					$query = mysqli_query($conn, "select * from caja order by fecha desc limit 10;");

				}

				?>


			</div>
			<div style="height:10px;"></div>

			<table class="table table-striped table-bordered table-hover">
				<thead>
					<th>#</th>
					<th>Incio Monedas</th>
					<th>Fin Monedas</th>
					<th>Fin Billetes</th>
					<th>Total Monedas / Billetas</th>
					<th>Total</th>
					<th>Fecha y Hora</th>
					<th>Observaciones</th>
					<th>Acciones</th>

				</thead>
				<tbody>
					<?php
					$valor = 0;
					while ($row = mysqli_fetch_array($query)) {
						?>
						<tr>
							<td>
								<?php echo $contaor += 1 ?>
							</td>
							<td>
								
								<?php $inicio_monedas  += $row['inicio_monedas']; echo "$" . ucwords(number_format((int) $row['inicio_monedas'], 0, ',', '.')); ?>

							</td>
							<td>
								<?php $fin_mondesa  += $row['fin_mondesa'];  echo "$" . ucwords(number_format((int) $row['fin_mondesa'], 0, ',', '.')); ?>
							</td>

							<td>
								<?php  $fin_billetes  += $row['fin_billetes'];  echo "$" . ucwords(number_format((int) $row['fin_billetes'], 0, ',', '.')); ?>
							</td>

							<td>
								<?php 
								$totalPlata = $row['fin_billetes'] + $row['fin_mondesa']; 
								echo "$" . ucwords(number_format((int) $totalPlata, 0, ',', '.'));
								?>
								
								<td>
								<?php 
								$totalPlataReal = $row['fin_billetes'] + $row['fin_mondesa']-$row['inicio_monedas']; 
								echo "$" . ucwords(number_format((int) $totalPlataReal, 0, ',', '.'));
								?>
							</td>
							</td>
							<td>
								<?php $fechaHoraFormateada = date('Y-m-d h:i:s A', strtotime($row['fecha']));
								echo $fechaHoraFormateada; ?>

							</td>
							<td>
								<?php echo ucwords($row['observaciones']); ?>
							</td>

							<td>
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
									data-target="#editModal" data-caja-id="<?php echo $row['id']; ?>"
									data-caja-inicio-monedas="<?php echo $row['inicio_monedas']; ?>"
									data-caja-fin-monedas="<?php echo $row['fin_mondesa']; ?>"
									data-caja-fin-billetes="<?php echo $row['fin_billetes']; ?>"
									data-caja-observaciones="<?php echo $row['observaciones']; ?>">Editar</button>
							</td>
						</tr>
						<?php
					}

					?>
				</tbody>
			</table>

			<table class="table table-striped table-bordered table-hover">
				<thead>
					<th>#</th>
					<th>Incio Monedas</th>
					<th>Fin Monedas</th>
					<th>Fin Billetes</th>
					<th>Total Monedas / Billetas</th>
					<th>Total</th>
					<th>Fecha y Hora</th>
					<th>Observaciones</th>
					<th>Acciones</th>

				</thead>
				<tbody>
					<td></td>
					<td></td>
					<td></td>
					<td>Total : <?php  echo "$" . ucwords(number_format((int) $fin_billetes, 0, ',', '.'));?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				</tbody>
			</table>
		</div>


	</div>


	<!-- Modal -->

	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Caja</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editForm">
						<div class="form-group">
							<label for="inicio_monedas">Inicio Monedas:</label>
							<input type="number" class="form-control" id="inicio_monedas" name="inicio_monedas"
								required>
						</div>
						<div class="form-group">
							<label for="fin_monedas">Fin Monedas:</label>
							<input type="number" class="form-control" id="fin_monedas" name="fin_monedas">
						</div>
						<div class="form-group">
							<label for="fin_billetes">Fin Billetes:</label>
							<input type="number" class="form-control" id="fin_billetes" name="fin_billetes">
						</div>


						<div class="form-group">
							<label for="observaciones">Observaciones:</label>
							<input type="text" class="form-control" id="observaciones" name="observaciones">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" form="editForm" class="btn btn-primary" onclick="savecaja()">Guardar</button>
				</div>
			</div>
		</div>
	</div>




	<!-- Modal edit -->

	<div class=" modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Editar Caja</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editForm">
						<div class="form-group">
							<input type="hidden" class="form-control" id="idcaja" name="idcaja">

							<label for="inicio_monedas2">Inicio Monedas:</label>
							<input type="number" class="form-control" id="inicio_monedas2" name="inicio_monedas2"
								required>
						</div>
						<div class="form-group">
							<label for="fin_monedas2">Fin Monedas:</label>
							<input type="number" class="form-control" id="fin_monedas2" name="fin_monedas2">
						</div>
						<div class="form-group">
							<label for="fin_billetes2">Fin Billetes:</label>
							<input type="number" class="form-control" id="fin_billetes2" name="fin_billetes2">
						</div>


						<div class="form-group">
							<label for="observaciones2">Observaciones:</label>
							<input type="text" class="form-control" id="observaciones2" name="observaciones2">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" form="editForm" class="btn btn-primary" onclick="editcaja()">Actualizar</button>
				</div>
			</div>
		</div>
	</div>


</body>

=======
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
				<center><strong>Caja</strong></center>
			</span>
			<div style="height:50px;"></div>
			<div class="container-fluid">

				<table class="table table-striped table-bordered table-hover">
					<tr>
						<td>
							<a href="index.php" class="btn btn-warning" style="width: 100%;"><span
									class="glyphicon glyphicon-road"></span>
								Parqueadero</a>
						</td>
						<td>
							<a href="lavadas.php" class="btn btn-primary" style="width: 100%;"><span
									class="	glyphicon glyphicon-tint"></span> Lavadas</a>
						</td>
						<td>
							<a href="ingresos.php" class="btn btn-warning" style="width: 100%;"><span
									class="	glyphicon glyphicon-usd"></span> Ingresos</a>
						</td>
						<td>
							<a href="gastos.php" class="btn btn-primary" style="width: 100%;"><span
									class="	glyphicon glyphicon-tags"></span> Gastos</a>

						</td>

						<td>
							<a href="historial.php" class="btn btn-danger" style="width: 100%;"><span
									class="glyphicon glyphicon-repeat"></span> Historial</a>

						</td>

						<td>
							<a href="caja.php" class="btn btn-warning" style="width: 100%;"><span
									class="glyphicon glyphicon-piggy-bank"></span>
								Caja</a>
						</td>

					</tr>
				</table>

				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
					data-target="#addModal">Registro Caja</button>

			</div>


			<div style="height:50px;"></div>



			<div class="row">

				<form method="POST" action="#">
					<div class="col-lg-4">
						<label>Seleccione la fecha:</label>
						<input type="date" class="form-control" id="fechaf" name="fechaf" require
							placeholder="Fecha fin" value="<?php if (isset($_POST['fechaf'])) {
								echo $_POST['fechaf'];
							} ?>">
					</div>
					<div class="col-lg-4">
						<br/>
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>
							Consultar</button>

					</div>
				</form>

				<?php

				// Establecer la zona horaria a Colombia
				date_default_timezone_set('America/Bogota');

				$dia = date('d'); // Día actual (en formato de dos dígitos, con ceros iniciales si es necesario)
				$mes = date('m'); // Mes actual (en formato de dos dígitos, con ceros iniciales si es necesario)
				$ano = date('Y'); // Año actual (en formato de cuatro dígitos)
				
				$fecha = $ano . "-" . $mes . "-" . $dia;
				//echo $fecha;
				
				include 'conn.php';
				$contaor = 0;
				if (isset($_POST['fechaf'])) {
					$ff = $_POST['fechaf'];

					$formatoValido = '/^\d{4}-\d{2}-\d{2}$/';

					$fechaf = preg_match($formatoValido, $ff);

					$query = mysqli_query($conn, "select * from caja where  fecha >= '$ff' AND fecha < DATE_ADD('$ff', INTERVAL 1 DAY);");
				} else {
					$query = mysqli_query($conn, "select * from caja order by fecha desc limit 7;");

				}

				?>


			</div>
			<div style="height:10px;"></div>

			<table class="table table-striped table-bordered table-hover">
				<thead>
					<th>#</th>
					<th>Incio Monedas</th>
					<th>Fin Monedas</th>
					<th>Fin Billetes</th>
					<th>Total Monedas / Billetas</th>
					<th>Total</th>
					<th>Fecha y Hora</th>
					<th>Observaciones</th>
					<th>Acciones</th>

				</thead>
				<tbody>
					<?php
					$valor = 0;
					while ($row = mysqli_fetch_array($query)) {
						?>
						<tr>
							<td>
								<?php echo $contaor += 1 ?>
							</td>
							<td>
								<?php echo "$" . ucwords(number_format((int) $row['inicio_monedas'], 0, ',', '.')); ?>

							</td>
							<td>
								<?php echo "$" . ucwords(number_format((int) $row['fin_mondesa'], 0, ',', '.')); ?>
							</td>

							<td>
								<?php echo "$" . ucwords(number_format((int) $row['fin_billetes'], 0, ',', '.')); ?>
							</td>

							<td>
								<?php 
								$totalPlata = $row['fin_billetes'] + $row['fin_mondesa']; 
								echo "$" . ucwords(number_format((int) $totalPlata, 0, ',', '.'));
								?>
								
								<td>
								<?php 
								$totalPlataReal = $row['fin_billetes'] + $row['fin_mondesa']-$row['inicio_monedas']; 
								echo "$" . ucwords(number_format((int) $totalPlataReal, 0, ',', '.'));
								?>
							</td>
							</td>
							<td>
								<?php $fechaHoraFormateada = date('Y-m-d h:i:s A', strtotime($row['fecha']));
								echo $fechaHoraFormateada; ?>

							</td>
							<td>
								<?php echo ucwords($row['observaciones']); ?>
							</td>

							<td>
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
									data-target="#editModal" data-caja-id="<?php echo $row['id']; ?>"
									data-caja-inicio-monedas="<?php echo $row['inicio_monedas']; ?>"
									data-caja-fin-monedas="<?php echo $row['fin_mondesa']; ?>"
									data-caja-fin-billetes="<?php echo $row['fin_billetes']; ?>"
									data-caja-observaciones="<?php echo $row['observaciones']; ?>">Editar</button>
							</td>
						</tr>
						<?php
					}

					?>
				</tbody>
			</table>
		</div>


	</div>


	<!-- Modal -->

	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Caja</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editForm">
						<div class="form-group">
							<label for="inicio_monedas">Inicio Monedas:</label>
							<input type="number" class="form-control" id="inicio_monedas" name="inicio_monedas"
								required>
						</div>
						<div class="form-group">
							<label for="fin_monedas">Fin Monedas:</label>
							<input type="number" class="form-control" id="fin_monedas" name="fin_monedas">
						</div>
						<div class="form-group">
							<label for="fin_billetes">Fin Billetes:</label>
							<input type="number" class="form-control" id="fin_billetes" name="fin_billetes">
						</div>


						<div class="form-group">
							<label for="observaciones">Observaciones:</label>
							<input type="text" class="form-control" id="observaciones" name="observaciones">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" form="editForm" class="btn btn-primary" onclick="savecaja()">Guardar</button>
				</div>
			</div>
		</div>
	</div>




	<!-- Modal edit -->

	<div class=" modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Editar Caja</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editForm">
						<div class="form-group">
							<input type="hidden" class="form-control" id="idcaja" name="idcaja">

							<label for="inicio_monedas2">Inicio Monedas:</label>
							<input type="number" class="form-control" id="inicio_monedas2" name="inicio_monedas2"
								required>
						</div>
						<div class="form-group">
							<label for="fin_monedas2">Fin Monedas:</label>
							<input type="number" class="form-control" id="fin_monedas2" name="fin_monedas2">
						</div>
						<div class="form-group">
							<label for="fin_billetes2">Fin Billetes:</label>
							<input type="number" class="form-control" id="fin_billetes2" name="fin_billetes2">
						</div>


						<div class="form-group">
							<label for="observaciones2">Observaciones:</label>
							<input type="text" class="form-control" id="observaciones2" name="observaciones2">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" form="editForm" class="btn btn-primary" onclick="editcaja()">Actualizar</button>
				</div>
			</div>
		</div>
	</div>


</body>

>>>>>>> c30b82e6ca2f029bedf2a2d5566a1bb9584bf522
</html>