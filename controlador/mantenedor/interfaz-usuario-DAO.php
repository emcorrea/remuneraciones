<?php

	interface interfazUsuarioDAO{
		function grabaPersonaMantenedor($rut,$nombre,$apPersona,$amPersona);
		function grabaUsuarioMantenedor($rutUser,$nombre,$key,$fecha);
	}

?>