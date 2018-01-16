<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/interfazTipoCosto-DAO.php';

class mantenedorTipoCosto implements interfazTipoCostoDAO{
	private $conexion;
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }  

	function selectTipoCosto(){
		try {
			$conexion = new DBconexion();
			$resultado = $conexion->query('SELECT * FROM TIPO_COSTO WHERE activo = 1');
			?>
			<select name="tipocosto" id="tipocosto" class="input" onchange="mostar_tabla(this.value)">
				<option value="0">Seleccione</option>
			<?php
			while($fila = $resultado->fetch()){
				?>
				<option value='<?=$fila['codigo_tipo_costo']?>'><?=$fila['nombre_tipo_costo']?></option>
				<?php
			}
			?>
			</select>
			<?php	
		} catch (Exception $e) {
			echo"No se pudo instanciar a la funcion selectTipoCosto: ".$e;
		}
	
	}

	function grabaTipoCosto($rut,$tipoCosto,$detalle,$valor){
		try {
			$conexion = new DBconexion();

			$sql="INSERT INTO DETALLE_TIPO_COSTO (rut_persona,codigo_tipo_costo,nombre_detalle,valor) VALUES (:rut, :tipo_costo, :detalle, :valor)";
			$resultado = $conexion->prepare($sql);
			$resultado->execute(array(':rut'=>$rut,':tipo_costo'=>$tipoCosto,':detalle'=>$detalle, ':valor'=>$valor));	
		} catch (Exception $e) {
			echo"No se pudo instanciar a la funcion grabaTipoCosto: ".$e;
		}
	}

	function activoTipoCosto($codigoDetalle){
		try {
			$conexion = new DBconexion();
			
			$sql="SELECT * FROM DETALLE_TIPO_COSTO WHERE codigo_detalle = :tipoCosto";
			$resultado = $conexion->prepare($sql);
			$resultado->execute(array(':tipoCosto'=>$codigoDetalle));
			while ($fila = $resultado->fetch()){
				$activo = $fila['activo'];
				if($activo == 1){
					$sql="UPDATE DETALLE_TIPO_COSTO SET activo = 0 WHERE codigo_detalle = ':codigo_detalle'";
					$resultado = $conexion->prepare($sql);
					$resultado->execute(array(':codigo_detalle'=>$codigoDetalle));
				}else{
					$sql="UPDATE DETALLE_TIPO_COSTO SET activo = 1 WHERE codigo_detalle = ':codigo_detalle'";
					$resultado = $conexion->prepare($sql);
					$resultado->execute(array(':codigo_detalle'=>$codigoDetalle));
				}
			}
		} catch (Exception $e) {
			echo"No se pudo instanciar a la funcion grabaTipoCosto: ".$e;
		}
	}


}

?>