<?php
require_once __DIR__.'/../funciones/funcionales/verificar_propuesto.php';
require_once '../utils/conexion_db.php';
session_start();
//var_dump($_SESSION);
if($_SERVER['REQUEST_METHOD']=="POST"){
    if ($_SESSION['isAdmin']==1) {
        $iddocente = $_POST['idDocente'];
    } else {
        $iddocente = $_SESSION['iddocente'];
    }

    $ciclo = $_POST['ciclo'];
    //var_dump($_SESSION);
    //var_dump($iddocente);
    //var_dump($ciclo);
    if (isset($_POST)) {
        
        $sql = "SELECT *,cursos.nombre AS nombres from horarios 
        inner join cursos on cursos.codCurso = horarios.codCurso 
        inner join aulas on horarios.idAula=aulas.idAula
         where idDocente = :iddocente".
    " AND horarios.semestre = :ciclo";
    }

    try {
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
                        ':iddocente'=>$iddocente,
                        ':ciclo'=>$ciclo

        ));
    } catch (Exception $ex) {
        echo "Ha ocurrido un error al obtener los datos ".$ex;
    }
    $codigos = array();
    $secciones = array();
    $sesiones = array();
    $secciones = array();
    $dias = array();
    $horas_inicio = array();
    $horas_fin = array();
    $aulas = array();
    $grupos = array();
    $sedes = array();
    $cursos = array();
    if ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        //var_dump($fila);
        
        foreach ($fila as $esp) {
            $uactualizacion = $esp['uActualizacion'];
            $codcurso = $esp['codCurso'];
            $seccion = $esp['seccion'];
            $tiposesion = $esp['tipoSesion'];
            $dia = $esp['dia'];
            $hora_inicio = $esp['horaInicio'];
            $hora_fin = $esp['horaFin'];
            $aula = $esp['nombre'];
            $grupo = $esp['grupo'];
            $sede = $esp['sede'];
            $curso = $esp['nombres'];


            $codigos[] = $codcurso;
            $secciones[] = $seccion;
            $sesiones[] = $tiposesion;
            $dias[] = $dia;
            $horas_inicio[] = $hora_inicio;
            $horas_fin[] = $hora_fin;
            $aulas[] = $aula;
            $grupos[] = $grupo;
            $sedes[] = $sede;
            $cursos[] = $curso;
        }

        //var_dump($posiciones);
       //var_dump($campus);
    }
   
    $colores = array("teal","#B565A7","#FFB914","#A13600","#006BA1","#6BA100","#7FFFD4","#B2EBF2","#BDBDBD","#006BA1","#9E9E9E","#C0392B","#D7BDE2","#A9CCE3");
    //$dias_seman = array("LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SABADO",);
    $pos_generadas = array();
    $asociado_generado = array();
    $horas_generadas = array();
    $sedes_generadas = array();
    $colores_generados = array();
    $grupos_generados = array();
    $secciones_generadas = array();
    $aulas_generadas = array();
    $sesiones_generadas = array();
    $codigos_generados = array();
    $cursos_generados = array();

    //($dias);
    for ($i=0; $i < count($codigos); $i++) {
            $num_dia = $dias[$i];
            $hora_inicio = $horas_inicio[$i];
            $hora_fin = $horas_fin[$i];
            $total_horas = $hora_fin - $hora_inicio;
            for ($j=0; $j < $total_horas; $j++) {
                $hora = $hora_inicio + $j;
                $pos_generadas[] = $hora.'-'.$num_dia;
                $horas_generadas[] = $total_horas;
                $colores_generados[] = $colores[$i];
                $sedes_generadas[]= $sedes[$i];
                $grupos_generados[] = $grupos[$i];
                $secciones_generadas[] = $secciones[$i];
                $aulas_generadas[] = $aulas[$i];
                $sesiones_generadas[] = $sesiones[$i];
                $codigos_generados[] = $codigos[$i];
                $cursos_generados[] = $cursos[$i];

                if ($j == 0) {
                    $asociado_generado[] = 'P';//principal
                } else {
                    $asociado_generado[] = 'S';//principal
                }
            }
        
    }

    if($ciclo=="2020-2"){
        VerificarHorasMax(count($pos_generadas), $pdo); 
    }
    ?>

<div class="mx-auto w-auto text-center mt-5">

<?php echo ($_SESSION['isAdmin']==0)?"<h2> Horario Propuesto </h2>":"" ?>

