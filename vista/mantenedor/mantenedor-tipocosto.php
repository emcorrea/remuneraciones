<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("location:../../vista/login/inicio.php");
}
include_once'../../modelo/conexion.php';
include_once'../../controlador/mantenedor/tipoCostoDAO.php';

$conexion 	= new DBconexion();
$costo 		= new mantenedorTipoCosto($conexion);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<!--Estilos css-->
	<link rel="stylesheet" href="mantenedor/estilos/estilos-mantenedor.css">
	<!--Javascript-->
	<script src="mantenedor/javascript/js-mantenedor.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<div class="contendor">
		<h3 class="titulo-mant-usuarios">Mantenedor detalle tipo costo</h3>
		<div class="formulario-mant-costo" id="formulario-mant-usuario">
			<form action="#" method="POST" name="mantenedor-tipocosto" id="mantenedortipocosto">
				<input type="hidden" name="rut_session" value="<?=$_SESSION['rut']?>">
				<label for="tipocosto" class="label">Seleccione costo<?= $costo->selectTipoCosto(); ?></label>
				<label for="detalletipocosto" class="label"><input type="text" name="detalletipocosto" id="detalletipocosto" placeholder="Escriba el detalle" class="input"></label>
				<label for="valor" class="label"><input type="text" name="valor" id="valor" placeholder="Escriba el valor" class="input"></label>
				<input type="button" id="graba-mantenedor-tipocosto" value="Guardar" class="btn-registrar"/>
				<div id="tabla_contenido"></div>
			</form>
			<div id="respuesta"></div>
		</div>
	</div>
</body>
</html>