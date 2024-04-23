<!-- Delete -->
    <!--div class="modal fade" id="del<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Eliminar</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$del=mysqli_query($conn,"select * from lavadas where id='".$row['id']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid">
					<h5><center>Estas seguro <strong><?php echo ucwords($drow['placa']); ?></strong> de eliminar el registro.</center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
                </div>
				
            </div>
        </div>
    </div-->
<!-- /.modal -->

<!-- Imprimir -->
<div class="modal fade" id="imprimir<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Salida de moto</h4></center>
            </div>
			<div class="modal-body">
						<?php

							$id = $row['id'];
							
							// Configura la zona horaria a la de tu ubicación (opcional)
							date_default_timezone_set('America/Bogota');

							// Obtiene la fecha actual
							
							$fecha_salida = new DateTime();
							$fecha_salida->format('Y-m-d H:i:s');
							$del=mysqli_query($conn,"select * from lavadas where id='".$row['id']."'");
							$drow=mysqli_fetch_array($del);
							
						?>
						<div class="container-fluid" id="container-fluid">
						
							<h4><center>*** PARQUEADERO LIBORIO LOPERA ***</h4>
							<h2><center>Placa: <strong style="color:blue;text-transform:uppercase;"><?php echo ucwords($drow['placa']); ?></strong></center></h2>
							<h3><center>Cascos: <strong><?php echo ucwords($drow['cascos']); ?></strong></center></h3>
							<h3><center>Ubicación: <strong><?php echo ucwords($drow['ubicacion']); ?></strong></center></h3>
							
							<h3><center>Descripción: <strong><br/><?php echo ucwords($drow['descripcion']); ?></strong></center></h3>
							
							
							<h5><center>Fecha Ingreso: <strong><?php echo ucwords($drow['fecha_ingreso']); ?></strong></center></h5>
							
							<h5><center>Tiempo: <strong>
							<?php
							// Calcula la diferencia entre las fechas
							$fechaInicio = new DateTime($drow['fecha_ingreso']);
							// Calcula la diferencia entre las fechas
							$diferencia = $fechaInicio->diff($fecha_salida);
							// Obtiene la diferencia en minutos y horas
							
							// Obtiene la diferencia en horas y minutos
								$diferenciaEnHoras = $diferencia->h + ($diferencia->days * 24);
								$diferenciaEnMinutos = $diferencia->i;
								$horas =00;
								$minutos= 00;
								if($diferenciaEnHoras != 0){
									$horas = $diferenciaEnHoras;
								}

								if($diferenciaEnMinutos != 0){
									$minutos = $diferenciaEnMinutos;
								}
								
							
							echo $horas.":".$minutos;
							?>
							</strong></center></h5>
							


							<h5><center>Ingreso valor cobrado: <strong>
							<input type="number"  id="valor" name="valor"  maxlength="7" class="valor form-control " placeholder="INGRESE EL VALOR A COBRAR" style="width: 50%; margin: 2%;">
						
							<?php
						
							$fechasalida2 = $fecha_salida->format('Y-m-d H:i:s');
							
							?></strong></center></h5> 
							

							


						</div> 
			</div>

			<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                   
				
				
				
				<a id="generarPago" onclick="generarPago()" style="cursor: pointer;">Generar pago</a>
			</div>
		</div>
	</div>
</div>
			
			
<script>
    function generarPago(){
		var id = "<?php echo $row['id']; ?>";
		var fecha = "<?php echo $fechasalida2; ?>";
		
		//var valorlavada = $("input[id=valor]").val();
		  var valor = document.getElementById('valor').value;

		//  alert("?¿¿-"+id +"fecha salida"+fecha);
		var valorSinPunto = valor.replace(/\./g, "");
		alert("?¿¿-"+id);
		if (valor === null || valor === "") {
			alert("Valor no ingresado");
			return;
		}



		$.ajax({
        // Action
        url: 'edit2lavadas.php',
        // Method
        type: 'POST',
        data: {
          // Get value
          _id: id,
          _valorlavada: valorSinPunto,
          _fecha_salida:fecha_salida,
        },
        success:function(response){
          
          //alert("response"+response);
          // Response is the output of action file
          if(response == 1){
            window.location.href = 'lavadas.php';
          }
          
          else{
			alert(response)
                // Maneja la respuesta del script PHP aquí
                window.location.href = 'lavadas.php';
          }
        }
      });		  
	}
	
</script>
			
		
    
<!-- /.modal -->

<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Editar</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit=mysqli_query($conn,"select * from lavadas where id='".$row['id']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
				<form method="POST" action="editlavadas.php?id=<?php echo $erow['id']; ?>">
					<div class="row">
						<div class="col-lg-2">
							<label style="position:relative; top:7px;">Placa:</label>
						</div>
						<div class="col-lg-10">
							<input type="text"  style="text-transform:uppercase"  name="placa" class="form-control" value="<?php echo $erow['placa']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>

					<div class="row">
						<div class="col-lg-2">
							<label style="position:relative; top:7px;">Cascos:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" style="text-transform:uppercase" name="cascos" class="form-control" value="<?php echo $erow['cascos']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>

					<div class="row">
						<div class="col-lg-2">
							<label style="position:relative; top:7px;">Ubicación:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" style="text-transform:uppercase" name="ubicacion" class="form-control" value="<?php echo $erow['ubicacion']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label style="position:relative; top:7px;">Descripcion:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" style="text-transform:uppercase" name="descripcion" class="form-control" value="<?php echo $erow['descripcion']; ?>">
						</div>
					</div>
					
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Guardar</button>
                </div>
				</form>
            </div>
        </div>
    </div>
<!-- /.modal -->