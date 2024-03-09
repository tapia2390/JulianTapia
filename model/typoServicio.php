<?php
	include('../conn.php');

    if (isset($_POST['id'])) {
        $tabla = $_POST['tabla'];
        $tblType="";
        if( $tabla =="moto"){

            $tblType="lavadas";
        }else{
            $tblType="moto";
        }

        $response ="";
        $id= $_POST['id'];
        $sqlSelect= "SELECT * FROM $tabla WHERE id = $id;";
        $querySQL = mysqli_query($conn, $sqlSelect);

        $placa="";
        $descripcion="";
        $fecha_ingreso="";
        $valor_cobrado="";
        $fecha_salida="";
        $estado="";
        $cascos="";
        $ubicacion="";

        while ($row = mysqli_fetch_assoc($querySQL)) {
            $placa = $row['placa'];
            $descripcion = $row['descripcion'];
            $fecha_ingreso = $row['fecha_ingreso'];
            $valor_cobrado = $row['valor_cobrado'];
            $fecha_salida = $row['fecha_salida'];
            $estado = $row['estado'];
            $cascos = $row['cascos'];
            $ubicacion = $row['ubicacion'];

        }
			
        $sqlInsert= "insert into $tblType (placa, descripcion, fecha_ingreso,valor_cobrado,fecha_salida,estado,cascos,ubicacion) values ('$placa', '$descripcion', '$fecha_ingreso',$valor_cobrado,'$fecha_salida',$estado,'$cascos','$ubicacion')";

        $result =mysqli_query($conn,$sqlInsert);

        if($result =="1"){
            $sqlDelete= "DELETE FROM  $tabla WHERE id = $id;";
            $resultDelete =mysqli_query($conn,$sqlDelete);
            if($resultDelete =="1"){
                $response ="Cambio generado correctamente";
            }else{
                $response ="Error al procesar los daros intentalo de nuevo...";
            }
      
          
        }else{
            $response ="error al procesar los daros intentalo de nuevo...";
        }

        echo  $response;
    }

?>