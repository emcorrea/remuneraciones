<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/interfaz-registrar-DAO.php';

class registrar implements interfazRegistrarDAO{
	private $conexion;
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }  

	function costosFijos($rut){
		try {
			$conexion = new DBconexion();

			$sql=$conexion->prepare("
			SELECT 
				* 
			FROM 
				DETALLE_TIPO_COSTO 
			WHERE
				rut_persona = ? AND 
				codigo_tipo_costo = 1");
			$sql->execute(array($rut));
			$n = 0;

			$filas = $sql->rowCount();
			if($filas == 0){
				?>
				<div class="sinResultados">No posee costos fijos. Ingrese al mantenedor para agregar</div>
				<?php
			}else{
			?>
				<table class="tabla-costos">
					<tr>
						<th colspan="4" class="thtitulo">Costos Fijos</th>
					</tr>
					<tr>
						<th class="thn">N°</th>
						<th class="th">Nombre</th>
						<th class="th">Valor</th>
					</tr>
			<?php
			foreach($sql->fetchAll(PDO::FETCH_OBJ) as $fila) {
				$n++;
				?>
					<tr class="trtd">
						<td class="td"><?=$n?></td>
						<td class="td"><?=$fila->nombre_detalle?></td>
						<td class="td">$ <?=$fila->valor?></td>
				<?php
			}
			?>
					</tr>
				</table>
			<?php
			}
				
		}catch (Exception $e) {
			echo"No se pudo instanciar a la funcion selectAnnio: ".$e;
		}
	}

	function costosVariables($rut){
		try {
			$conexion = new DBconexion();

			$sql=$conexion->prepare("
			SELECT 
				* 
			FROM 
				DETALLE_TIPO_COSTO 
			WHERE
				rut_persona = ? AND
				codigo_tipo_costo = 2");
			$sql->execute(array($rut));
			$n = 0;

			$filas = $sql->rowCount();
			if($filas == 0){
				?>
				<div class="sinResultados">No posee costos Variables. Ingrese al mantenedor para agregar</div>
				<?php
			}else{
			?>
				<table class="tabla-costos">
					<tr>
						<th colspan="4" class="thtitulo">Costos Variables</th>
					</tr>
					<tr>
						<th class="thn">N°</th>
						<th class="th">Nombre</th>
						<th class="th">Valor</th>
					</tr>
			<?php
			foreach($sql->fetchAll(PDO::FETCH_OBJ) as $fila) {
				$n++;
				?>
					<tr class="trtd">
						<td class="td"><?=$n?></td>
						<td class="td"><?=$fila->nombre_detalle?></td>
						<td class="td">$ <?=$fila->valor?></td>
				<?php
			}
			?>
					</tr>
				</table>
			<?php
			}
		}catch (Exception $e) {
			echo"No se pudo instanciar a la funcion selectAnnio: ".$e;
		}	
	}

	function grabaRemuneracion($rut,$annio,$mess,$remuneracion){
		try {
			$conexion = new DBconexion();

			$sql="INSERT INTO REGISTRO_REMUNERACIONES (rut_persona,anio,mes,remuneracion) VALUES (:rut,:anio,:mes,:sueldo)";
			$resultado = $conexion->prepare($sql);
			$resultado->execute(array(':rut'=>$rut,':anio'=>$annio,':mes'=>$mess,':sueldo'=>$remuneracion));

		}catch (Exception $e) {
			echo"No se pudo instanciar a la funcion selectAnnio: ".$e;
		}	

	}

	function grabaRemuneracionDetalle($rut){
		try {

			$conexion = new DBconexion();

			$sql = $conexion->query("SELECT MAX(codigo_registro_remuneracion) as ultimo FROM REGISTRO_REMUNERACIONES");
			$fila = $sql->fetch();
			$ultimaRemuneracion = $fila['ultimo'];


			$sql=$conexion->prepare("SELECT * FROM DETALLE_TIPO_COSTO WHERE rut_persona = ? AND codigo_tipo_costo = 1 AND activo = 1");
			$sql->execute(array($rut));
			foreach ($sql->fetchAll(PDO::FETCH_OBJ) as $fila) {
				//Variables
				$codigoDetalle 		= $fila->codigo_detalle;
				$codigo_tipo_costo 	= $fila->codigo_tipo_costo;
				$valor 				= $fila->valor;
				$fecha 				= date('Y-m-d h:i:s');

				$sql_graba="INSERT INTO REGISTRO_REMUNERACION_DETALLE VALUES (:codigo,:codigodetalle,:tipocosto,:valor,:fecha)";
				$resultado = $conexion->prepare($sql_graba);
				$resultado->execute(array(':codigo'=>$ultimaRemuneracion,':codigodetalle'=>$codigoDetalle,':tipocosto'=>$codigo_tipo_costo,':valor'=>$valor,':fecha'=>$fecha));
			}

			$sql=$conexion->prepare("SELECT * FROM DETALLE_TIPO_COSTO WHERE rut_persona = ? AND codigo_tipo_costo = 2 AND activo = 1");
			$sql->execute(array($rut));
			foreach ($sql->fetchAll(PDO::FETCH_OBJ) as $fila) {
				//Variables
				$codigoDetalle 		= $fila->codigo_detalle;
				$codigo_tipo_costo 	= $fila->codigo_tipo_costo;
				$valor 				= $fila->valor;
				$fecha 				= date('Y-m-d h:i:s');

				$sql_graba="INSERT INTO REGISTRO_REMUNERACION_DETALLE VALUES (:codigo,:codigodetalle,:tipocosto,:valor,:fecha)";
				$resultado = $conexion->prepare($sql_graba);
				$resultado->execute(array(':codigo'=>$ultimaRemuneracion,':codigodetalle'=>$codigoDetalle,':tipocosto'=>$codigo_tipo_costo,':valor'=>$valor,':fecha'=>$fecha));
			}
			
		} catch (Exception $e) {
			
		}
	}

}

?>