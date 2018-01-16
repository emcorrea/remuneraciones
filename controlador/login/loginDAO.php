<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/interfaz-login-DAO.php';

class login implements interfazloginDAO{
	private $conexion;
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }  

	function validaUsuario($usuario,$contrasenia){
		try {
			$conexion = new DBconexion();

			$sql1=" 
			SELECT 
				* 
			FROM
				USUARIO us JOIN PERSONA per
				ON(us.rut_usuario = per.rut_persona)
			WHERE
				us.nombre_usuario = ?";

			$resultado1 = $conexion->prepare($sql1);
			$resultado1->execute(array($usuario));

			if($resultado1->rowCount()>0){
				$fila1 = $resultado1->fetch();
				$contraseniaCifrada = $fila1['contrasenia'];

				if(password_verify($contrasenia,$contraseniaCifrada)){
					$nombre 	= $fila1['nombre'];
					$apellidoP 	= $fila1['apellido_p'];
					$apellidoM 	= $fila1['apellido_m'];
					$rutUsuario = $fila1['rut_persona'];

					session_start();
					$_SESSION["usuario"] = $nombre.' '.$apellidoP.' '.$apellidoM;
					$_SESSION["rut"] = $rutUsuario;
					header("location:../../vista/principal.php");
				}else{
					header("location:../../vista/login/inicio.php");
				}		
			}
			


		} catch (Exception $e) {
			echo"No se pudo instanciar a la funcion grabaPersonaMantenedor: ".$e;
		}
	
	}

}

?>