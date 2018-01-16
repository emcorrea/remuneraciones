$(document).ready(function(){

	$("#guardarregistrar").click(function(){

		if($("#anio").val()==="Seleccione"){
			alert("Debe seleccionar el año");
			$("#anio").focus();
		}else if($("#mes").val()===""){
			alert("Debe seleccionar el mes");
			$("#mes").focus();
		}else if($("#ingreso").val()===""){
			alert("Debe ingresar el ingreso");
			$("#ingreso").focus();
		}else{
			$.ajax({
                method:'POST',
                url:'../../remuneraciones/controlador/php/ajax-registrar.php',
                data:$("#registrarremuneracion").serialize(),
                success:function(data){
                    alert("Reumneración registrada");
                    $("#registrarremuneracion")[0].reset();
                    $("#respuesta").html(data);
                }
            });
		}
	});

	$("#ingreso").keyup(function(){ 
   		this.value = this.value.replace(/[^0-9]/g,'');
	});
	
});