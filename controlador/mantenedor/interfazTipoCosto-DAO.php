<?php

	interface interfazTipoCostoDAO{
		function selectTipoCosto();
		function grabaTipoCosto($rut,$tipoCosto,$detalle,$valor);
		function activoTipoCosto($codigodetalle);
	}

?>