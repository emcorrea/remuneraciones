<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/../mantenedor/tipoCostoDAO.php';

$conexion       = new DBconexion();
$objtipoCosto 	= new mantenedorTipoCosto($conexion);

if(isset($_POST['tipocosto']) && isset($_POST['detalletipocosto']) && isset($_POST['rut_session'])){
	//VARIABLES
	$tipoCosto 		= $_POST['tipocosto'];
	$detalle 		= $_POST['detalletipocosto'];
	$valor 			= $_POST['valor'];
	$rut 			= $_POST['rut_session'];

	$objtipoCosto->grabaTipoCosto($rut,$tipoCosto,$detalle,$valor);


}else if(isset($_POST['funcion_codigo_detalle'])){
	//VARIABLES

	switch($_POST['funcion_codigo_detalle']){
	        case 'detalle':
	        	$codigodetalle 		= $_POST['codigo_detalle'];
	           	$objtipoCosto->activoTipoCosto($codigodetalle);
	        break;
		}
}else{
	echo"No se pudo ejecutar la acción";
}


?>