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
				<center><strong>Parqueadero</strong></center>
			</span>
			<div style="height:50px;"></div>
			<div class="container-fluid">

				<table class="table table-striped table-bordered table-hover">
					<tr>
						<td>
							<a href="index.php" class="btn btn-warning" style="width: 100%;"><span class="glyphicon glyphicon-edit"></span>
								Parqueadero</a>
						</td>
						<td>
							<a href="ingresos.php"  class="btn btn-danger" style="width: 100%;"><span
									class="glyphicon glyphicon-check"></span> Ingresos</a> 
						</td>
						<td>
							<a href="gastos.php"  class="btn btn-warning" style="width: 100%;"><span
									class="glyphicon glyphicon-edit"></span> Gastos</a>

						</td>

						<td>
							<a href="historial.php" class="btn btn-danger" style="width: 100%;"><span
									class="glyphicon glyphicon-edit"></span> Historial</a>

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
								<input type="text" class="form-control" id="placa" name="placa" require>
							</div>
						</div>
					</td>

					<td>
						<div class="row">
							<div class="col-lg-12">
								<label class="control-label" style="position:relative; top:7px;">Cascos:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" class="form-control" id="cascos" name="cascos" require>
							</div>
						</div>
					</td>

					<td>
						<div class="row">
							<div class="col-lg-12">
								<label class="control-label" style="position:relative; top:7px;">Descripción:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" class="form-control" id="descripcion" name="descripcion" require>
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
					<div class="col-lg-6">
						<input type="text" class="form-control" name="placa2" require placeholder="Placa">
					</div>
					<div class="col-lg-6">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>
							Consultar</button>

					</div>
				</form>

				<?php

				include('conn.php');
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
							<td>
								<?php echo ucwords($row['placa']); ?>
							</td>
							<td>
								<?php echo ucwords($row['cascos']); ?>
							</td>
							<td>
								<?php echo ucwords($row['descripcion']); ?>
							</td>
							<td>
								<?php echo $row['fecha_ingreso']; ?>
							</td>
							<td>
								<a href="#edit<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-warning"><span
										class="glyphicon glyphicon-edit"></span> Editar</a> ||
								<a href="#imprimir<?php echo $row['id']; ?>" data-toggle="modal"
									class="btn btn-danger"><span class="glyphicon glyphicon-check"></span> salida</a> ||
								<a  onclick="btnimprimirRecibo('<?php echo $row['placa']; ?>','<?php echo $row['descripcion']; ?>','<?php echo $row['cascos']; ?>','<?php echo $row['fecha_ingreso']; ?>')"  class="btn btn-warning"><span
										class="glyphicon glyphicon-edit"></span> Imprimir</a>

								<?php include('button.php'); ?>
							</td>
						</tr>
						<?php
					}

					?>
				</tbody>
			</table>
		</div>

		<div id="container-fluid2">
			<div class="container-fluid" id="container-fluid">
			</div>

		</div>
		<?php include('add_modal.php'); ?>
	</div>
</body>

</html>