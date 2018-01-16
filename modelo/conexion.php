<?php

	class DBconexion extends PDO
	{
		private static $URL="mysql:host=localhost;dbname=remuneraciones;charset=utf8";
		private static $USUARIO="ecorrea";
		private static $PASS="ecorrea";
		
		function __construct()
		{
			parent::__construct(self::$URL, self::$USUARIO, self::$PASS);
		}
	}

?>