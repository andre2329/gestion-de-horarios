<?php

require_once './../funciones/obtenerPHP.php';

$cursos = obtenerDatosCurso(0);
$stringCursos = "";
foreach ($cursos as $curso) {
    $stringCursos=$stringCursos."<option value=".$curso['codCurso'].'-'.$curso['horasTeoria'].'-'.$curso['horasLaboratorio']." >".$curso['nombre']."</option>";
}
$docentes = obtenerDatosDocente(0);
$stringDocentes = "";
foreach ($docentes as $docente) {
    $stringDocentes=$stringDocentes."<option value=".$docente['idDocente']." >".$docente['name']." ".$docente['apellidoP']." ".$docente['apellidoM']."</option>";
}
?>
<form class="col-md-12 mx-auto mt-5" id="datosCurso">
    <h2 class=" text-center">Crear un nuevo horario</h2>
    <div>
    <style>
        td{
            padding: 10px;
        }
    
    </style>
    <script>
        $('.labo1').prop('disabled', true);
        $('.labo2').prop('disabled', true);
    </script>
        <table class="mx-auto">
            <thead>
                <tr>
                    
                    <td colspan="5">
                        Seleccione un curso
                    </td>
                </tr>
                <tr>
                    <td colspan="5"><select class="form-control" onchange="seleccionCurso(this.value)" name="curso" id="curso">
                        <option value="" hidden></option>
                        <?php echo $stringCursos?>
                    </select></td>
                </tr>
                <div style="display:none;">
                <input type="text" id="maxTeoria" name ="maxTeoria" value="2">
                <input type="text" id="maxLabo" name ="maxLabo" value="2">
                </div>
                
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        Ingrese c&oacute;digo de la secci&oacute;n
                    </td>
                    <td>
                        <input class="form-control" type="text" name="seccion" id="seccion">
                    </td>
                    <td>
                        vacantes
                    </td>
                    <td>
                        <input class="form-control is-invalid" type="number" onkeyup="verificarVacantes()" onchange="verificarVacantes()" name="vacantes" id="vacantes">
                        
                    </td>
                    
                </tr>
                <tr >
                    <td colspan="5" >
                        <small class="sm text-danger mx-auto" id="error"  style="display: none;">El rango permitido de vacantes es 20-40</small>
                    </td>
                    
                </tr>
                <tr >
                    <td colspan="5">
                        <h2 class="mx-auto" id="tituloTeoria">Teor&iacute;a</h2>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        Hora inicio:
                    </td>
                    <td>
                        Dia:
                    </td>
                    <td>
                        Docente:
                    </td>
                    <td>
                        Campus:
                    </td>
                    <td>
                        Aula:
                    </td>
                </tr>
                <tr>
                    <td width=20%>
                        <input class="form-control" type="time" step="3600000" min="07:00" max="22:00" onkeyup="setMinutos()" onchange="setMinutos()"  name="horaInicioTeoria" id="horaInicioTeoria">
                    </td>
                    <td width=20%>
                        <select class="form-control"  name="diaTeoria" id="diaTeoria">
                            <option value="0">Lunes</option>
                            <option value="1">Martes</option>
                            <option value="2">Mi&eacute;rcoles</option>
                            <option value="3">Jueves</option>
                            <option value="4">Viernes</option>
                            <option value="5">S&aacute;bado</option>
                        </select>
                    </td>
                    <td width=20%>
                        <select class="form-control"  name="docenteTeoria" id="docenteTeoria">
                            <option value="NULL" hidden>...</option>
                            <option value="NULL" >Ninguno</option>
                            <?php echo $stringDocentes?>
                        </select>
                    </td>
                    <td width=20%>
                        <select class="form-control"  name="campusTeoria" onchange="obtenerAula(this.value,'aulaTeoria','TEO')" id="campusTeoria">
                            <option value="" hidden>...</option>
                            <option value="MO" >MO</option>
                            <option value="SM" >SM</option>
                            <option value="VL" >VL</option>
                        </select>
                    </td>
                    <td width=20%>
                        <select class="form-control"  name="aulaTeoria" id="aulaTeoria">
                            <option value="" hidden>...</option>
                            
                        </select>
                    </td>
                </tr>

                <tr >
                    <td colspan="5">
                        <h2 class="mx-auto" id="tituloLabo1">Laboratorio Grupo 01</h2>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        Hora inicio:
                    </td>
                    <td>
                        Dia:
                    </td>
                    <td>
                        Docente:
                    </td>
                    <td>
                        Campus:
                    </td>
                    <td>
                        Aula:
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="form-control labo1" type="time" step="3600000" min="07:00" max="22:00" onkeyup="setMinutos()" onchange="setMinutos()"  name="horaInicioLaboratorio1" id="horaInicioLaboratorio1">
                    </td>
                    <td>
                        <select class="form-control labo1"  name="diaLaboratorio1" id="diaLaboratorio1">
                            <option value="0">Lunes</option>
                            <option value="1">Martes</option>
                            <option value="2">Mi&eacute;rcoles</option>
                            <option value="3">Jueves</option>
                            <option value="4">Viernes</option>
                            <option value="5">S&aacute;bado</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control labo1"  name="docenteLaboratorio1" id="docenteLaboratorio1">
                            <option value="" hidden>...</option>
                            <option value="NULL" >Ninguno</option>
                            <?php echo $stringDocentes?>
                            
                        </select>
                    </td>
                    <td>
                        <select class="form-control labo1"  name="campusLaboratorio1" onchange="obtenerAula(this.value,'aulaLaboratorio1','LAB')"  id="campusLaboratorio1">
                            <option value="" hidden>...</option>
                            <option value="MO" >MO</option>
                            <option value="SM" >SM</option>
                            <option value="VL" >VL</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control labo1"  name="aulaLaboratorio1"  id="aulaLaboratorio1">
                            <option value="" hidden>...</option>
                           
                        </select>
                    </td>
                </tr>
                <tr >
                    <td colspan="5">
                        <h2 class="mx-auto" id="tituloLabo2">Laboratorio Grupo 02</h2>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        Hora inicio:
                    </td>
                    <td>
                        Dia:
                    </td>
                    <td>
                        Docente:
                    </td>
                    <td>
                        Campus:
                    </td>
                    <td>
                        Aula:
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="form-control labo2" type="time" step="3600000" min="07:00" max="22:00" onkeyup="setMinutos()" onchange="setMinutos()" name="horaInicioLaboratorio2" id="horaInicioLaboratorio2">
                    </td>
                    <td>
                        <select class="form-control labo2"  name="diaLaboratorio2" id="diaLaboratorio2">
                            <option value="0">Lunes</option>
                            <option value="1">Martes</option>
                            <option value="2">Mi&eacute;rcoles</option>
                            <option value="3">Jueves</option>
                            <option value="4">Viernes</option>
                            <option value="5">S&aacute;bado</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control labo2"  name="docenteLaboratorio2" id="docenteLaboratorio2">
                            <option value="" hidden>...</option>
                            <option value="NULL" >Ninguno</option>
                            <?php echo $stringDocentes?>
                            
                        </select>
                    </td>
                    <td>
                        <select class="form-control labo2"  name="campusLaboratorio2" onchange="obtenerAula(this.value,'aulaLaboratorio2','LAB')" id="campusLaboratorio2">
                            <option value="" hidden>...</option>
                            <option value="MO" >MO</option>
                            <option value="SM" >SM</option>
                            <option value="VL" >VL</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control labo2"  name="aulaLaboratorio2" id="aulaLaboratorio2">
                            <option value="" hidden>...</option>
                            
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>

        
    </div>

</form>
<button class="btn btn-dark mb-5" id="grabarHorario" disabled="true" onclick="grabarHorarioCurso()">Grabar</button>
