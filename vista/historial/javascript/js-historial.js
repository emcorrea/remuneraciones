$(document).ready(function(){
	$("#buscar").click(function(){
		if($("#anio").val()==="Seleccione"){
			alert("Debe seleccionar el año");
			$("#anio").focus();
		}else if($("#mes").val()==="Seleccione"){
			alert("Debe seleccionar el mes");
			$("#mes").focus();
		}else{
			$.ajax({
				 method:'POST',
                url:'../../sistema_remuneraciones/controlador/php/ajax-historial.php',
                data:$("#formulariohistorial").serialize(),
                success:function(data){
                    $("#formulariohistorial")[0].reset();
                    $("#contenidotabla").html(data);
                }
			});
		}
	});
});