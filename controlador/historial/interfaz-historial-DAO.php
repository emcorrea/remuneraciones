<?php

	interface interfazHistorialDAO{
		function resumenRemuneracion($rut,$anioHistoria,$mesHistoria);
		function historialRegistroRemuneracion($rut,$anioHistoria,$mesHistoria);
	}

?>