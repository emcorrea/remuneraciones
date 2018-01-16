<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("location:../../vista/login/inicio.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="mantenedor/estilos/estilos-mantenedor.css">
	<script src="mantenedor/javascript/formato_rut.js" type="text/javascript" charset="utf-8"></script>
	<script src="mantenedor/javascript/js-mantenedor.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<div class="botones-mantenedor">
		<input type="button" id="mantenedor-usuario" value="Usuarios" class="btn-mantenedor">
		<input type="button" id="mantenedor-tipo-costo" value="Detalle tipo costo" class="btn-mantenedor">
	</div>
	<div id="contenido-mantendor"></div>
</body>
</html>