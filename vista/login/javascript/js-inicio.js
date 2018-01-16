$(document).ready(function(){
	$("#btn-ingresar").click(function(){
		if($("#user").val()===""){
			alert("Debe ingresar el usuario");
			$("#user").focus();
		}else if($("#contrasenia").val()===""){
			alert("Debe ingresar la constraseña");
			$("#contrasenia").focus();
		}
	});
	
});