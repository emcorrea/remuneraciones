<?php

	interface interfazPerfilDao{
		function perfilMantenedorUsuario($rut);
		function actualizaContrasenia($rut,$contrasenia);
	}

?>