<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("location:../../vista/login/inicio.php");
}
include_once'../../modelo/conexion.php';
include_once'../../controlador/generales/generalesDAO.php';

$conexion 	= new DBconexion();
$generales 	= new generales($conexion);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<!--Estilos css-->
	<link rel="stylesheet" href="historial/estilos/estilos-historial.css">
	<!--Javascript-->
	<script src="historial/javascript/js-historial.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<div class="contendor">
		<h3 class="titulo-historial">Historial de remuneraciones</h3>
		<div class="formulario-historial" id="formulario-historial">
			<form action="#" method="POST" name="historia" id="formulariohistorial">
				<input type="hidden" name="rut_session" value="<?=$_SESSION['rut']?>">
				<label for="anio">Año<?= $generales->selectAnnio(); ?></label>
				<label for="mes">Mes<?= $generales->selectMes(); ?></label>
				<input type="button" id="buscar" value="Buscar" class="btn-historial"/>
			</form>
			<div id="respuesta"></div>
		</div>
		<div class="contenidotabla" id="contenidotabla"></div>
	</div>
</body>
</html>