<?php
require_once __DIR__.'/../utils/conexion_db.php';
session_start();

if (isset($_SESSION['iddocente'])) {
    if ($_SESSION['isAdmin']==1) {
        $iddocente = $_POST['data'];
    } else {
        $titulo2 = "DISPONIBILIDAD HORARIA";
        $iddocente = $_SESSION["iddocente"];
    }
    //var_dump($iddocente);
    $sql = "SELECT *
    from disponibilidad 
    where iddocente = :iddocente";

    try {
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
                        ':iddocente'=>$iddocente
        ));
    } catch (Exception $ex) {
        echo "Ha ocurrido un error al obtener los datos ".$ex;
    }
    $posiciones = array();
    $campus = array();
    if ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        //var_dump($fila);
        foreach ($fila as $esp) {
            $camp = $esp['campus'];
            $pos = $esp['diaHora'];
            $posiciones[] = $pos;
            $campus[] = $camp;
        }
    } else {
    }
    $i=0;
    $output=array();
    $dias_sem = array( 0=>"LUNES",1=>"MARTES",2=>"MI&Eacute;RCOLES",3=>"JUEVES",4=>"VIERNES",5=>"S&Aacute;BADO");
             
   
    foreach ($posiciones as $posi) {
        $auxiliar = false;
        list($dia,$hora) = explode("-", $posi);
        $una_hora_despues = $hora + 1;
        $dos_horas_despues = $hora + 2;
        $sede_actual = $campus[$i];
        if (in_array($dia.'-'.$una_hora_despues, $posiciones)) {
            $ind=array_search($dia.'-'.$una_hora_despues, $posiciones);
            $sede_sig = $campus[$ind];
            if ($sede_sig != $sede_actual) {
                $output[] =  "<tr>".
                                '<td>'.$dias_sem[$dia].'</td>'.
                                
                                '<td>'.$sede_actual.'</td>'.
                                '<td>'.$sede_sig.'</td>'.
                                '<td>'.$hora.':00:00 </td>'.'<td>'.($hora+1).':00:00 '.'</td>'.
                            "</tr>";
            }
        }

        if (in_array($dia.'-'.$dos_horas_despues, $posiciones)) {
            $ind=array_search($dia.'-'.$dos_horas_despues, $posiciones);
            $sede_sig = $campus[$ind];
            if ($sede_sig != $sede_actual) {
                $output[] = "<tr>".
                                '<td>'.$dias_sem[$dia].'</td>'.
                                
                                '<td>'.$sede_actual.'</td>'.
                                '<td>'.$sede_sig.'</td>'.
                                '<td>'.$hora.':00:00 </td>'.'<td>'.($hora+2).':00:00 '.'</td>'.
                            "</tr>";
            }
        }

        $i++;
    }
    

    //var_dump($_SESSION);
    //var_dump($_POST); ?>




<div class="center mt-5" id="dispHorarios">
    <div class="container marketing px-0">

        <h2 class=" text-center"><?php echo (isset($titulo2))?$titulo2:''; ?></h2>

        <!---action="../src/php/utils/grabarHorarioD.php" method="GET">-->



        <div class="">

            <form id="grabaHorario" method="POST">
                <table class="text-center col-md-10 mx-auto small table-bordered">
                    <thead class="bg-dark text-light">
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
        echo "<th class=' align-bottom  bg-dark text-light' scope='row'>".$ini.'<br>'.$fin."</th>";

        for ($j=0;$j<7;$j++) {
            if ($j<6) {
                $n = ($j).'-'.($i+7);
                if ($j==4 && ($i==6 || $i==7)) {
                    echo "<td class=' align-middle bg-warning'></td>";
                } else {
                    if (in_array($n, $posiciones)) {
                        $key = array_search($n, $posiciones);
                        echo "<td class=' align-middle bg-success'>".$campus[$key].'</td>';
                    } else {
                        echo "<td class=' bg-info align-middle'>
                                            </td>";
                    }
                }
            } else {
                echo "<td class=' align-middle bg-warning'>
                                    </td>";
            }
        }
        echo "</tr>";
    } ?>


                    </tbody>


                </table>
                <div class=" mt-5 col-md-12 mx-auto">

                    <?php
                if (count($output)!=0) {
                    echo "<div class='col-md-12 mx-0 text-center'><div class=' mt-5 col-md-12 mx-auto alert alert-warning text center' role='alert'>
                <strong>&#161;Advertencia&#33;</strong>"." La diferencia m&iacute;nima entre sedes es de 2 horas"; ?>
                    <h5 class="text-center">Horario conflicto</h5>

                    <table class="table table-bordered">

                        <thead class="thead-dark">
                            <tr>
                                <th>D&iacute;a</th>
                                <th>Campus anterior</th>
                                <th>Campus siguiente</th>
                                <th>Hora inicio anterior</th>
                                <th>Hora inicio siguiente</th>

                            </tr>


                        </thead>
                        <tbody>
                            <?php
                            
                    foreach ($output as $out) {
                        echo $out;
                    }
                } ?>
                        </tbody>
                    </table>
                </div>

        </div>

        </form>

        <div class="mt-5 d-flex justify-content-between text-muted small border border-secondary">
            <h6>MO:CAMPUS MONTERRICO</h6>
            <h6>SM:CAMPUS SAN MIGUEL</h6>
            <h6>VL:CAMPUS VILLA</h6>
            <h6>MO-SM:CAMPUS MONTERRICO O SAN MIGUEL</h6>
            <h6>TODOS:TODOS LOS CAMPUS</h6>

        </div>
        <div class="modal fade" id="avisoGuardar" tabindex="-1" role="dialog" aria-labelledby="avisoGuardarLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="avisoGuardarLabel">&iquest;Est&aacute; seguro que quiere grabar este
                            horario&#63;</h5>
                        <button id="avisoGuardarClose" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Esta acci&oacute;n no se puede revertir
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick=grabarDisponibilidad()
                            data-dismiss="modal">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
} else {
                }

?>