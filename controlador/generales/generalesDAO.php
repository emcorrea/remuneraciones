<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/interfaz-generales-DAO.php';

class generales implements interfazGeneralesDAO{
	private $conexion;
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }  

	function selectAnnio(){
		try {
			$conexion = new DBconexion();
			$anio = date('Y');
			?>
			<select name="anio" id="anio" class="input">
				<option value="0">Seleccione</option>
				<option value='<?= $anio-1 ?>'><?php echo$anio-1 ?></option>
				<option value='<?= $anio ?>'><?php echo$anio ?></option>
				<option value='<?= $anio+1 ?>'><?php echo$anio+1 ?></option>
			</select>
			<?php
			
							
		}catch (Exception $e) {
			echo"No se pudo instanciar a la funcion selectAnnio: ".$e;
		}
	
	}

	function selectMes(){
		try {
			$conexion = new DBconexion();

			?><select name="mes" id="mes" class="input">
			<option value="0">Seleccione</option><?php
			$sql=$conexion->prepare("SELECT * FROM MES ORDER BY codigo_mes ASC");
			$sql->execute();
			foreach($sql->fetchAll(PDO::FETCH_OBJ) as $fila) {
				?><option value='<?= $fila->codigo_mes ?>'><?=$fila->descripcion?></option><?php
			}
			?></select><?php
				
		}catch (Exception $e) {
			echo"No se pudo instanciar a la funcion selectAnnio: ".$e;
		}
	}

}

?>