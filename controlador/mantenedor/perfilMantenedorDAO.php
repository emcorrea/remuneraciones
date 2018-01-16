<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/interfaz-perfilMantenedor-DAO.php';

class Perfil implements interfazPerfilDao{
	private $conexion;
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }  

	function perfilMantenedorUsuario($rut){
		try {
			$conexion = new DBconexion();

			$sql = $conexion->prepare("SELECT * FROM USUARIO WHERE rut_usuario = ?");
			$sql->execute(array($rut));

			foreach($sql->fetchAll(PDO::FETCH_OBJ) as $fila) {
				$administrador	= $fila->administrador;

				if($administrador == 1){
					?>
					<form action="#" method="POST" name="mantenedor-usuario" id="mantenedorusuario" class="formulario-user">
						<label for="rutusuarios"><div class="posicion-input">RUT<input type="text" name="rutusuarios" id="rut-usuario" class="input"/></div></label>
						<label for="nombreusuarios"><div class="posicion-input">Nombre<input type="text" name="nombreusuarios" id="nombre-usuario" class="input"/></div></label>
						<label for="apusuarios"><div class="posicion-input">Apellido Paterno<input type="text" name="apusuarios" id="ap-usuario" class="input"/></div></label>
						<label for="amusuarios"><div class="posicion-input">Apellido Materno<input type="text" name="amusuarios" id="am-usuario" class="input"/></div></label>
						<label for="nombreusuarios"><div class="posicion-input">Nombre usuario<input type="text" name="nombreuser" id="nombre-user" class="input"/></div></label>
						<label for="contraseniausuarios"><div class="posicion-input">Contraseña<input type="text" name="contraseniausuarios" id="contrasenia-usuario" class="input"/></div></label>
						<input type="button" id="graba-mantenedor-usuario" value="Guardar" class="btn-guardar"/>
					</form>
					<?php
				}else{
					?>
					<form action="../controlador/php/ajax-perfil.php" method="POST" name="mantenedor-usuario-actualiza" id="mantenedorusuarioactualiza" class="formulario-user">
						<input type="hidden" name="rut_session" value="<?=$_SESSION['rut']?>">
						<label for="contrasenia"><div class="posicion-input">Ingrese nueva contraseña<input type="password" name="contrasenia" id="contrasenia" class="input"/></div></label>
						<label for="contraseniados"><div class="posicion-input">Vuelva ingresar la contraseña<input type="password" name="contraseniados" id="contraseniados" class="input"/></div></label>
						<input type="submit" id="actualizacontrasenia" value="Actualizar" class="btn-guardar"/>
					</form>
					<?php
				} 
			}	
		} catch (Exception $e) {
			echo"No se pudo instanciar a la funcion botonesMantendor: ".$e;
		}
	
	}

	function actualizaContrasenia($rut,$contrasenia){
		try {
			$conexion = new DBconexion();
			$sql = $conexion->prepare("UPDATE USUARIO set contrasenia = ? WHERE rut_usuario = ?");
			$sql -> execute(array($contrasenia,$rut));
    		header("location:../login/salir.php");
		} catch (Exception $e) {
			echo"No se pudo instanciar a la funcion botonesMantendor: ".$e;
		}
	}

}

?>