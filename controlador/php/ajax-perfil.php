<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/../mantenedor/perfilMantenedorDAO.php';

$conexion       = new DBconexion();
$perfil 		= new Perfil($conexion);

if(isset($_POST['contrasenia']) && isset($_POST['contraseniados']) && isset($_POST['rut_session'])){
	//VARIABLES
	$rut 			= $_POST['rut_session']; 
	$key 			= $_POST['contrasenia'];
	$contrasenia 	= password_hash($key,PASSWORD_DEFAULT);

	$perfil->actualizaContrasenia($rut,$contrasenia);

}else{
	echo"No se pudo ejecutar la grabación";
}

?>