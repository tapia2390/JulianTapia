<!DOCTYPE html>
<html>
<head>
	<title>Parqueadero JT</title>
	<script src="libs/jquery.min.js"></script>
	<link rel="stylesheet" href="libs/bootstrap.min.css" />
	<script src="libs/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div style="height:50px;"></div>
	<div class="well" style="margin:auto; padding:auto; width:80%;">
	<span style="font-size:25px; color:blue"><center><strong>Parqueadero</strong></center></span>	
		<div style="height:50px;"></div>
		<div class="container-fluid">
			<form method="POST" action="addnew.php">
				<table class="table table-striped table-bordered table-hover">

					<td>
						<div class="row">
							<div class="col-lg-12">
								<label class="control-label" style="position:relative; top:7px;">Placa:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" class="form-control" name="placa" require>
							</div>
						</div>
					</td>

					<td>
						<div class="row">
							<div class="col-lg-12">
								<label class="control-label" style="position:relative; top:7px;" >Descripción:</label>
							</div>
							<div class="col-lg-10">
								<input type="text" class="form-control" name="descripcion" require>
							</div>
						</div>					
					</td>

					<td>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</a>
						</div>					
					</td>
		
				</table>
			</form>
		</div>
		

		<div style="height:50px;"></div>
		
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<th>#</th>
				<th>Placa</th>
				<th>Descripcion</th>
				<th>Fecha y Hora</th>
				<th>Accion</th>
			</thead>
			<tbody>
			<?php
				include('conn.php');
				
				$contaor =0;
				$query=mysqli_query($conn,"select * from `moto` where estado=1");
				while($row=mysqli_fetch_array($query)){
					?>
					<tr>
						<td><?php echo $contaor += 1 ?></td>
						<td><?php echo ucwords($row['placa']); ?></td>
						<td><?php echo ucwords($row['descripcion']); ?></td>
						<td><?php echo $row['fecha_ingreso']; ?></td>
						<td>
							<a href="#edit<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Editar</a> || 
							<a href="#imprimir<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-check"></span> salida</a>
							<?php include('button.php'); ?>
						</td>
					</tr>
					<?php
				}
			
			?>
			</tbody>
		</table>
	</div>
	<?php include('add_modal.php'); ?>
</div>
</body>
</html>