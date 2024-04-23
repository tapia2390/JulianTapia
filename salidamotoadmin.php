<!DOCTYPE html>
<html>

<head>
	<title>Parqueadero JT</title>
	<meta charset="UTF-8">
	<meta http-equiv="refresh" content="30">

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
				<center><strong>Ingreso Parqueadero</strong></center>
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

				<table class="table table-striped table-bordered table-hover">
					</tr>
					<td>
						<div class="row">
							<div class="col-lg-12">
								<label class="control-label" style="position:relative; top:7px;">Placa:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" maxlength="7" style="text-transform:uppercase" class="form-control"
									id="placa" name="placa" require>
							</div>
						</div>
					</td>

					<td>
						<div class="row">
							<div class="col-lg-12">
								<label class="control-label" style="position:relative; top:7px;">Cascos:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" style="text-transform:uppercase" class="form-control" id="cascos"
									name="cascos">
							</div>
						</div>
					</td>

					<td>
						<div class="row">
							<div class="col-lg-12">
								<label class="control-label" style="position:relative; top:7px;">Ubicación:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" style="text-transform:uppercase" class="form-control" id="ubicacion"
									name="ubicacion">
							</div>
						</div>
					</td>

					<td>
						<div class="row">
							<div class="col-lg-12">
								<label class="control-label" style="position:relative; top:7px;">Descripción:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" style="text-transform:uppercase" class="form-control"
									id="descripcion" name="descripcion" placeholder="INGRESO DE MOTOS	">
							</div>
						</div>
					</td>

					<td>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" onclick="guardarDatos()"><span
									class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
						</div>
					</td>
					</tr>
				</table>
			</div>


			<div style="height:50px;"></div>



			<div class="row">

				<form method="POST" action="#">
					<div class="col-lg-3">
						<input type="text" maxlength="7" style="text-transform:uppercase" class="form-control"
							name="placa2" require placeholder="BUSCAR POR PLACA">
					</div>
					<div class="col-lg-6">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>
							Consultar</button>
						<a href="salidamoto.php">
							<button type="button" class="btn btn-primary"><span
									class="glyphicon glyphicon-check"></span>
								Salida de motos</button></a>

					</div>
				</form>

				<?php

				include ('conn.php');



				$contaor = 0;
				if (isset($_POST['placa2'])) {
					$placa = $_POST['placa2'];

					$query = mysqli_query($conn, "select * from `moto` where estado=1 and placa LIKE '%$placa%'  ");
				} else {
					$query = mysqli_query($conn, "select * from `moto` where estado=1 ");

				}

				?>


			</div>
			<div style="height:10px;"></div>

			<table class="table table-striped table-bordered table-hover">
				<thead>
					<th>#</th>
					<th>Placa</th>
					<th>Cascos</th>
					<th>Ubicación</th>
					<th>Descripcion</th>
					<th>Fecha y Hora</th>
					<th>Accion</th>
				</thead>
				<tbody>
					<?php
					while ($row = mysqli_fetch_array($query)) {
						?>
						<tr>
							<td>
								<?php echo $contaor += 1 ?>
							</td>
							<td style="text-transform:uppercase">
								<?php echo ucwords($row['placa']); ?>
							</td>
							<td>
								<?php echo ucwords($row['cascos']); ?>
							</td>
							<td>
								<?php echo ucwords($row['ubicacion']); ?>
							</td>
							<td>
								<?php echo ucwords($row['descripcion']); ?>
							</td>
							<td>
								<?php $fechaHoraFormateada = date('Y-m-d h:i:s A', strtotime($row['fecha_ingreso']));
								echo $fechaHoraFormateada; ?>
							</td>
							<td>
								<a href="#" class="btn btn-success" style="margin:5px;" data-toggle="modal"
									data-target="#editModalMoto" data-moto-id="<?php echo $row['id']; ?>"
									data-moto-placa="<?php echo $row['placa']; ?>"								
									data-moto-descripcion="<?php echo $row['descripcion']; ?>"									
									data-moto-valor-cobrado="<?php echo $row['valor_cobrado']; ?>"								
									data-moto-fecha-salida="<?php echo $row['fecha_salida']; ?>"																	
									data-moto-estado="<?php echo $row['estado']; ?>"
									data-moto-casco="<?php echo $row['cascos']; ?>"
									data-moto-ubicacion="<?php echo $row['ubicacion']; ?>"
									><span
										class="glyphicon glyphicon-pencil"></span></a>

								<a href="#imprimir<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-info"
									style="margin:5px;"><span class="glyphicon glyphicon-time"></span> </a>

								<a onclick="btnimprimirRecibo('<?php echo $row['placa']; ?>','<?php echo $row['descripcion']; ?>','<?php echo $row['cascos']; ?>','<?php echo $row['fecha_ingreso']; ?>','<?php echo $row['ubicacion']; ?>')"
									class="btn btn-warning" style="margin:5px;"><span
										class="glyphicon glyphicon-print"></span> </a>

								<a onclick="cambiarTabla('<?php echo $row['id']; ?>','moto')" class="btn btn-primary"
									style="margin:5px;"><span class="glyphicon glyphicon-tint"></span> </a>

								<a onclick="eliminarMoto('<?php echo $row['id']; ?>','<?php echo $row['placa']; ?>')"
									class="btn btn-danger" style="margin:5px;"><span
										class="glyphicon glyphicon-trash"></span> </a>



								<?php include ('button.php'); ?>
							</td>
						</tr>
						<?php
					}

					?>
				</tbody>
			</table>
		</div>
		

		
	<!-- Modal edit -->

	<div class=" modal fade" id="editModalMoto" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Actualizar Datos de la Moto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editForm">
						<div class="form-group">
							<input type="hidden" class="form-control" id="idMoto" name="idMoto">

							<label for="placa">Placa:</label>
							<input type="text" class="form-control" id="placa2" name="placa2"
								required>
						</div>
						<div class="form-group">
							<label for="descripcion">Descripcion:</label>
							<input type="text" class="form-control" id="descripcion2" name="descripcion2">
						</div>
						<div class="form-group">
							<label for="valor_cobrado">Valor Cobrado:</label>
							<input type="number" class="form-control" id="valor_cobrado2" name="valor_cobrado2">
						</div>
						<div class="form-group">
							<label for="fecha_salida">Fecha Salida:</label>
							<input type="datetime-local" class="form-control" id="fecha_salida2" name="fecha_salida2">
						</div>
						
						<div class="form-group">
							<label for="estado">Estado:</label>
							<select class="form-control" id="estado2" name="estado2">
								<option value="1">Ingreso</option>
								<option value="0">Salida</option>
								
							</select>
						</div>

						
						<div class="form-group">
							<label for="cascos">Cascos:</label>
							<input type="text" class="form-control" id="cascos2" name="cascos2">
						</div>

						
						<div class="form-group">
							<label for="ubicacion">Ubicacion:</label>
							<input type="text" class="form-control" id="ubicacion2" name="ubicacion2">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" form="editForm" class="btn btn-primary" onclick="actualizarDatosMoto()">Actualizar</button>
				</div>
			</div>
		</div>
	</div>


		<?php include ('add_modal.php'); ?>
	</div>
</body>

</html>