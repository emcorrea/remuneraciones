<?php

	interface interfazRegistrarDAO{
		function costosFijos($rut);
		function costosVariables($rut);
		function grabaRemuneracion($rut,$annio,$mess,$remuneracion);
		function grabaRemuneracionDetalle($rut);
	}

?>