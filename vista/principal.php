<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("location:../../sistema_remuneraciones/vista/login/inicio.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sistema de remuneraciones</title>
	<!--Estilos css-->
	<link rel="stylesheet" href="archivos/generales.css">
	<link rel="stylesheet" href="archivos/icomoon/fonts.css">
	<!--Javascript-->
	<script src="archivos/jquery-3.2.1.js" type="text/javascript" charset="utf-8"></script>
	<script src="archivos/generales.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<div class="contenedor">
		<header>
			<div class="h2"><span class="icon-users" id="icono-user"></span> Bienvenido: <?php echo $_SESSION["usuario"]; ?></div>
		</header>
		<div class="menu-principal">
				<ul>
					<li id="registrar">Registrar</li>
					<li id="historial">Historial</li>
					<li id="mantenedor">Mantenedor</li>
					<li id="salir" class="salir">Salir</li>
				</ul>
			</div>
		<section>
			<div id="contenido"></div>	
		</section>
	</div>
</body>
</html>