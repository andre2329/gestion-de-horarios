<?php

require_once __DIR__.'/../../utils/conexion_db.php';
function VerificarHorasMax($total_horas,$pdo)
{
    $sql = "SELECT horasMax,horasMin from docentes where iddocente=:iddocente";
    
    try{
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
            ':iddocente'=>$_SESSION['iddocente']
        ));
    }catch(Exception $ex){
        echo "Ha ocurrido un error al obtener los datos ".$ex;
    }
    
        if($fila = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                    $horas_max =  $fila['horasMax'];
                    $horas_min =  $fila['horasMin'];
                    if($total_horas>$horas_max){
                        echo "<div class='text-danger text-center'></div>";
                        echo "<div class='col-md-8 mx-auto alert alert-danger' role='alert'>
                        <strong>&#161;Alerta&#33;</strong>";
                        echo ($_SESSION["isAdmin"]==1)?"El docente excede las horas m&acute;ximas</div>":"Usted excede las horas m&aacute;ximas, comun&iacute;quese con su administrador</div>";
                    }elseif ($total_horas<$horas_min) 
                    {
                        
                    echo "<div class='col-md-8 mx-auto alert alert-danger text-center' role='alert'>
                    <strong>&#161;Alerta&#33;</strong> ";
                    echo ($_SESSION["isAdmin"]==1)?"El docente no cumple con las horas m&iacute;nimas</div>":"Usted no cumple con las horas m&iacutenimas, comun&iacute;quese con su administrador</div>";
                    }
            }
    
    }
    
    function VerificarDisponibilidadPropuesto($pos_generadas,$pdo,$cursos_generados,$iddocente,$sedes_generadas,$colores_generados){
        
        $sql = "SELECT diaHora,campus from disponibilidad where iddocente=:iddocente";
    
        try{
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
                ':iddocente'=>$iddocente
            ));
        }catch(Exception $ex){
            echo "Ha ocurrido un error al obtener los datos ".$ex;
        }
        $output = array();
        $sedes_salida = array();
        $pos_salida = array();
            if($fila = $stmt->fetchAll(PDO::FETCH_ASSOC))
                {
                    
                    $dias_sem = array( 0=>"LUNES",1=>"MARTES",2=>"MI&Eacute;RCOLES",3=>"JUEVES",4=>"VIERNES",5=>"S&Aacute;BADO");
                    
                    
                    foreach($fila as $esp){
                        $hora_dia = $esp['hora_dia'];
                        $sede = $esp['campus'];
                        list($hora,$dia) =  explode('-',$hora_dia);
                        if(in_array($hora_dia,$pos_generadas)){
                            $pos_salida[] = $hora_dia;
                            $pos = array_search($hora_dia,$pos_generadas);
                            if($sede!=$sedes_generadas[$pos]  && $sede!="TODOS" ){
                                if($sedes_generadas[$pos] =="MO" || $sedes_generadas[$pos] =="SM" && $sede == "MO-SM"){
    
                                }else{
                                    $sedes_salida[] = $sede;
                                    
                                    $output[] =  "<tr>".
                                    '<td style="background-color:'.$colores_generados[$pos].'">'.''.'</td>'.
                                    '<td>'.$cursos_generados[$pos].'</td>'.
                                    '<td>'.$dias_sem[$dia].'</td>'.
                                    '<td>'.$hora.':00:00 - '.($hora+1).':00:00 '.'</td>'.
                                    '<td>'.$sedes_generadas[$pos].'</td>'.
                                    '<td>'.$sede.'</td>'.
                                "</tr>";
                                }
                                
                            }
                            
                        }
                    }
                    $pos = 0;
                    foreach($pos_generadas as $new){
                        if(!in_array($new,$pos_salida)){
                            list($hora,$dia) =  explode('-',$new);
                            $output[] =  "<tr>".
                            '<td style="background-color:'.$colores_generados[$pos].'">'.''.'</td>'.
                            '<td>'.$cursos_generados[$pos].'</td>'.
                            '<td>'.$dias_sem[$dia].'</td>'.
                            '<td>'.$hora.':00:00 - '.($hora+1).':00:00 '.'</td>'.
                            '<td>'.$sedes_generadas[$pos].'</td>'.
                            '<td>No disponible</td>'.
                        "</tr>";
                        }
                        $pos++;
                    }
    
                    if(count($output)!=0){
                echo "<div class='col-md-12 mx-0 text-center'><div class='col-md-10 mx-auto alert alert-danger text center' role='alert'>
                    <strong>&#161;Alerta&#33;</strong>";
                echo ($_SESSION["isAdmin"]==1)?" Existen cursos en sedes no disponibles para el docente. ":" Existen cursos en sedes no disponibles para usted, comun&iacute;quese con su administrador.";
                        ?>
                
                <h5>Horarios en conflicto</h5>
                
                    <table class="table table-bordered">
                        <thead class="thead-dark" >
                            <tr>
                                <th>Color</th>
                                <th>Curso</th>
                                <th>D&iacute;a</th>
                                <th>Horario</th>
                                <th>Sede propuesta</th>
                                <th>Sede disponible</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($output as $out){
                                echo $out; 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                </div>
                    <?php
                    }
                    
                        
                }
    }

?>