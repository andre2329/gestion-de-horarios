<?php
require_once '../../utils/conexion_db.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    switch ($_POST['selecciones']) {
        case 'curso':
                      $sql = "SELECT DISTINCT cursos.nombre, cursos.codcurso from cursos 
                      INNER JOIN horarios on cursos.codcurso = horarios.codcurso 
                      WHERE horarios.iddocente IS NULL AND horarios.semestre = '2020-2'";
                  
                      try {
                          $stmt=$pdo->prepare($sql);
                          $stmt->execute();
                      } catch (Exception $ex) {
                          echo "Ha ocurrido un error al obtener los datos ".$ex;
                      }
                      $posiciones = array();
                      $campus = array();
                      ?>
<br>
<table class="text-center col-md-10 mx-auto">

    <thead>
        <tr>
            <th style="width: 30%" scope="col">Curso</th>
            <th style="width: 10%" scope="col">Tipo</th>
            <th style="width: 15%" scope="col">Sede</th>
            <th style="width: 25%" scope="col">Horario - Grupo</th>
            <th style="width: 10%" scope="col">Secci&oacute;n</th>
            <th style="width: 10%" scope="col">Aula</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <select onchange=selectCurso(this) id="curso" name="curso" class="form-control text-center">
                    <option selected hidden value="">...</option>
                    <?php
                    if ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                        foreach ($fila as $esp) {
                            $nombre = $esp['nombre'];
                            $codcurso = $esp['codcurso'];
                            echo '<option value="'.$codcurso.'">'.$nombre.'</option>';
                        }
                    } else {
                        $no_existe=true;
                    }
                    ?>
                </select>
            </td>
            <td id="tipo">
                <select disabled=true class="form-control">
                    <option selected hidden value="">...</option>
                </select>
            </td>
            </td>
            <td id="sede">
                <select disabled=true class="form-control">
                    <option selected hidden value="">...</option>
                </select>
            </td>
            </td>
            <td id="horario">
                <select disabled=true class="form-control">
                    <option selected hidden value="">...</option>
                </select>
            </td>
            </td>
            <td id="seccion">
                <select disabled=true class="form-control">
                    <option selected hidden value="">...</option>
                </select>
            </td>
            </td>
            <td id="aula">
                <select disabled=true class="form-control">
                    <option selected hidden value="">...</option>
                </select>
            </td>
            </td>
        </tr>
    </tbody>
</table>
<div id="error" class="col-md-12 mt-2 text-center text-danger">
    <h2>
        <?php echo isset($no_existe)?'No existen cursos disponibles':'' ;?>
    </h2>
</div>
<div class="col-md-12 mt-2 pb-2 text-center">
    <button id="btnGuardarPrincipal" type="button" class="btn btn-primary" disabled=true onclick="$('#btn-modal').click()">Guardar</button>
    <input type="checkbox" id="btn-modal">
    <div class="modal-propio">
        <div class="contenedor-modal">
            <div class="d-flex justify-content-between align-middle align-items-center">
                <h4 class="d-inline-block p-4" id="titulo-modal">&iquest;Est&aacute; seguro que quiere grabar en este
                    horario al docente&#63;</h4>

                <label class="d-inline-block p-2 " for="btn-modal"><i class="fa fa-times" id="salir-modal"></i></label>
            </div>
            <hr class="p-4">
            <div class="contenido-modal p-4">
                <label class="btn btn-dark text-light" onclick="registrarPropuesta()">Aceptar</label>
                <label class="btn btn-light text-light bg-secondary" for="btn-modal">Cancelar</label>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-secondary" onclick="verHorarioPropuestoDocente('recarga')">Cancelar</button>
</div>
<!-- Modal -->
<div class="modal fade" id="guardarCurso" tabindex="-1" role="dialog" aria-labelledby="guardarCursoLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="guardarCursoLabel">&#191;Est&aacute; seguro que desea registar al docente en
                    ese horario&#63;</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"
                    onclick=registrarPropuesta()>Aceptar</button>
            </div>
        </div>
    </div>
