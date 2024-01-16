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
				<center><strong>Gastos</strong></center>
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

				<table class="table table-striped table-bordered table-hover">
					</tr>
					<td>
						<div class="row">
							<div class="col-lg-12">
								<label class="control-label" style="position:relative; top:7px;">Valor:</label>
							</div>
							<div class="col-lg-10">
								<input type="number" class="form-control valor" id="valor" name="valor" require>
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
							<button type="button" class="btn btn-primary" onclick="saveegresos()">
								<span class="glyphicon glyphicon-floppy-disk">Guardar</span> </button>
						</div>
					</td>
					</tr>
				</table>
			</div>


			<div style="height:50px;"></div>



			<div class="row">

				<form method="POST" action="#">
					<div class="col-lg-6">
						<input type="text" class="form-control" id="descripcion" name="descripcion" require
							placeholder="Descripción ingreso">
					</div>
					<div class="col-lg-6">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>
							Consultar</button>

					</div>
				</form>

				<?php

				include('conn.php');
				$contaor = 0;
				if (isset($_POST['descripcion'])) {
					$descripcion = $_POST['descripcion'];
					$query = mysqli_query($conn, "select * from egresos where  descripcion LIKE '%$descripcion%' ");
				} else {
					$query = mysqli_query($conn, "select * from egresos ");


				}


				?>


			</div>
			<div style="height:10px;"></div>

			<table class="table table-striped table-bordered table-hover">
				<thead>
					<th>#</th>
					<th>Descripcion</th>
					<th>Fecha y Hora</th>
					<th>Valor</th>
				
				</thead>
				<tbody>
					<?php
					$valor = 0;
					while ($row = mysqli_fetch_array($query)) {
						$valor +=$row['valor'];
						?>
						<tr>
							<td>
								<?php echo $contaor += 1 ?>
							</td>
							<td>
								<?php echo ucwords($row['descripcion']); ?>
							</td>
							<td>
								<?php echo ucwords($row['fecha']); ?>
							</td>
							<td>
								<?php echo "$".ucwords( number_format((int)$row['valor'],0,',','.')); ?>
							</td>
							


						</tr>
						<?php
					}

					?>
				</tbody>
			</table>
			<table class="table table-striped table-bordered table-hover" border="0" >
			<tr>
			
							<td>
								<?php echo "<b style='float: right;padding: 10px;padding-right: 8%;'> Total Gastos :  $".  number_format((int)$valor,0,',','.')."</b>" ?>
							</td>
			</table>
		</div>


	</div>
</body>

</html>