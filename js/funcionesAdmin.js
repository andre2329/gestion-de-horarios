


function insertardocente() {
    borradoInicial();
    var url = "../vistas/formulario.php";
    $.ajax({
        url: url,
        type: 'get',
        beforeSend: function() {
            $("#main1").html('<div class="spinner-border mt-3" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span></div><br>' + "Procesando, espere por favor...");
        },
        success: function(response) {
            $("#main1").html(response);
        }
    });

}
function insertardisponibilidad() {

    borradoInicial();
    var url = "../vistas/complementarios/seleccion_docente.php";
    $.ajax({
        url: url,
        data: { ventana: 'insertarDisponibilidad' },
        type: 'post',
        beforeSend: function() {
            $("#main1").html('<div class="spinner-border mt-3" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span></div><br>' + "Procesando, espere por favor...");
        },
        success: function(response) {
            $("#main1").html(response);
        }
    });

}
function validarMail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function borradoInicial() {
    $('.header-principal').fadeOut("slow");
    $('.imagen-principal').fadeOut("slow");
    $("#main1").html('');
    $("#main1").css("margin-top", "4vh");
    $("#main2").html('');
    $("#main3").html('');


}

function grabarDocente() {
    var url = "../funciones/funcionales/insertar_docente.php";
    var url2 = "../funciones/funcionales/verificar_docente.php";
    var datos = $("#grabaDocente").serializeArray();
    var falta = false;
    var mensaje = "Existen datos faltantes :";
    email = datos[4]['value'];
    password = datos[5]['value'];
    console.log(datos);
    for (i = 0; i < datos.length; i++) {
        if (datos[i]['value'] == "") {
            mensaje += '\n' + '-' + datos[i]['name'].toUpperCase();
            falta = true;
        }
    }
    if (falta) {
        alert(mensaje);
    } else {
        mensaje = "Datos incorrectos:";
        if (isNaN(datos[0]['value'])) {
            mensaje += '\n' + '-' + 'El c\u00f3digo debe ser num\u00e9rico';
            falta = true;
        }
        if (!validarMail(datos[4]['value'])) {
            mensaje += '\n' + '-' + 'Ingrese un correo v\u00e1lido';
            falta = true;
        }

        if (isNaN(datos[10]['value'])) {
            mensaje += '\n' + '-' + 'El m\u00e1ximo de horas debe ser num\u00e9rico';
            falta = true;
        }
        if (isNaN(datos[11]['value'])) {
            mensaje += '\n' + '-' + 'El m\u00ednimo de horas debe ser num\u00e9rico';
            falta = true;
        }

        if (falta) {
            alert(mensaje);
        }

    }

    if (!falta) {
        //contenido-modal
        
        $.ajax({
            url: url2,
            data: datos,
            type: "post",
            beforeSend: function() {
                /*$("#main1").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>');*/
            },
            success: function(response) {
                //$("#main1").html(response);
                console.log(response);
                if(response=="existe"){
                    $( "#btn-modal" ).click()
                    alert("El correo o idDocente ya existen. Ingrese nuevamente.")
                }else{
                    $('.contenido-modal').html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>');
                    $('#salir-modal').hide();
                    $('#titulo-modal').text("Espere un momento por favor ... ");

                    auth
                    .createUserWithEmailAndPassword(email,password)
                    .then(
                        userCredential=>{
                            datos.push({'name':'id','value':userCredential.user.uid});
                            console.log(datos);
                            
                            $.ajax({
                                url: url,
                                data: datos,
                                type: "post",
                                beforeSend: function() {
                                    $("#main1").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                                        '<span class="sr-only">Loading...</span>' +
                                        '</div>');
                                },
                                success: function(response) {
                                    alert("Se ha registrado al docente de manera exitosa!");
                                    insertardocente();
                                    console.log(response);
                                }});
                            

                        }
                    )
                    .catch(
                        function(error) {
                            console.log(error)
                            if(error.code=="auth/weak-password"){
                                
                                alert("La contraseña debe tener al menos 6 caracteres")
                                
                                 
                            }else{
                                alert("El correo ya existe. Ingrese nuevamente.")
                            }
                            $('.contenido-modal').html('<label class="btn btn-dark text-light" onclick="grabarDocente()">Aceptar</label>'+
                                '<label class="btn btn-light text-light bg-secondary" for="btn-modal">Cancelar</label>');
                                $( "#btn-modal" ).click()
                        }
                    )
                }
            }
        });


    }else{
        $( "#btn-modal" ).click();
    }
    $('#titulo-modal').text("&iquest;Est&aacute; seguro que quiere grabar al docente&#63;");



};
function disponibilidadDocente(sel) {
    console.log(sel)
    var url = '../vistas/horario.php';
    $.ajax({
        url: url,
        data: { data: sel},
        type: "post",
        beforeSend: function() {
            $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            
            $("#main2").html(response);
        }
    });

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

function editardocente() {
    borradoInicial();
    var url = "../vistas/complementarios/seleccion_docente.php";
    $.ajax({
        url: url,
        data: { ventana: 'editarDocente' },
        type: 'post',
        beforeSend: function() {
            $("#main1").html("Procesando, espere por favor...");
        },
        success: function(response) {
            $("#main1").html(response);
        }
    });
}





function editarDocente(sel) {
    var url = '../vistas/funcionales/formulario_actualizar.php';
    $.ajax({
        url: url,
        data: { 'editarDocente': sel },
        type: "post",
        beforeSend: function() {
            $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            $("#main2").html(response);
        }
    });

}

function actualizarDocente() {
    var url = "../funciones/funcionales/insertar_docente.php";
    var datos = $("#actualizaDocente").serializeArray();
    var falta = false;
    var mensaje = "Existen datos faltantes :";
    console.log(datos)
    email = datos[4]['value'];
    password = datos[5]['value'];
    console.log(datos);
    for (i = 0; i < datos.length; i++) {
        if (datos[i]['value'] == "") {
            mensaje += '\n' + '-' + datos[i]['name'].toUpperCase();
            falta = true;
        }
    }
    if (falta) {
        alert(mensaje);
    } else {
        mensaje = "Datos incorrectos:";
        if (isNaN(datos[0]['value'])) {
            mensaje += '\n' + '-' + 'El c\u00f3digo debe ser num\u00e9rico';
            falta = true;
        }
        

        if (isNaN(datos[8]['value'])) {
            mensaje += '\n' + '-' + 'El m\u00e1ximo de horas debe ser num\u00e9rico';
            falta = true;
        }
        if (isNaN(datos[9]['value'])) {
            mensaje += '\n' + '-' + 'El m\u00ednimo de horas debe ser num\u00e9rico';
            falta = true;
        }

        if (falta) {
            alert(mensaje);
        }

    }
    
    if (!falta) {
        //contenido-modal
        datos.push({'name':'actualizar','value':'true'});
        
        
        $('.contenido-modal').html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>');
        $('#salir-modal').hide();
        $('#titulo-modal').text("Espere un momento por favor ... ");
    
        $.ajax({
            url: url,
            data: datos,
            type: "post",
            beforeSend: function() {
                /*$("#main1").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>');*/
            },
            success: function(response) {
                //console.log(response)
                alert("Se ha actualizado los datos del docente manera exitosa!");
                editarDocente($('#iddocente').val());
            }});

    }else{
        $( "#btn-modal" ).click();
    }
    //$('#titulo-modal').text("&iquest;Est&aacute; seguro que quiere grabar al docente&#63;");






}


function verHorarioPropuestoDocente(sel) {
    
    var url = '../vistas/complementarios/boton_propuesto.php';
    if (sel == 'recarga') {
        seleccion = $('#iddocente').val();
    } else {
        seleccion = sel;
    }
    $.ajax({
        url: url,
        type: "get",
        beforeSend: function() {
            $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            $("#main2").html(response);
        }
    });
    url = '../vistas/horario_propuesto.php';
    $.ajax({
        url: url,
        data: { 'horario_completo': 'true', 'idDocente': seleccion, 'ciclo': '2020-2' },
        type: "post",
        beforeSend: function() {
            $("#main3").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            $("#main3").html(response);
        }
    });
}

function verhorariopropuesto() {
    borradoInicial();
    var url = "../vistas/complementarios/seleccion_docente.php";
    $.ajax({
        url: url,
        data: { ventana: 'verHorarioPropuesto' },
        type: 'post',
        beforeSend: function() {
            $("#main1").html("Procesando, espere por favor...");
        },
        success: function(response) {
            $("#main1").html(response);
        }
    });
}
function incluirCurso() {
    var url = "../vistas/complementarios/barra_propuesto.php";
    $.ajax({
        url: url,
        data: { 'selecciones': 'curso' },
        type: "post",
        beforeSend: function() {
            $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            $("#main2").html(response);
        }
    });

}
function selectCurso(sel) {
    var url = "../vistas/complementarios/barra_propuesto.php";
    $.ajax({
        url: url,
        data: { 'selecciones': 'tipo', 'codCurso': sel.value },
        type: "post",
        beforeSend: function() {
            $("#resultado4").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            $("#curso").attr('disabled', true);
            $("#resultado4").html("");
            respuesta = response;
            if (response == "") {
                $("#error").html(response);
            } else {
                $("#tipo").html(response);
            }
        }
    });
}

function selectTipo(sel) {

    var url = "../vistas/complementarios/barra_propuesto.php";
    $.ajax({
        url: url,
        data: { 'selecciones': 'sede', 'tipo': sel.value,'codCurso':$('#curso').val() },
        type: "post",
        beforeSend: function() {
            $("#resultado4").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            $("#selectTipo").attr('disabled', true);
            $("#resultado4").html("");
            if (response == "") {
                $("#error").html(response);
            } else {
                $("#sede").html(response);
            }
        }
    });

}

function selectHorario(sel) {

    var url = "../vistas/complementarios/barra_propuesto.php";

    var arreglo = sel.value.split('-')
    hora_inicio = arreglo[0];
    horario_fin = arreglo[1].split(" ")[0];
    dia = arreglo[1].split(" ")[1];
    grupo = arreglo[2];
    $.ajax({
        url: url,
        data: { 'selecciones': 'seccion','hora_inicio': hora_inicio, 'hora_fin': horario_fin,
         'dia': dia, 'grupo': grupo,'sede': $('#selectSede').val(), 'tipo': $('#selectTipo').val(),'codCurso':$('#curso').val() },
        type: "post",
        beforeSend: function() {
            $("#resultado4").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            $("#selectHorario").attr('disabled', true);
            $("#resultado4").html("");
            console.log(response);
            if (response == "") {
                $("#error").html(response);
            } else {
                $("#seccion").html(response);
            }
        }
    });

}

function selectSede(sel) {

    var url = "../vistas/complementarios/barra_propuesto.php";
    $.ajax({
        url: url,
        data: { 'selecciones': 'horario', 'sede': sel.value, 'tipo': $('#selectTipo').val(),'codCurso':$('#curso').val()  },
        type: "post",
        beforeSend: function() {
            $("#resultado4").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            $("#selectSede").attr('disabled', true);
            $("#resultado4").html("");
            console.log(response);
            if (response == "") {
                $("#error").html(response);
            } else {
                $("#horario").html(response);
            }
        }
    });

}


function selectSeccion(sel) {
    var arreglo = $('#selectHorario').val().split('-')
    hora_inicio = arreglo[0];
    horario_fin = arreglo[1].split(" ")[0];
    dia = arreglo[1].split(" ")[1];
    grupo = arreglo[2];

    var url = "../vistas/complementarios/barra_propuesto.php";
    $.ajax({
        url: url,
        data: { 'selecciones': 'aula', 'seccion': sel.value ,
        'hora_inicio': hora_inicio, 'hora_fin': horario_fin,
        'dia': dia, 'grupo': grupo,'sede': $('#selectSede').val(), 'tipo': $('#selectTipo').val(),'codCurso':$('#curso').val() },
        type: "post",
        beforeSend: function() {
            $("#resultado4").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            $("#selectSeccion").attr('disabled', true);
            $("#resultado4").html("");
            if (response == "") {
                $("#error").html(response);
            } else {
                $("#aula").html(response);
            }
        }
    });

}


function habilitarBtn() {
    $('#btnGuardarPrincipal').attr('disabled', false);
}

function registrarPropuesta() {
    var url = '../funciones/funcionales/update_propuestos.php';
    aula = $("#selectAula").val();
    docente = $("#iddocente").val();
    $.ajax({
        url: url,
        data: { 'insertar': 'true', 'seccion': $('#selectSeccion').val(), 'idAula': aula, 'iddocente': docente, 'hora_inicio': hora_inicio, 'hora_fin': horario_fin,
        'dia': dia, 'grupo': grupo,'sede': $('#selectSede').val(), 'tipo': $('#selectTipo').val(),'codCurso':$('#curso').val() },
        type: "post",
        beforeSend: function() {
            $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            console.log(response);
            verHorarioPropuestoDocente('recarga');
            $("#main3").html(response);
        }
    });
}
function asignarEliminar(codigo, seccion, dia, hora_inicio, hora_fin, sede, aula, grupo, sesion) {
    $('#btn-aceptar').attr('onclick', 'eliminarCurso("'+codigo+'", "'+seccion+'","'+ dia+'","'+hora_inicio+'","'+ hora_fin+'","'+ sede+'","'+ aula+'","'+ grupo+'","'+sesion+'")');
    $('#btn-modal').click();
}
function eliminarCurso(codigo, seccion, dia, hora_inicio, hora_fin, sede, aula, grupo, sesion) {
    var url = '../funciones/funcionales/update_propuestos.php';
    docente = $("#iddocente").val();

    $.ajax({
        url: url,
        data: {
            'eliminar': 'true',
            'codCurso': codigo,
            'seccion': seccion,
            'dia': dia,
            'hora_inicio': hora_inicio ,
            'hora_fin': hora_fin,
            'sede': sede,
            'aula': aula,
            'grupo': grupo,
            'tipo': sesion,
            'iddocente': docente
        },
        type: "post",
        beforeSend: function() {
            $("#main3").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            console.log(response);
            $("#main3").html("");
            verHorarioPropuestoDocente('recarga');
        }
    });
}
function resumendisponibilidad() {
   borradoInicial();
   var url = "../vistas/complementarios/seleccion_docente.php";
    $.ajax({
        url: url,
        data: { ventana: 'resumenDisponibilidad' },
        type: 'post',
        beforeSend: function() {
            $("#main1").html("Procesando, espere por favor...");
        },
        success: function(response) {
            $("#main1").html(response);
        }
    });
}
function disponibilidadDocenteResumen(sel) {
    var url = '../vistas/horario_resumen.php';
    $.ajax({
        url: url,
        data: { data: sel},
        type: "post",
        beforeSend: function() {
            $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>');
        },
        success: function(response) {
            $("#main2").html(response);
        }
    });
}

function clickMalla(seccion) {
    borradoInicial();

    switch (seccion) {
        case 'nuevo':
            var url = "../vistas/formulario_cursos.php";
            $.ajax({
                url: url,
                type: 'get',
                beforeSend: function() {
                    $("#main1").html("Procesando, espere por favor...");
                },
                success: function(response) {
                    $("#main1").html(response);
                }
            });
            break;
        case 'editar':
            var url = "../vistas/complementarios/seleccion_cursos.php";
            $.ajax({
                url: url,
                type: 'post',
                beforeSend: function() {
                    $("#main1").html("Procesando, espere por favor...");
                },
                success: function(response) {
                    $("#main1").html(response);
                }
            });
            break;
    }

}


function grabarCurso(val) {
    var param = $('#datosCurso').serialize();
    switch (val) {
        case 'nuevo':
            var url = "../funciones/funcionales/insertar_curso.php";
            console.log(param);
            $.ajax({
                url: url,
                data: 'option=nuevo&' + param,
                type: "post",
                beforeSend: function() {
                    $("#main1").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                        '<span class="sr-only">Loading...</span>' +
                        '</div>');
                },
                success: function(response) {

                    $("#main1").html(response);
                    //$("#btn-modal").click();
                }
            });
            break;
        case 'obtener':
            var url = "../vistas/formulario_cursos.php";
            
            codCurso = $('#idcurso').val();
            $.ajax({
                url: url,
                data: { 'codCurso': codCurso },
                type: "post",
                beforeSend: function() {
                    $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                        '<span class="sr-only">Loading...</span>' +
                        '</div>');
                },
                success: function(response) {
                    $("#main2").html(response);
                }
            });
            break;
        case 'actualizar':
            var url = "../funciones/funcionales/insertar_curso.php";
            console.log(param);
            codCurso = $('#idcurso').val();
            $.ajax({
                url: url,
                data: 'option=actualizar&cursoActual=' + codCurso + '&' + param,
                type: "post",
                beforeSend: function() {
                    $("#main1").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                        '<span class="sr-only">Loading...</span>' +
                        '</div>');
                },
                success: function(response) {
                    borradoInicial();
                    
                    $("#main1").html(response);
                }
            });
            break;
        default:
            break;
    }

}

