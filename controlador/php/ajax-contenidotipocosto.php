<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("location:../../vista/login/inicio.php");
}
include_once __DIR__.'/../../modelo/conexion.php';

$conexion       = new DBconexion();

if(isset($_POST['funcion_tipo_costo'])){
        
        switch($_POST['funcion_tipo_costo']){
	        case 'tipo_costo':
	            $sql = $conexion->prepare("SELECT * FROM DETALLE_TIPO_COSTO WHERE codigo_tipo_costo = ? AND rut_persona = ?");
	            $sql->execute(array($_POST['codigo_tipo_costo'], $_SESSION['rut']));
	            echo json_encode($sql->fetchAll(PDO::FETCH_OBJ));

	        break;
		}
}

?>