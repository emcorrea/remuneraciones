<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'/interfaz-usuario-DAO.php';

class mantenedor implements interfazUsuarioDAO{
	private $conexion;
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }  

	function grabaPersonaMantenedor($rut,$nombre,$apPersona,$amPersona){
		try {
			$conexion = new DBconexion();

			$sql="INSERT INTO PERSONA VALUES (:rut, :nombre, :apellido_p, :apellido_m)";
			$resultado = $conexion->prepare($sql);
			$resultado->execute(array(':rut'=>$rut,':nombre'=>$nombre,':apellido_p'=>$apPersona,':apellido_m'=>$amPersona));	
		} catch (Exception $e) {
			echo"No se pudo instanciar a la funcion grabaPersonaMantenedor: ".$e;
		}
	
	}

	function grabaUsuarioMantenedor($rutUser,$nombre,$key,$fecha){
		try {
			$conexion = new DBconexion();

			$sql="INSERT INTO USUARIO (rut_usuario,nombre_usuario,contrasenia,fecha_registro) VALUES (:rutuser, :user, :key, :date)";
			$resultado = $conexion->prepare($sql);
			$resultado->execute(array(':rutuser'=>$rutUser,':user'=>$nombre,':key'=>$key,':date'=>$fecha));
		} catch (Exception $e) {
			echo"No se pudo instanciar a la funcion grabaUsuarioMantenedor: ".$e;
		}
		
	}

}

?>