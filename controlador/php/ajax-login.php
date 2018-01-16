<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/../login/loginDAO.php';

$conexion       = new DBconexion();
$login 			= new login($conexion);

if(isset($_POST['usuario']) && isset($_POST['contrasenia'])){
	//VARIABLES
	$user 	= $_POST['usuario'];
	$key 	= $_POST['contrasenia'];

	$login->validaUsuario($user,$key);

}else{
	echo"No se pudo instanciar a las variables de session";
}

?>