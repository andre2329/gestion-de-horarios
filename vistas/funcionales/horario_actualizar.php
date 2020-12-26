<?php

require_once './../../funciones/obtenerPHP.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $id = $_POST['id'];
    $horario = obtenerDatosHorarios($id);
    $stringCursos = "";
    //var_dump($horario);
    
    $stringDocentes = "";
    $selec="";
    $docentes = obtenerDatosDocente(0);
    foreach ($docentes as $docente) {
        if($horario['idDocente']==$docente['idDocente']){
            $selec = 'selected';
        }
        $stringDocentes=$stringDocentes."<option value=".$docente['idDocente']." ".$selec.">".$docente['name']." ".$docente['apellidoP']." ".$docente['apellidoM']."</option>";
        $selec="";
    }
    $stringAula ="";
    $aulas = obtenerDatosAula(0,$horario['sede'],$horario['tipo']);
    //var_dump($aulas);
    foreach ($aulas as $aula ) {
        if($horario['idAula']==$aula['idAula']){
            $selec = 'selected';
        }
        $stringAula = $stringAula."<option value='".$aula['idAula']."' ".$selec.">".$aula['nombre']."</option>";
        $selec="";
    }
    
    ?>
    <form class="col-md-12 mx-auto mt-5" id="datosCurso">
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
                    
                    <div style="display: none;">
                    <input type="text" id="maxHoras" name ="maxHoras" 
                    value="<?php
                    if($horario['tipo']=="TEO"){
                        echo $horario['horasTeoria'];
                    }else{
                        echo $horario['horasLaboratorio'];
                    }?>">
                    <input type="text" id="tipo" name ="tipo" 
                    value="<?php echo $horario['tipo'];?>">
                    <input type="text" id="grupo" name ="grupo" 
                    value="<?php echo $horario['grupo'];?>">
                    <input type="text" id="id" name ="id" 
                    value="<?php echo $horario['id'];?>">
                    </div>
                    
                    
                    </div>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">
                            Ingrese c&oacute;digo de la secci&oacute;n
                        </td>
                        <td>
                            <input class="form-control" type="text" name="seccion" id="seccion"
                            value="<?php echo $horario['seccion']?>"
                            >
                        </td>
                    </tr>
                    <tr >
                        <td colspan="5">
                            <h2 class="mx-auto" id="titulo"><?php 
                            
                            if($horario['tipo']=="TEO"){
                                echo "Teor&iacute;a (".$horario['horasTeoria']." horas)";
                            }else{
                                echo "Laboratorio Grupo 0".$horario['grupo']." (".$horario['horasLaboratorio']." horas)";
                            }
                            
                            ?></h2>
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
                            <input class="form-control" type="time" step="3600000" min="07:00" max="22:00" 
                            onkeyup="setMinutosActualizar()" onchange="setMinutosActualizar()"  name="horaInicio" id="horaInicio"
                            value="<?php echo ($horario['horaInicio']<10)?'0'.$horario['horaInicio']:$horario['horaInicio']; ?>:00:00"
                            >
                        </td>
                        <td width=20%>
                            <select class="form-control"  name="dia" id="dia">
                                <?php 
                                $lunes="";
                                $martes="";
                                $miercoles="";
                                $jueves="";
                                $viernes="";
                                $sabado="";
                                switch ($horario['dia']){
                                    case 0:
                                        $lunes = 'selected';
                                    break;
                                    case 1:
                                        $martes = 'selected';
                                    break;
                                    case 2:
                                        $miercoles = 'selected';
                                    break;
                                    case 3:
                                        $jueves = 'selected';
                                    break;
                                    case 4:
                                        $viernes = 'selected';
                                    break;
                                    case 5:
                                        $sabado = 'selected';
                                    break;
                                }
                                ?>
                                <option value="0" <?php echo $lunes?>>Lunes</option>
                                <option value="1" <?php echo $martes?>>Martes</option>
                                <option value="2" <?php echo $miercoles?>>Mi&eacute;rcoles</option>
                                <option value="3" <?php echo $jueves?>>Jueves</option>
                                <option value="4" <?php echo $viernes?>>Viernes</option>
                                <option value="5" <?php echo $sabado?>>S&aacute;bado</option>
                            </select>
                        </td>
                        <td width=20%>
                            <select class="form-control"  name="docente" id="docente">
                                <option value="NULL" hidden>...</option>
                                <?php
                                
                                 if($horario['idDocente']==NULL){
                                     echo '<option value="NULL" selected>Ninguno</option>';
                                     echo $stringDocentes;
                                 }else{
                                     echo '<option value="NULL" >Ninguno</option>';
                                     echo $stringDocentes;
                                 }
                                
                                ?>
                                
                            </select>
                        </td>
                        <td width=20%>
                            <select class="form-control"  name="campus" onchange="obtenerAula(this.value,'aula','<?php echo $horario['tipo'] ?>')" id="campus">
                                <option value="" hidden>...</option>
                                <?php
                                $mo = "";
                                $sm = "";
                                $vl = "";
                                switch ($horario['sede']) {
                                    case 'MO':
                                        $mo = "selected";
                                        break;
                                    
                                    case 'SM':
                                        $sm = "selected";
                                        break;
                                    case 'VL':
                                        $vl = "selected";
                                        break;
                                }
                                ?>
                                <option value="MO" <?php echo $mo ?>>MO</option>
                                <option value="SM" <?php echo $sm ?>>SM</option>
                                <option value="VL" <?php echo $vl ?>>VL</option>
                            </select>
                        </td>
                        <td width=20%>
                            <select class="form-control"  name="aula" id="aula">
                                <option value="" hidden>...</option>
                                <?php echo $stringAula ?>
                            </select>
                        </td>
                    </tr>
    
                </tbody>
            </table>
    
            
        </div>
        <input type="text" id="codCurso" name="codCurso" style="display: none;"
        value="<?php echo $horario['codCurso']?>"
        >
    </form>
    
    <button class="btn btn-dark mb-5" id="grabarHorario" onclick="actualizarHorarioCurso()">Grabar</button>
    <?php
}
?>