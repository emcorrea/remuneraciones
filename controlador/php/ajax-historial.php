<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/../historial/historialDAO.php';

$conexion       = new DBconexion();
$historial 		= new historial($conexion);

if(isset($_POST['anio']) && isset($_POST['mes']) && isset($_POST['rut_session'])){
	//VARIABLES
	$anioHistoria 	= $_POST['anio'];
	$mesHistoria 	= $_POST['mes'];
	$rut 			= $_POST['rut_session'];

	$historial->resumenRemuneracion($rut,$anioHistoria,$mesHistoria);
	$historial->historialRegistroRemuneracion($rut,$anioHistoria,$mesHistoria);

}else{
	echo"No se pudo realizar la busqueda";
}

?>