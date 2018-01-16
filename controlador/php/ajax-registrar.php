<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/../registrar/registrarDAO.php';

$conexion       = new DBconexion();
$registro  		= new registrar($conexion);

if(isset($_POST['anio']) && isset($_POST['mes']) && isset($_POST['ingreso']) && isset($_POST['rut_session'])){
	//VARIABLES
	$annio 			= $_POST['anio'];
	$mess 			= $_POST['mes'];
	$remuneracion 	= $_POST['ingreso'];
	$rut 			= $_POST['rut_session'];

	$registro->grabaRemuneracion($rut,$annio,$mess,$remuneracion);
	$registro->grabaRemuneracionDetalle($rut);

}else{
	echo"No se pudo ejecutar la grabación";
}

?>