<table class=" col-md-12 table mx-auto h-auto table-sm table-responsive-xl  table-bordered medium">
    <thead>
        <tr class="text-center">
            <th style="width: 14%" scope="col">Horario</th>
            <th style="width: 12.28%" scope="col">Lunes</th>
            <th style="width: 12.28%" scope="col">Martes</th>
            <th style="width: 12.28%" scope="col">Mi&eacute;rcoles</th>
            <th style="width: 12.28%" scope="col">Jueves</th>
            <th style="width: 12.28%" scope="col">Viernes</th>
            <th style="width: 12.28%" scope="col">S&aacute;bado</th>
            <th scope="col">Domingo</th>
        </tr>

    </thead>
    <tbody>

        <?php

        $horario = array(0=>"07:00-08:00",1=>"08:00-09:00",2=>"09:00-10:00",
                         3=>"10:00-11:00",4=>"11:00-12:00",5=>"12:00-13:00",
                         6=>"13:00-14:00",7=>"14:00-15:00",8=>"15:00-16:00",
                         9=>"16:00-17:00",10=>"17:00-18:00",11=>"18:00-19:00",
                         12=>"19:00-20:00",13=>"20:00-21:00",14=>"21:00-22:00",15=>"22:00-23:00");

    for ($i=0;$i<16;$i++) {
        echo "<tr class=' align-middle'>";
        list($ini, $fin)=explode("-", $horario[$i]);
        echo "<td class=' mx-auto align-middle' scope='row'>".$ini.'-'.$fin."</td>";

        for ($j=0;$j<7;$j++) {
            if ($j<6) {
                $n = ($i+7).'-'.$j;
                if ($j==4 && ($i==6 || $i==7)) {
                    echo "<td class=' align-middle'></td>";
                } else {
                    if (in_array($n, $pos_generadas)) {
                        $pos = array_search($n, $pos_generadas);
                        if ($asociado_generado[$pos]=='P') {
                            echo "<td class='align-middle'rowspan='".
                                            $horas_generadas[$pos]."' style='background-color:".$colores_generados[$pos].";'>".
                                            $codigos_generados[$pos].'-'.$sesiones_generadas[$pos]."<br>".
                                            $sedes_generadas[$pos]."<br>".
                                            "Grupo: ".$grupos_generados[$pos]."<br>".
                                            "Aula: ".$aulas_generadas[$pos].
                                            "</td>";
                        }
                    } else {
                        echo "<td class=' align-middle'></td>";
                    }
                }
            } else {
                echo "<td class=' align-middle'>
                                <div class=' align-middle'></div>
                                </td>";
            }
        }
        echo "</tr>";
    } ?>


    </tbody>


</table>
</div>
<div class=" mt-5 col-md-10 mx-auto">

<?php
            if (count($cursos)!=0) {
                $horas_total = 0;
                for ($i=0; $i < count($horas_inicio); $i++) {
                    $horas_total += $horas_fin[$i]-$horas_inicio[$i];
                } ?>
<h5 class="text-center">Resumen de cursos - Total horas : <?php echo $horas_total." - &Uacute;ltima actualizaci&oacute;n: ".$datetime = date("H:i:s Y-m-d ", strtotime($uactualizacion)- (5 * 60 * 60)); ?></h5>

<table class="table table-bordered">

    <thead class="thead-dark">
        <tr>
            <th>Color</th>
            <th>Codigo</th>
            <th>Secci&oacute;n</th>
            <th>Nombre</th>
            <th>D&iacute;a</th>
            <th>Horas</th>
            <th>Sede</th>
            <th>Aula</th>
            <th>Grupo</th>
            <th>Tipo</th>
            <?php echo ($_SESSION['isAdmin']==1)?"<th></th>":""; ?>


        </tr>
    </thead>
    <tbody>
        <?php
                        

                        for ($i=0; $i < count($cursos); $i++) {
                            echo '<tr >';

                            echo '<td style="background-color:'.$colores[$i].'">';
                            echo '';
                            echo '</td>';
                            echo '<td>';
                            echo $codigos[$i];
                            echo '</td>';
                            echo '<td>';
                            echo $secciones[$i];
                            echo '</td>';
                            echo '<td>';
                            echo $cursos[$i];
                            echo '</td>';
                            echo '<td>';
                            echo $dias[$i];
                            echo '</td>';
                            echo '<td>';
                            echo $horas_inicio[$i].'-'.$horas_fin[$i];
                            echo '</td>';
                            echo '<td>';
                            echo $sedes[$i];
                            echo '</td>';
                            echo '<td>';
                            echo $aulas[$i];
                            echo '</td>';
                            echo '<td>';
                            echo $grupos[$i];
                            echo '</td>';
                            echo '<td>';
                            echo $sesiones[$i];
                            echo '</td>';
                            if ($_SESSION['isAdmin']==1) {
                                echo '<td>';
                                echo '<button type="button" class="btn btn-warning" onclick="'."asignarEliminar('".$codigos[$i]."','".$secciones[$i]."','".$dias[$i]."','".
                                    $horas_inicio[$i]."','".$horas_fin[$i]."','".$sedes[$i]."','".$aulas[$i]."','".$grupos[$i]."','".
                                    $sesiones[$i]."')"
                                    .'">Eliminar</button>';
                                echo '</td>';
                            }
                                
                            echo '</tr>';
                        } ?>
    </tbody>
</table>
<input type="checkbox" id="btn-modal">
    
    <div class="modal-propio">
        <div class="contenedor-modal">
            <div class="d-flex justify-content-between align-middle align-items-center">
                <h4 class="d-inline-block p-4" id="titulo-modal">&iquest;Est&aacute; seguro que quiere eliminar el curso&#63;</h4>

                <label class="d-inline-block p-2 " for="btn-modal"><i class="fa fa-times" id="salir-modal"></i></label>
            </div>
            <hr class="p-4">
            <div class="contenido-modal p-4">
                <label class="btn btn-dark text-light" onclick="hola()" id="btn-aceptar">Aceptar</label>
                <label class="btn btn-light text-light bg-secondary" for="btn-modal">Cancelar</label>
            </div>
        </div>
    </div>
</div>
<?php
if ($ciclo=="2020-2") {
VerificarDisponibilidadPropuesto($pos_generadas, $pdo, $cursos_generados, $iddocente, $sedes_generadas, $colores_generados);
}
                
            } else {
                echo '<div class"col-md-12 mx-auto text-center">
                <h5 class="text-danger text-center mx-auto mb-5">No existen cursos propuestos</h5>
                </div>';
            } ?>




<?php
}

?>