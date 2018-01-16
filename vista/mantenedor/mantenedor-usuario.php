<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("location:../../vista/login/inicio.php");
}
include_once'../../modelo/conexion.php';
include_once'../../controlador/mantenedor/perfilMantenedorDAO.php';

$conexion 	= new DBconexion();
$perfil 	= new Perfil($conexion);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<!--Javascript-->
	<script src="mantenedor/javascript/js-mantenedor.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<div class="contendor">
		<h3 class="titulo-mant-usuarios">Mantenedor de Usuarios</h3>
		<div class="formulario-mant-usuario" id="formulario-mant-usuario">
			<?= $perfil->perfilMantenedorUsuario($_SESSION["rut"]) ?>
			<div id="respuesta"></div>
		</div>
	</div>
</body>
</html>