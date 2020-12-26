<?php
require_once '../funciones/obtenerPHP.php';
session_start();
if ($_SERVER['REQUEST_METHOD']=="POST") {
    if ($_SESSION['isAdmin']==1){
        if (isset($_POST['data'])) {
            $_SESSION["iddocenteInsertar"]=$_POST['data'];
        }
    }
}
if (isset($_SESSION['id'])) {
    if ($_SESSION['isAdmin']==1) {
        $iddocente = $_SESSION["iddocenteInsertar"];
    } else {
        $titulo2 = "DISPONIBILIDAD HORARIA";
        $iddocente = $_SESSION["iddocente"];
    }
    //echo $iddocente;
    $resultado = obtenerDisponibilidad($iddocente);
    $posiciones = array();
    $campus = array();
    if($resultado!=0){
        foreach ($resultado as $esp) {
            $camp = $esp['campus'];
            $pos = $esp['diaHora'];
            $posiciones[] = $pos;
            $campus[] = $camp;
        }
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

        //var_dump($posiciones);
        if (in_array($dos_horas_despues.'-'.$dia, $posiciones)) {
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




<div class="center pl-2 pt-5 mx-auto col-md-12" id="dispHorarios">
    <div class="container marketing ">

        <h2 class=" text-center"><?php echo (isset($titulo2))?$titulo2:''; ?></h2>

        <!---action="../src/php/utils/grabarHorarioD.php" method="GET">-->



        <div class="">

            <form id="grabaHorario" method="POST">
                <table class="table w-auto table-sm mx-auto table-responsive-sm small">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Horario</th>
                            <th scope="col">Lunes</th>
                            <th scope="col">Martes</th>
                            <th scope="col">Mi&eacute;rcoles</th>
                            <th scope="col">Jueves</th>
                            <th scope="col">Viernes</th>
                            <th scope="col">S&aacute;bado</th>
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
        echo "<th class=' align-bottom' scope='row'>"."<p class=' align-middle'>".$ini.'<br>'.$fin."</p>"."</th>";

        for ($j=0;$j<7;$j++) {
            if ($j<6) {
                $n = ($j).'-'.($i+7);
                if ($j==4 && ($i==6 || $i==7)) {
                    echo "<td class=' align-middle'>NO DISPONIBLE</td>";
                } else {
                    $op1="";
                    $op2="";
                    $op3="";
                    $op4="";
                    $op5="";
                    if (in_array($n, $posiciones)) {
                        $key = array_search($n, $posiciones);
                        switch ($campus[$key]) {
                                                case "MO":
                                                    $op1="selected='selected'";
                                                    break;
                                                case "SM":
                                                    $op2="selected='selected'";
                                                    break;
                                                case "MO-SM":
                                                    $op3="selected='selected'";
                                                    break;
                                                case "VL":
                                                    $op4="selected='selected'";
                                                    break;
                                                case "TODOS":
                                                    $op5="selected='selected'";
                                                    break;
                                            }
                    }
                                        
                    echo "<td class=' align-middle'><select class = 'form-control form-control-sm ' name = '".$n.
                                        "'>".
                                        '<option value = "NO">NO DISPONIBLE</option>'.
                                        '<option '.$op1.'  value = "MO">MO</option>'.
                                        '<option '.$op2.'  value = "SM">SM</option>'.
                                        '<option '.$op3.'  value = "MO-SM">MO-SM</option>'.
                                        '<option '.$op4.'  value = "VL">VL</option>'.
                                        '<option '.$op5.'  value = "TODOS">TODOS</option> </td>';
                }
            } else {
                echo "<td class=' align-middle'>
                                    <div class=' align-middle'>NO DISPONIBLE</div>
                                    </td>";
            }
        }
        echo "</tr>";
    } ?>


                    </tbody>


                </table>
                <div class=" mt-5 col-md-12 mx-auto">

                    <?php
                    //var_dump($output);
                if (count($output)!=0) {
                    echo "<div class='col-md-12 px-0 mx-0 text-center'><div class=' mt-5 col-md-12 mx-auto alert alert-warning text center' role='alert'>
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

        <div class="text-center">

                <!-- MODAL-->
            <input type="checkbox" id="btn-modal">
            <label for="btn-modal" class="btn btn-dark btn-modal">
                Guardar
            </label>

            <div class="modal-propio">
                <div class="contenedor-modal">
                    <div class="d-flex justify-content-between align-middle align-items-center">
                        <h4 class="d-inline-block p-4" id="titulo-modal">&iquest;Est&aacute; seguro que quiere grabar este
                            horario&#63;</h4>

                        <label class="d-inline-block p-2 " for="btn-modal"><i class="fa fa-times"
                                id="salir-modal"></i></label>
                    </div>
                    <hr class="p-4">
                    <div class="contenido-modal p-4">
                        <label class="btn btn-dark text-light" onclick="grabarDisponibilidad()">Aceptar</label>
                        <label class="btn btn-light text-light bg-secondary" for="btn-modal">Cancelar</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 d-flex justify-content-between text-muted small border border-secondary">
            <h6>MO:CAMPUS MONTERRICO</h6>
            <h6>SM:CAMPUS SAN MIGUEL</h6>
            <h6>VL:CAMPUS VILLA</h6>
            <h6>MO-SM:CAMPUS MONTERRICO O SAN MIGUEL</h6>
            <h6>TODOS:TODOS LOS CAMPUS</h6>

        </div>
        
    </div>
</div>

<?php
} else {
                }

?>