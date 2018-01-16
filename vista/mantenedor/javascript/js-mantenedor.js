$(document).ready(function(){
	//Redirecciona al mantenedor de usuarios
    $("#mantenedor-usuario").click(function() {
        var url="mantenedor/mantenedor-usuario.php";
        $("#contenido-mantendor").load(url);
        return false;
    });

    //Redirecciona al mantenedor de detalle tipo costo
    $("#mantenedor-tipo-costo").click(function() {
        var url="mantenedor/mantenedor-tipocosto.php";
        $("#contenido-mantendor").load(url);
        return false;
    });

    //Formato para el RUT
    $("#rut-usuario").rut({
        formatOn: 'keyup',
        minimumLength: 8,
        validateOn: 'change'
    });

    //Mantenedor de usuarios Administrador
    $("#graba-mantenedor-usuario").click(function(){
        if($("#rut-usuario").val()===""){
            alert("Debe ingresar el RUT del usuario");
            $("#rut-usuario").focus();
        }else if($("#nombre-usuario").val()===""){
            alert("Debe ingresar el nombre del usuario");
            $("#nombre-usuario").focus();
        }else if($("#ap-usuario").val()===""){
            alert("Debe ingresar el apellido paterno del usuario");
            $("#ap-usuario").focus();
        }else if($("#am-usuario").val()===""){
            alert("Debe ingresar el apellido materno del usuario");
            $("#am-usuario").focus();
        }else if($("#nombre-user").val()===""){
            alert("Debe ingresar el nombre de usuario");
            $("#nombre-user").focus();
        }else if($("#contrasenia-usuario").val()===""){
            alert("Debe ingresar la contraseña del usuario");
            $("#contrasenia-usuario").focus();
        }else{
            $.ajax({
                method:'POST',
                url:'../../sistema_remuneraciones/controlador/php/ajax-mantenedor-usuario.php',
                data:$("#mantenedorusuario").serialize(),
                success:function(data){
                    alert("Usuarios registrado correctamente");
                    $("#mantenedorusuario")[0].reset();
                    $("#respuesta").html(data);
                }
            });
        }
    });

    //Mantenedor de usuarios para cambiar contraseña
    $("#actualizacontrasenia").click(function(){
        if($("#contrasenia").val()===""){
            alert("Debe ingresar la nueva contraseña");
            $("#contrasenia").focus();
        }else if($("#contraseniados").val()===""){
            alert("Debe ingresar la contraseña");
            $("#contraseniados").focus();
        }else if($("#contrasenia").val() != $("#contraseniados").val()){
                alert("Las contraseñas ingresadas deben ser iguales");
                $("#mantenedorusuarioactualiza")[0].reset();
                $("#contrasenia").focus();
        }else{
            alert("Ingrese nuevamente al sistema con su nueva contraseña");
        }
    });

    //Mantenedor de tipo costo
    $("#graba-mantenedor-tipocosto").click(function(){
        if($("#tipocosto").val()==="Seleccione"){
            alert("Debe seleccionar el tipo de costo");
            $("#tipocosto").focus();
        }else if($("#detalletipocosto").val()===""){
            alert("Ingrese el detalle del tipo costooo");
            $("#detalletipocosto").focus();
        }else if($("#valor").val()===""){
            alert("Debe ingresar el valor");
            $("#valor").focus();
        }else{
            $.ajax({
                method:'POST',
                url:'../../sistema_remuneraciones/controlador/php/ajax-mantenedor-costo.php',
                data:$("#mantenedortipocosto").serialize(),
                success:function(data){
                    alert("Tipo costo agregado correctamente");
                    $("#mantenedortipocosto")[0].reset();
                    $("#respuesta").html(data);
                }
            });
        }
    });

    $("#valor").keyup(function(){ 
        this.value = this.value.replace(/[^0-9]/g,'');
    });

});

/*Funcion que muestra el contenido que poseen los distintos 
tipos de costo, según lo que se seleccione en el select*/

function mostar_tabla(codigo_tipo_costo){
    $.ajax({
        method: 'POST', 
        url: '../../sistema_remuneraciones/controlador/php/ajax-contenidotipocosto.php', 
        data: {funcion_tipo_costo: 'tipo_costo', codigo_tipo_costo: codigo_tipo_costo},
        success: function(respuesta){
            var n = 1,
                datos = JSON.parse(respuesta),
                tabla = $('#tabla_contenido'),
                html = '<form action="#" method="POST" id="costoActivo">'
                    +'<table class="tabla-costos">'
                    +'<tr>'
                        +'<th class="thn">N°</th>'
                        +'<th class="th">Nombre</th>'
                        +'<th class="th">Valor</th>'
                        +'<th class="th">Activos</th>'
                    +'</tr>';

            for(var i in datos){
                html += '<tr class="trtd">'
                        +'<td class="td">'+ n++ +'</td>'
                        +'<td class="td">'+ datos[i].nombre_detalle +'</td>'
                        +'<td class="td">$'+ datos[i].valor +'</td>';
                if(datos[i].activo == 1){
                    html += '<td class="td"><input type="checkbox" name="codigodetalle" id="activo" value='+datos[i].codigo_detalle+' checked onclick="activoCheck()"></td>';    
                }else{
                    html += '<td class="td"><input type="checkbox" name="codigodetalle" id="activo" value='+datos[i].codigo_detalle+' onclick="activoCheck()"></td>';
                }
                        
            }

            html += '</tr>'
                +'</table>'
                +'</form>';

            tabla.html(html);
            $("#respuesta").html(data);
        }
    });
}

function activoCheck(){
    $.ajax({
        method:'POST',
        url:'../../sistema_remuneraciones/controlador/php/ajax-mantenedor-costo.php',
        data:$("#costoActivo").serialize(),
        success:function(data){
            alert("Tipo costo actualizado");
        }
    });
}

