<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/interfaz-historial-DAO.php';

class historial implements interfazHistorialDAO{
	private $conexion;
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }  

    function resumenRemuneracion($rut,$anioHistoria,$mesHistoria){
    	try {
			$conexion = new DBconexion();

			$sql1=$conexion->prepare(" 
			SELECT
				rm.rut_persona,
				rm.anio,
				rm.mes,
				rm.remuneracion,
				tc.nombre_tipo_costo,
				SUM(valor)AS suma
			FROM
				REGISTRO_REMUNERACIONES rm JOIN REGISTRO_REMUNERACION_DETALLE rmd
				ON(rm.codigo_registro_remuneracion = rmd.codigo_registro_remuneracion)
				JOIN TIPO_COSTO tc
				ON(tc.codigo_tipo_costo = rmd.codigo_tipo_costo)
			WHERE
				rm.rut_persona = :rut AND
				rm.anio = :anio AND 
				rm.mes = :mes AND 
				rmd.codigo_tipo_costo = 1
				");
			$sql1->execute(array(':rut'=>$rut,':anio'=>$anioHistoria,':mes'=>$mesHistoria));
			$n = 0;

			foreach($sql1->fetchAll(PDO::FETCH_OBJ) as $fila1) {
				$anio 		= $fila1->anio;
				$mes 		= $fila1->mes;
				$sueldo1 	= $fila1->remuneracion;

				$totalFijos = $fila1->suma; 
			}

			$sql2=$conexion->prepare(" 
			SELECT
				rm.rut_persona,
				rm.anio,
				rm.mes,
				rm.remuneracion,
				tc.nombre_tipo_costo,
				SUM(valor)AS suma
			FROM
				REGISTRO_REMUNERACIONES rm JOIN REGISTRO_REMUNERACION_DETALLE rmd
				ON(rm.codigo_registro_remuneracion = rmd.codigo_registro_remuneracion)
				JOIN TIPO_COSTO tc
				ON(tc.codigo_tipo_costo = rmd.codigo_tipo_costo)
			WHERE
				rm.rut_persona = :rut AND
				rm.anio = :anio AND 
				rm.mes = :mes AND 
				rmd.codigo_tipo_costo = 2
			");
			$sql2->execute(array(':rut'=>$rut,':anio'=>$anioHistoria,':mes'=>$mesHistoria));
			$n = 0;

			foreach($sql2->fetchAll(PDO::FETCH_OBJ) as $fila2) {
				$totalVariable 	= $fila2->suma;
				$sueldo2 		= $fila2->remuneracion; 
			}

			if($sueldo1 == '' && $sueldo2 == ''){
				?>
				<div class="sinResultados">No existen resultados para el periodo seleccionado</div>
				<?php
				exit();
			}

			if($sueldo1 > 0){
				$sueldo = $sueldo1;
			}else if($sueldo2 > 0){
				$sueldo = $sueldo2;
			}

			//VARIABLES PARA LA TABLA
			$totalFijoVariable 	= $totalFijos+$totalVariable;
			$totalGneral 		= $sueldo-$totalFijoVariable;

				?>
				<table class="tabla-costos">
					<tr>
						<th colspan="6" class="thtitulo">Resumen</th>
					</tr>
					<tr>
						<th class="thn">Ingreso</th>
						<td class="thn">$ <?=$sueldo?></td>
					</tr>
						<th class="th">Total Costos Fijos</th>
						<td class="thn">$ <?=($totalFijos == '')? 0:$totalFijos;?></td>
					<tr>
						<th class="th">Total Costos Variables</th>
						<td class="thn">$ <?=($totalVariable == '')? 0:$totalVariable; ?></td>
					</tr>
						<th class="th">Total</th>
						<td class="thn">$ <?=$totalFijoVariable?></td>
					<tr>
						<th class="th">Total - Ingreso</th>
						<td class="thn">$ <?=$totalGneral?></td>
					</tr>
				</table>
				<?php	
		}catch (Exception $e) {
			echo"No se pudo instanciar a la funcion selectAnnio: ".$e;
		}
    }

	function historialRegistroRemuneracion($rut,$anioHistoria,$mesHistoria){
		try {
			$conexion = new DBconexion();

			$sql=$conexion->prepare(" 
			SELECT
				rm.rut_persona,
				dtc.nombre_detalle,
				rmd.valor
			FROM
				REGISTRO_REMUNERACIONES rm JOIN REGISTRO_REMUNERACION_DETALLE rmd
				ON(rm.codigo_registro_remuneracion = rmd.codigo_registro_remuneracion)
				JOIN DETALLE_TIPO_COSTO dtc
				ON(dtc.codigo_detalle = rmd.codigo_detalle)
			WHERE
				rm.rut_persona = :rut AND
				rm.anio = :anio AND 
				rm.mes = :mes AND 
				rmd.codigo_tipo_costo = 1
			");

			$sql->execute(array(':rut'=>$rut,':anio'=>$anioHistoria,':mes'=>$mesHistoria));
			$n = 0;
			$filas = $sql->rowCount();

			if($filas != 0){
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

			$sql=$conexion->prepare(" 
			SELECT
				rm.rut_persona,
				dtc.nombre_detalle,
				rmd.valor
			FROM
				REGISTRO_REMUNERACIONES rm JOIN REGISTRO_REMUNERACION_DETALLE rmd
				ON(rm.codigo_registro_remuneracion = rmd.codigo_registro_remuneracion)
				JOIN DETALLE_TIPO_COSTO dtc
				ON(dtc.codigo_detalle = rmd.codigo_detalle)
			WHERE
				rm.rut_persona = :rut AND
				rm.anio = :anio AND 
				rm.mes = :mes AND 
				rmd.codigo_tipo_costo = 2
			");

			$sql->execute(array(':rut'=>$rut,':anio'=>$anioHistoria,':mes'=>$mesHistoria));
			$n = 0;
			$filas = $sql->rowCount();

			if($filas != 0){
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

}

?>