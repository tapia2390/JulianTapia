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
					$del=mysqli_query($conn,"select * from moto where id='".$row['id']."'");
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
					$del=mysqli_query($conn,"select * from moto where id='".$row['id']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid" id="container-fluid">
				
					<h4><center>*** PARQUEADERO LIBORIO LOPERA ***</h4>
					<h2><center>Placa: <strong style="color:blue;text-transform:uppercase;"><?php echo ucwords($drow['placa']); ?></strong></center></h2>
					<h3><center>Cascos: <strong><?php echo ucwords($drow['cascos']); ?></strong></center></h3>
					<h3><center>Ubicación: <strong><?php echo ucwords($drow['ubicacion']); ?></strong></center></h3>
					
					<h3><center>Descripción: <strong> <br/> <?php echo ucwords($drow['descripcion']); ?></strong></center></h3>
					
					
					<h5><center>Fecha Ingreso: <strong><?php   $fechaHoraFormateada = date('Y-m-d h:i:s A', strtotime($row['fecha_ingreso'])); echo $fechaHoraFormateada; ?></strong></center></h5>
					
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
					


					<h5><center>Valor cobrado: <strong><?php
						$valorHora = 900;
						$valorcero=0;
						$horamayorque6=5000;
						$dias = 10000;
						$valoracobrar = 0;


						if($horas == 0 && $minutos <= 3 ){								
							$valoracobrar  = $valorcero;
						}

						 if($horas == 0 && $minutos > 3 ){								
							$valoracobrar  = $valorHora;
						}
						
						
						 if( $horas > 0 &&  $horas < 6 && $minutos < 9 ){		
							$sumahoras = $horas * $valorHora;
							$valoracobrar  += $sumahoras;

						}

						 if( $horas > 0 &&  $horas < 5 && $minutos  > 9 ){		
							$sumahoras = $horas * $valorHora;
							$sumahoraconminutos = $sumahoras +$valorHora;

							$valoracobrar  += $sumahoraconminutos;

						}


						 if($horas >=5  && $horas  < 14){
								$valoracobrar  += $horamayorque6;

						}

						if($horas >=14){
							$valoracobrar  = $dias;

					}
					

					if($valoracobrar >= $dias){
						$numeroFormateado ="Calcula el valor a cobrar deja la observacion o el vlaor en el recibo.";
					
					}else{
						$numeroFormateado = number_format($valoracobrar, 0, ',', '.');

						}
						
							echo "<h2 style='color:red;'> $".$numeroFormateado."</h2>";
						
					// Formatear el número con un punto como separador de miles
						


				
				
					$fechasalida2 = $fecha_salida->format('Y-m-d H:i:s');
					
					?></strong></center></h5> 	
					<!--h5><center>Hora de salida: <strong><?php echo $fechasalida2?></strong></center></h5--!> 
					<!--h5><center>
						Al estacionar en nuestro parqueadero, reconoces <br>que no nos hacemos responsables por daños o robos<br>
						Horario de Lunes a Sabado de 7:00 AM a 9:00 PM <br>
						Cel: 310-000-0000
					</center></h5-->	

					<input type="hidden"  id="id" name="id" class="form-control" value="<?php echo $id; ?>">
					<input type="hidden"  id="valor_cobrado" name="valor_cobrado" class="form-control" value="<?php echo $valoracobrar; ?>">
					<input type="hidden"  id="fecha_salida" name="fecha_salida" class="form-control" value="<?php echo $fecha_salida->format('Y-m-d H:i:s'); ?>">
					<input type="hidden"  id="tiempo" name="tiempo" class="form-control" value="<?php echo $horas; ?>">



				</div> 
				</div>

				<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                   
					<?php 
					
						$_id = "id=".$id;
						$_valor_cobrado = "valor_cobrado=".$valoracobrar;
						$_fecha_salida = "fecha_salida=".$fechasalida2;

					?>
				
				
				<a href="edit2.php?<?php echo $_id ?>&<?php echo $_valor_cobrado ?>&<?php echo $_fecha_salida ?>" style="cursor: pointer;">Generar pago</a>
                </div>
			 
				<!--button type="button" class="btn btn-success"   onclick="generarPago2()"><span class="glyphicon "></span> Generar pago</button-->
                   

				<script>


				function generarPago2(){

						var id = document.getElementById('id').value;
						var valor = document.getElementById('valor').value;
						var fecha_salida = document.getElementById('fecha_salida').value;
						var tiempo = document.getElementById('tiempo').value;
						var valor_cobrado = document.getElementById('valor_cobrado').value;
						var valorregistro = 0;

						alert(id + "####"+valor_cobrado);

						if(tiempo > 12){

							var valorregistro0 =valor;
							var valorSinPunto = valor.replace(/\./g, "");
							valorregistro =valorSinPunto;

					
						}else{
							valorregistro =valor_cobrado;
						}
						
						if (valor === null || valor === "") {
							alert("Valor no ingresado");
						}else{
							location.href ="edit2.php?id="+id+'&valor_cobrado='+valorregistro+'&fecha_salida='+fecha_salida;
						}
					}
				</script>
			
			</div>
				
            </div>
        </div>
    </div>
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
					$edit=mysqli_query($conn,"select * from moto where id='".$row['id']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
				<form method="POST" action="edit.php?id=<?php echo $erow['id']; ?>">
					<div class="row">
						<div class="col-lg-2">
							<label style="position:relative; top:7px;">Placa:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" style="text-transform:uppercase" name="placa" class="form-control" value="<?php echo $erow['placa']; ?>">
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