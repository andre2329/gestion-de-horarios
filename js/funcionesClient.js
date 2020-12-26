


function disponibilidadDocente(){
    borradoInicial();
        var url = '../vistas/horario.php';
        $.ajax({
            url: url,
            type: "post",
            beforeSend: function() {
                $("#main1").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>');
            },
            success: function(response) {
                
                $("#main1").html(response);
            }
        });
    
    
}
function borradoInicial() {
    $('.header-principal').fadeOut("slow");
    $('.imagen-principal').fadeOut("slow");
    $("#main1").html('');
    $("#main1").css("margin-top", "4vh");
    $("#main2").html('');
    $("#main3").html('');


}
function grabarDisponibilidad() {
    var url = '../funciones/funcionales/insertar_horario.php';
    $.ajax({

        url: url,
        data: $("#grabaHorario").serialize(),
        type: "post",
        beforeSend: function() {
            $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            console.log(response);
            disponibilidadDocente($('#iddocente').val());
        }
    });


}
function cerrarSesion() 
{
                    auth
                    .signOut()
                    .then(
                        window.location.replace("../utils/cerrar_sesion.php")
                    )
                    .catch(
                        function(error) {
                            alert(error)
                          }
                        
                    )
}

function verHorarioPropuestoDocente() {
    
    borradoInicial()
    url = '../vistas/horario_propuesto.php';
    $.ajax({
        url: url,
        data: {  'ciclo': '2020-2' },
        type: "post",
        beforeSend: function() {
            $("#main1").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            $("#main1").html(response);
        }
    });
}

function cambiarP() {
    borradoInicial()
    var url = "../vistas/formulario_clave.php";
    $.ajax({
        url: url,
        type: 'get',
        beforeSend: function() {
            $("#main1").html("Procesando, espere por favor...");
        },
        success: function(response) {
            console.log(response);
            $("#main1").html(response);
        }
    });
}


function verificarPass() {

    actual = $('#actual').val();
    nueva1 = $('#nueva1').val();
    nueva2 = $('#nueva2').val();

    console.log(actual);
    console.log(nueva1);
    console.log(nueva2);
    if (actual == "") {
        $('#actual').addClass("is-invalid");
    } else {
        $('#actual').removeClass("is-invalid");
        $('#actual').addClass("is-valid");
    }
    if (nueva1 != nueva2 || nueva1 == "" || nueva1 == "") {

        $('#nueva1').addClass("is-invalid");
        $('#nueva2').addClass("is-invalid");
        $('#informacion').removeClass("text-muted");
        $('#informacion').addClass("text-danger");
        $('#informacion').text("Las contrase\u00f1as no coinciden");
        return false;
    } else {

        $('#nueva1').removeClass("is-invalid");
        $('#nueva2').removeClass("is-invalid");
        $('#nueva1').addClass("is-valid");
        $('#nueva2').addClass("is-valid");
        $('#informacion').removeClass("text-danger");
        $('#informacion').addClass("text-success");
        $('#informacion').text("Las contrase\u00f1as coinciden");
        return true;
    }


}
function confirmarCambio(){
    
    auth.sendPasswordResetEmail($('#correo').val())
    .then(function () {

        alert("Se ha enviado un correo de recuperación. Revise su bandeja de entrada o su carpeta de spam.")
        cambiarP()
    }
        )
    .catch(function (error) {
        alert("Verifique el correo electronico")
    }
        )
}