function clickCrearNuevoCurso() {
    borradoInicial();
    var url = "../vistas/curso_horario_nuevo.php";
    $.ajax({
        url: url,
        type: "get",
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

function verificarVacantes() 
{
    if($("#vacantes").val()<20 || $("#vacantes").val()>40){
        //alert("El rango permitido de vacantes es 20-40")
        $('#error').css('display','block')
        $('#vacantes').removeClass('is-valid')
        $('#vacantes').addClass('is-invalid')
        $('#grabarHorario').prop('disabled', true);
        $('.labo1').prop('disabled', true);
        $('.labo2').prop('disabled', true);
    } else{
        if($("#vacantes").val()==20 ){
            $('.labo1').prop('disabled', false);
        }
        if($("#vacantes").val()<=40 &&  $("#vacantes").val()>20 ){
            $('.labo1').prop('disabled', false);
            $('.labo2').prop('disabled', false);
        }
        $('#error').css('display','none')
        $('#vacantes').removeClass('is-invalid')
        $('#vacantes').addClass('is-valid')
        $('#grabarHorario').prop('disabled', false);

        console.log($('#maxLabo').val())
        if($('#maxLabo').val()==0){
            $('.labo1').prop('disabled', true);
            $('.labo2').prop('disabled', true);
        }
    }
}

function setMinutos() {
    hora=$('#horaInicioTeoria').val().split(":")
    if(hora=="" ){
        hora[0]='07';
    }
    $('#horaInicioTeoria').val(hora[0]+':00')
    hora=$('#horaInicioLaboratorio1').val().split(":")
   
    if(hora=="" ){
        hora[0]='07';
        
    }
    $('#horaInicioLaboratorio1').val(hora[0]+':00')
    hora=$('#horaInicioLaboratorio2').val().split(":")
    if(hora==""){
        hora[0]='07';
    }
    $('#horaInicioLaboratorio2').val(hora[0]+':00')

    hora=$('#horaInicioTeoria').val().split(":")
    if(parseInt(hora[0],10)+parseInt($('#maxTeoria').val(),10)>22){
        hora[0]=22-$('#maxTeoria').val();
    }
    
    if(parseInt(hora[0],10)<7){
        hora[0]='07';
    }
    $('#horaInicioTeoria').val(hora[0]+':00')
    hora=$('#horaInicioLaboratorio1').val().split(":")
    if(parseInt(hora[0],10)+parseInt(($('#maxLabo').val(),10))>22){
        hora[0]=22-$('#maxLabo').val();
    }
    if(parseInt(hora[0],10)<7){
        hora[0]='07';
    }
    $('#horaInicioLaboratorio1').val(hora[0]+':00')
    hora=$('#horaInicioLaboratorio2').val().split(":")
    if(parseInt(hora[0],10)+parseInt($('#maxLabo').val(),10)>22)
    {
        hora[0]=22-$('#maxLabo').val();
    }
    if(parseInt(hora[0],10)<7){
        hora[0]='07';
    }
    $('#horaInicioLaboratorio2').val(hora[0]+':00')
    
}

function seleccionCurso(valor) {
    verificarVacantes()
    horas=valor.split('-');
    $('#maxTeoria').val(horas[1])
    $('#maxLabo').val(horas[2]) 
    
    $('#tituloTeoria').text("Teoría ("+horas[1]+" horas)")
    $('#tituloLabo1').text("Laboratorio Grupo 01 ("+horas[2]+" horas)")
    $('#tituloLabo2').text("Laboratorio Grupo 02 ("+horas[2]+" horas)")

    if(horas[2]==0){
        $('.labo1').prop('disabled', true);
        $('.labo2').prop('disabled', true);
    }

}
function obtenerAula(campus,idModificar,tipo) {

    var url = "../vistas/complementarios/seleccion_aula.php";
    $.ajax({
        url: url,
        data:{'sede':campus,'tipo':tipo},
        type: "post",
        beforeSend: function() {
            
        },
        success: function(response) {
            console.log(response)
            $("#"+idModificar).html(response);
        }
    });
    
}

function grabarHorarioCurso() 
{
    var datos = $("#datosCurso").serializeArray();
    console.log(datos)
    falta = false
    datos.forEach(element => {
        if(element.value==""){
            falta = true
        }
    });
    if(falta){
        alert("Complete todos los campos")
    }else{
        
        var url = "../funciones/funcionales/insertar_horario_curso.php";
        datos.push({name:'insertar',value:'true'});
    $.ajax({
        url: url,
        data:datos,
        type: "post",
        beforeSend: function() {
            
        },
        success: function(response) {
            console.log(response)
            if(response="exito"){
                
                alert("Se ha registrado satisfactoriamente el horario")
                clickCrearNuevoCurso()
            }
        }
    });
    }

    
}
function modificarHorarioCurso() 
{
    borradoInicial();
    var url = "../vistas/complementarios/seleccion_horarios.php";
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

function cargarHorario(sel){

    var url = "../vistas/funcionales/horario_actualizar.php";
    $.ajax({
            url: url,
            data:{id:sel},
            type: "post",
            beforeSend: function() {
                $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>');
            },
            success: function(response) {
                $("#main2").html(response);
            }
        });

}

function actualizarHorarioCurso() 
{
    var datos = $("#datosCurso").serializeArray();
    console.log(datos)
    falta = false
    datos.forEach(element => {
        if(element.value==""){
            falta = true
        }
    });
    if(falta){
        alert("Complete todos los campos")
    }else{
        
        var url = "../funciones/funcionales/insertar_horario_curso.php";
        datos.push({name:'actualizar',value:'true'});
        
    $.ajax({
        url: url,
        data:datos,
        type: "post",
        beforeSend: function() {
            
        },
        success: function(response) {
            console.log(response)
            if(response="exito"){
                
                alert("Se ha registrado satisfactoriamente el horario")
                cargarHorario($('#horario').val())
            }
        }
    });
    }

    
}

function setMinutosActualizar() {
    hora=$('#horaInicio').val().split(":")
    if(hora=="" ){
        hora[0]='07';
        $('#horaInicio').val(hora[0]+':00')
    }
    horafin = parseInt(hora[0],10)+parseInt($('#maxHoras').val(),10);
    if(horafin>23){
        hora[0]=22-$('#maxHoras').val();
        $('#horaInicio').val(hora[0]+':00')
    }
    
    if(parseInt(hora[0],10)<7){
        hora[0]='07';
        $('#horaInicio').val(hora[0]+':00')
    }
    
}

function eliminarHorario() {
    var datos = $("#datosCurso").serializeArray();
    console.log(datos)
        var url = "../funciones/funcionales/eliminar_horario_curso.php";
        datos.push({name:'actualizar',value:'true'});
        
    $.ajax({
        url: url,
        data:{id:$('#id').val()},
        type: "post",
        beforeSend: function() {
            
        },
        success: function(response) {
            console.log(response)
            if(response="exito"){
                alert("Se ha eliminado satisfactoriamente el horario")
                eliminarHorarioCurso()
            }
        }
    });
    
}
function eliminarHorarioCurso() 
{
    borradoInicial();
    var url = "../vistas/complementarios/seleccion_eliminar.php";
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
//cargarHorarioEliminar
function cargarHorarioEliminar(sel){

    var url = "../vistas/funcionales/horario_eliminar.php";
    $.ajax({
            url: url,
            data:{id:sel},
            type: "post",
            beforeSend: function() {
                $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>');
            },
            success: function(response) {
                $("#main2").html(response);
            }
        });

}

function verHorariosPorCurso()
{
    borradoInicial()
    var url = "../vistas/complementarios/seleccion_por_cursos.php";
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
function cargarHorariosCurso(sel) 
{
    var url = "../vistas/ver_horarios_curso.php";
    $.ajax({
            url: url,
            data:{id:sel},
            type: "post",
            beforeSend: function() {
                $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>');
            },
            success: function(response) {
                $("#main2").html(response);
            }
        });
    
}
function verHorariosPorCiclo()
{
    borradoInicial()
    var url = "../vistas/complementarios/seleccion_por_ciclos.php";
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

function cargarHorariosCiclo(sel) 
{
    var url = "../vistas/ver_horarios_ciclo.php";
    $.ajax({
            url: url,
            data:{ciclo:sel},
            type: "post",
            beforeSend: function() {
                $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>');
            },
            success: function(response) {
                $("#main2").html(response);
            }
        });
    
}
function verHorariosPorCarrera()
{
    borradoInicial()
    var url = "../vistas/complementarios/seleccion_por_carrera.php";
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

function cargarHorariosCarrera(sel) 
{
    var url = "../vistas/ver_horarios_carrera.php";
    $.ajax({
            url: url,
            data:{carrera:sel},
            type: "post",
            beforeSend: function() {
                $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>');
            },
            success: function(response) {
                $("#main2").html(response);
            }
        });
    
}

function verOcupabilidad() 
{
    borradoInicial()
    var url = "../vistas/ver_ocupabilidad.php";
    $.ajax({
            url: url,
            type: "post",
            beforeSend: function() {
                $("#main2").html('<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>');
            },
            success: function(response) {
                $("#main2").html(response);
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