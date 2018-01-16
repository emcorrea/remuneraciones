<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="estilos/estilos-inicio.css">
	<script src="../archivos/jquery-3.2.1.js" type="text/javascript" charset="utf-8"></script>
	<script src="javascript/js-inicio.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<form action="../../controlador/php/ajax-login.php" method="POST" id="formulariologin" class="formulariologin">
        <h2>Bienvenidos.<small> Ingrese sus credenciales</small></h2>
        <div class="contenido-input">
        <input type="text" name="usuario" id="user" placeholder="Usuario" class="input-text">
        <input type="password" name="contrasenia" id="contrasenia" placeholder="Contraseña" class="input-text">
        </div>
        <input type="submit" value="Ingresar" id="btn-ingresar" class="ingresar">
    </form>
</body>
</html>