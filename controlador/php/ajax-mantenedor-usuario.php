<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/../mantenedor/usuarioDAO.php';

$conexion       = new DBconexion();
$mantenedor 	= new mantenedor($conexion);

if(isset($_POST['rutusuarios']) && isset($_POST['nombreusuarios']) && isset($_POST['apusuarios']) && isset($_POST['amusuarios']) && isset($_POST['nombreuser']) && isset($_POST['contraseniausuarios'])){
	//VARIABLES
	$rut_persona 	= $_POST['rutusuarios'];
	$rut_persona 	= str_replace(".","", $rut_persona);
	$rut_persona 	= str_replace("-","", $rut_persona);
	$nombre_persona = $_POST['nombreusuarios'];
	$apPaterno 		= $_POST['apusuarios'];
	$apMaterno 		= $_POST['amusuarios'];
	$user 			= $_POST['nombreuser'];
	$key 			= $_POST['contraseniausuarios'];
	$key_encript 	= password_hash($key,PASSWORD_DEFAULT);
	$fecha 			= date('Y-m-d');

	$mantenedor->grabaPersonaMantenedor($rut_persona,$nombre_persona,$apPaterno,$apMaterno);
	$mantenedor->grabaUsuarioMantenedor($rut_persona,$user,$key_encript,$fecha);


}else{
	echo"No se pudo ejecutar la grabación";
}

?>