</div>




<?php
                      
            break;
        case 'sede':
            $codcurso = $_POST['codCurso'];
            $tipo_sesion = $_POST['tipo'];
    
            $sql = "SELECT DISTINCT sede from horarios
            INNER JOIN aulas ON horarios.idAula =  aulas.idAula
             WHERE horarios.iddocente IS NULL AND horarios.codcurso = :codCurso AND horarios.tiposesion = :tiposesion";
                  
                      try {
                          $stmt=$pdo->prepare($sql);
                          $stmt->execute(array(
                            ':codCurso'=>$codcurso,
                            ':tiposesion'=>$tipo_sesion
                                ));
                      } catch (Exception $ex) {
                          echo "Ha ocurrido un error al obtener los datos ".$ex;
                      }
                      
                      if ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                          echo "<select  onchange=selectSede(this) id = 'selectSede' class='form-control'>";
                          echo '<option selected hidden value="" >...</option>';
                          foreach ($fila as $esp) {
                              $sede = $esp['sede'];
                              echo '<option value=\''.$sede.'\'>'.$sede.'</option>';
                              //echo $nombre.$codcurso;
                          }
                          echo "</select>";
                      } else {
                          echo '';
                      }
            break;
    
        case 'horario':
            $codcurso = $_POST['codCurso'];
            $tipo_sesion = $_POST['tipo'];
            $sede = $_POST['sede'];
    
    
            $sql = "SELECT horaInicio,horaFin,dia,grupo from horarios 
            INNER JOIN aulas  ON horarios.idAula = aulas.idAula
            WHERE iddocente IS NULL AND horarios.codcurso = :codCurso AND horarios.tiposesion = :tiposesion
            AND aulas.sede=:sede";
               
                      try {
                          $stmt=$pdo->prepare($sql);
                          $stmt->execute(array(
                            ':codCurso'=>$codcurso,
                            ':tiposesion'=>$tipo_sesion,
                            ':sede'=>$sede
                                ));
                      } catch (Exception $ex) {
                          echo "Ha ocurrido un error al obtener los datos ".$ex;
                      }
                      echo "<select  onchange=selectHorario(this) id='selectHorario' class='form-control'>";
                      
              
                      echo '<option selected hidden value="" >...</option>';
                      
                      if ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                          foreach ($fila as $esp) {
                              $dia = $esp['dia'];
                              $hora_inicio = $esp['horaInicio'];
                              $hora_fin = $esp['horaFin'];
                              $grupo = $esp['grupo'];
                                                                                            
                              //echo $nombre.$codcurso;
                              echo '<option value=\''.$hora_inicio.'-'.$hora_fin.' '.$dia.'-'.$grupo.'\'>'.$dia.' '.substr($hora_inicio, 0, 5).'-'.substr($hora_fin, 0, 5).' Grupo:'.$grupo.'</option>';
                          }
                          echo "</select>";
                      } else {
                          echo '';
                      }
            break;
    
        case 'tipo':
            $_SESSION['codCurso']=$_POST['codCurso'];
            //var_dump($_SESSION);
            $codCurso = $_SESSION['codCurso'];
            $sql = "SELECT DISTINCT tiposesion from horarios  WHERE iddocente IS NULL AND codcurso = :codCurso ";
            //"AND hora_inicio = :hora_inicio AND hora_fin = :hora_fin AND dia = :dia AND sede = :sede";
                      try {
                          $stmt=$pdo->prepare($sql);
                          $stmt->execute(array(
                            ':codCurso'=>$codCurso
                                ));
                      } catch (Exception $ex) {
                          echo "Ha ocurrido un error al obtener los datos ".$ex;
                      }
                      echo "<select  onchange=selectTipo(this) id='selectTipo' class='form-control'>";
                      
              
                      echo '<option selected hidden value="" >...</option>';
                      if ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                          foreach ($fila as $esp) {
                              $tipo = $esp['tiposesion'];
                              echo '<option value=\''.$tipo.'\'>'.$tipo.'</option>';
                          }
                          echo "</select>";
                      } else {
                          echo '';
                      }
            break;
    
        case 'seccion':
                $tipo_sesion = $_POST['tipo'];
                $sede = $_POST['sede'];
                $codcurso = $_POST['codCurso'];
                $hora_inicio = $_POST['hora_inicio'];
                $hora_fin = $_POST['hora_fin'];
                $dia = $_POST['dia'];
                $grupo = $_POST['grupo'];
    
                $sql = "SELECT seccion from horarios  INNER JOIN aulas
                ON horarios.idAula=aulas.idAula
                WHERE horarios.iddocente IS NULL AND horarios.codcurso = :codCurso ".
                "AND horarios.horaInicio = :hora_inicio AND horarios.horaFin = :hora_fin AND horarios.dia = :dia AND aulas.sede = :sede AND horarios.tiposesion = :tiposesion".
                " AND horarios.grupo =:grupo";
                   
                      
                          try {
                              $stmt=$pdo->prepare($sql);
                              $stmt->execute(array(
                                ':codCurso'=>$codcurso,
                                ':hora_inicio'=>$hora_inicio,
                                ':hora_fin'=>$hora_fin,
                                ':dia'=>$dia,
                                ':sede'=> $sede,
                                ':tiposesion'=> $tipo_sesion,
                                ':grupo'=>$grupo
                                    ));
                          } catch (Exception $ex) {
                              echo "Ha ocurrido un error al obtener los datos ".$ex;
                          }
                          echo "<select  onchange=selectSeccion(this) id='selectSeccion' class='form-control'>";
                          
                  
                          echo '<option selected hidden value="" >...</option>';
                          if ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                              foreach ($fila as $esp) {
                                  $seccion = $esp['seccion'];
                                  echo '<option value=\''.$seccion.'\'>'.$seccion.'</option>';
                              }
                              echo "</select>";
                          } else {
                              echo '';
                          }
                break;
    
        case 'aula':
                    $_SESSION['seccion']=$_POST['seccion'];
                    $seccion = $_POST['seccion'];
                    $tipo_sesion = $_POST['tipo'];
                    $sede = $_POST['sede'];
                    $codcurso = $_POST['codCurso'];
                    $hora_inicio = $_POST['hora_inicio'];
                    $hora_fin = $_POST['hora_fin'];
                    $dia = $_POST['dia'];
                    $grupo = $_POST['grupo'];
    
                    $sql = "SELECT nombre,horarios.idAula from horarios  INNER JOIN aulas
                    ON horarios.idAula = aulas.idAula
                    WHERE horarios.iddocente IS NULL AND horarios.codcurso = :codCurso ".
                    "AND horarios.horaInicio = :hora_inicio AND horarios.horaFin = :hora_fin AND horarios.dia = :dia AND aulas.sede = :sede AND horarios.tiposesion = :tiposesion".
                    " AND horarios.seccion = :seccion AND horarios.grupo =:grupo";
                       
                          
                              try {
                                  $stmt=$pdo->prepare($sql);
                                  $stmt->execute(array(
                                    ':codCurso'=>$codcurso,
                                    ':hora_inicio'=>$hora_inicio,
                                    ':hora_fin'=>$hora_fin,
                                    ':dia'=>$dia,
                                    ':sede'=> $sede,
                                    ':tiposesion'=> $tipo_sesion,
                                    ':seccion' =>$seccion,
                                    ':grupo'=>$grupo
                                        ));
                              } catch (Exception $ex) {
                                  echo "Ha ocurrido un error al obtener los datos ".$ex;
                              }
                              echo "<select  id='selectAula' onChange='habilitarBtn()' class='form-control'>";
                              
                      
                              echo '<option selected hidden value="" >...</option>';
                              if ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                                  foreach ($fila as $esp) {
                                      $aula = $esp['nombre'];
                                      $idAula = $esp['idAula'];
                                      echo '<option value=\''.$idAula.'\'>'.$aula.'</option>';
                                  }
                                  echo "</select>";
                              } else {
                                  echo '';
                              }
                    break;
    }
}


?>