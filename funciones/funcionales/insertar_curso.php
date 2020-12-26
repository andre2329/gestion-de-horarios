<?php
require_once __DIR__.'/../../utils/conexion_db.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $codCurso = $_POST['codCurso'];
    $nombre = $_POST['nombre'];
    $h_practica = $_POST['h_practica'];
    $h_teoria = $_POST['h_teoria'];
    $grupos_laboratorio = $_POST['grupos_laboratorio'];
    $ciclo = $_POST['ciclo'];
    $activo = $_POST['activo'];
    $carrera = $_POST['carrera'];
    $creditos = $_POST['creditos'];

    switch ($_POST['option']) {
        case 'nuevo':
            $sql =" SELECT * FROM cursos where codcurso=:codcurso";
            $error = false;
            try {
                $stmt=$pdo->prepare($sql);
                $stmt->execute(array(
                                ':codcurso'=>$codCurso
                ));
            } catch (Exception $ex) {
                $error = true;
                echo $ex;
            }

            if ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //var_dump($fila);
                echo '<div class=" col-md-8 mx-auto mt-5 alert alert-danger" role="alert">Curso asociado al código : '.$fila['nombre'].'</div>';
                echo '<script>alert("El codigo del curso ya existe")</script>';
            } else {
                $sql =" INSERT INTO `cursos`(`codCurso`, `nombre`, `ciclo`, `horasTeoria`, `horasLaboratorio`, `grupos`, `carrera`, `creditos`, `activo`, `uActualizacion`) 
                VALUES (:codcurso, :nombre, :ciclo, :teoria, :laboratorio, :grupos, :carrera, :creditos, :activo, CURRENT_TIMESTAMP)";
   
                
                try {
                    $stmt=$pdo->prepare($sql);
                    $stmt->execute(array(
                                   ':codcurso'=>$codCurso,
                                   ':nombre'=>$nombre,
                                   ':ciclo'=>$ciclo,
                                   ':teoria'=>$h_teoria,
                                   ':laboratorio'=>$h_practica,
                                   ':grupos'=>$grupos_laboratorio,
                                   ':carrera'=>$carrera,
                                   ':creditos'=>$creditos,
                                   ':activo'=>$activo
                   ));
                } catch (Exception $ex) {
                    $error = true;
                    //echo $ex;
                }
                if ($error) {
                    echo '<div class=" col-md-8 mx-auto mt-5 alert alert-danger" role="alert">Error : '.$ex.'</div>';
                    echo '<script>alert("Ha ocurrido un error")</script>';
                } else {
                    echo '<div class=" col-md-8 mx-auto mt-5 alert alert-success" role="alert">Se ingres&oacute; satisfactoriamente el curso </div>'; ?>
                        <script type="text/javascript">
                        $('#resultado').html("");
                        </script>
                        <div class="col-md-12 text-center mt-5 pb-5 mx-auto">
                            <button type="button" class="btn btn-dark" onclick="clickMalla('nuevo')">Editar nuevo curso</button>
                        </div>
<?php
                }
            }

        break;
        case 'actualizar':
            
                        $sql =" UPDATE `cursos` SET  nombre=:nombre, ciclo=:ciclo, horasTeoria=:teoria, horasLaboratorio=:laboratorio, grupos=:grupos,
                         carrera=:carrera, creditos=:creditos, activo=:activo, uactualizacion=CURRENT_TIMESTAMP WHERE codcurso=:codcurso";
           
                        try {
                            $stmt=$pdo->prepare($sql);
                            $stmt->execute(array(
                                           ':codcurso'=>$codCurso,
                                           ':nombre'=>$nombre,
                                           ':ciclo'=>$ciclo,
                                           ':teoria'=>$h_teoria,
                                           ':laboratorio'=>$h_practica,
                                           ':grupos'=>$grupos_laboratorio,
                                           ':carrera'=>$carrera,
                                           ':creditos'=>$creditos,
                                           ':activo'=>$activo
                           ));
                        } catch (Exception $ex) {
                            $error = true;
                            echo $ex;
                        }
                        if (isset($error)) {
                            echo '<div class=" col-md-8 mx-auto mt-5 alert alert-danger" role="alert">Ha ocurrido un erro: '.$ex.'</div>';
                            echo '<script>alert("Ha ocurrido un error")</script>';
                        } else {
                            echo '<div class=" col-md-8 mx-auto mt-5  alert alert-success" role="alert">Se actualiz&oacute; satisfactoriamente el curso </div>'; ?>
                        <script type="text/javascript">
                        $('#resultado').html("");
                        </script>
                        <div class="col-md-12 text-center mt-5 pb-5 mx-auto">
                        <button type="button" class="btn btn-dark" onclick="clickMalla('editar')">Editar nuevo curso</button>
                        </div>
                        <?php
                        }
                    
                

                    



            break;
    }

    require_once './../../api/updateCursosFB.php';
    updateCursosFB();

}





?>