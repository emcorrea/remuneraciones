$(document).ready(function(){
	//Redirecciona al mantenedor
    $("#mantenedor").click(function() {
        var url="mantenedor/index-mantenedor.php";
        $("#contenido").load(url);
        return false;
    });

	//Redirecciona al Historial
    $("#historial").click(function() {
        var url="historial/index-historial.php";
        $("#contenido").load(url);
        return false;
    });

	//Redirecciona al Registro
    $("#registrar").click(function() {
        var url="registrar/index-registrar.php";
        $("#contenido").load(url);
        return false;
    });

    //Redirecciona para salir
    $("#salir").click(function() {
        location.href="../../sistema_remuneraciones/controlador/login/salir.php";
    });
    
});