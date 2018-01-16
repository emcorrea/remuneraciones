<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("location:../../vista/login/inicio.php");
}
include_once'../../modelo/conexion.php';
include_once'../../controlador/registrar/registrarDAO.php';
include_once'../../controlador/generales/generalesDAO.php';

$conexion 	= new DBconexion();
$registrar 	= new registrar($conexion);
$generales 	= new generales($conexion);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<!--Estilos css-->
	<link rel="stylesheet" href="registrar/estilos/estilos-registrar.css">
	<!--Javascript-->
	<script src="registrar/javascript/js-registrar.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<div class="contendor">
		<h3 class="titulo-registrar">Registro de remuneraciones</h3>
		<div class="formulario-registrar" id="formulario-registrar">
			<form action="#" method="POST" name="registrar" id="registrarremuneracion">
				<input type="hidden" name="rut_session" value="<?=$_SESSION['rut']?>">
				<label for="anio">Año<?= $generales->selectAnnio(); ?></label>
				<label for="mes">Mes<?= $generales->selectMes(); ?></label>
				<label for="ingreso">Ingreso<input type="text" name="ingreso" id="ingreso" class="input"/></label>
				<input type="button" id="guardarregistrar" value="Registrar" class="btn-registrar"/>
			</form>
			<div id="respuesta"></div>
		</div>
		<div class="contenidotabla">
			<?=$registrar->costosFijos($_SESSION['rut'])?>
			<?=$registrar->costosVariables($_SESSION['rut'])?>
		</div>
	</div>
</body>
</html>