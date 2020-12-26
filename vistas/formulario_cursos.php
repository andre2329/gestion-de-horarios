<?php
require_once __DIR__.'/../utils/conexion_db.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    // var_dump($_POST);
    $titulo = "";
    $codCurso = $_POST['codCurso'];
                      
    $sql = "Select * from cursos where codcurso=:codCurso";
                      
    try {
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
                ':codCurso'=>$codCurso
            ));
    } catch (Exception $ex) {
        echo "Ha ocurrido un error al obtener los datos ".$ex;
    }
                
    if ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $codCurso = $fila['codCurso'];
        $nombre = $fila['nombre'];
        $ciclo = $fila['ciclo'];
        $teoria = $fila['horasTeoria'];
        $laboratorio = $fila['horasLaboratorio'];
        $grupos = $fila['grupos'];
        $carrera = $fila['carrera'];
        $creditos = $fila['creditos'];
        $activo = $fila['activo'];
    }
} else {
    $titulo = "Ingresar un nuevo Curso";
}

?>

<form class="col-md-12 mx-auto mt-5" id="datosCurso">
    <h2 class=" text-center"><?php echo $titulo ?></h2>
    <div>
        <table class="text-center mx-auto">
            <tbody>
                <tr>
                    <td>C&oacute;digo</td>
                    <td colspan="4">Nombre</td>
                </tr>
                <tr>
                    <td><input class="form-control" type="text"
                            <?php echo (isset($codCurso))?'value="'.$codCurso.'" readonly':'' ?> name="codCurso"
                            id="codCurso"></td>
                    <td colspan="5"><input class="form-control" <?php echo (isset($nombre))?'value="'.$nombre.'"':'' ?>
                            type="text" name="nombre" id="nombre"></td>
                </tr>

                <tr>

                    <td>Horas teor&iacute;a</td>
                    <td>Horas laboratorio</td>
                    <td>Grupos laboratorio</td>
                    <td>Ciclo</td>
                    <td colspan="2">Activo</td>
                </tr>
                <tr>
                    <td><input class="form-control" type="number"
                            <?php echo (isset($teoria))?'value="'.$teoria.'"':'' ?> name="h_teoria" id="h_teoria"></td>
                    <td><input class="form-control" type="number"
                            <?php echo (isset($laboratorio))?'value="'.$laboratorio.'"':'' ?> name="h_practica"
                            id="h_practica"></td>
                    <td><input class="form-control" type="number"
                            <?php echo (isset($grupos))?'value="'.$grupos.'"':'' ?> name="grupos_laboratorio"
                            id="grupos_laboratorio"></td>
                    <td>
                        <select class="form-control" name="ciclo" id="ciclo">

                            <?php
                        $opt1 = "";
                        $opt2 = "";
                        $opt3 = "";
                        $opt4 = "";
                        $opt5 = "";
                        $opt6 = "";
                        $opt7 = "";
                        $opt8 = "";
                        $opt9 = "";
                        $opt10 = "";

                            if (isset($ciclo)) {
                                switch ($ciclo) {
                                    case '1':
                                        $opt1 = "selected";
                                        break;
                                    case '2':
                                        $opt2 = "selected";
                                        break;
                                    case '3':
                                        $opt3 = "selected";
                                        break;
                                    case '4':
                                        $opt4 = "selected";
                                        break;
                                    case '5':
                                        $opt5 = "selected";
                                        break;
                                    case '6':
                                        $opt6 = "selected";
                                        break;
                                    case '7':
                                        $opt7 = "selected";
                                        break;
                                    case '8':
                                        $opt8 = "selected";
                                        break;
                                    case '9':
                                        $opt9 = "selected";
                                        break;
                                    case '10':
                                        $opt10 = "selected";
                                        break;

                                }
                            }

                        ?>
                            <option value="" hidden></option>
                            <option <?php echo $opt1 ?> value="1">1</option>
                            <option <?php echo $opt2 ?> value="2">2</option>
                            <option <?php echo $opt3 ?> value="3">3</option>
                            <option <?php echo $opt4 ?> value="4">4</option>
                            <option <?php echo $opt5 ?> value="5">5</option>
                            <option <?php echo $opt6 ?> value="6">6</option>
                            <option <?php echo $opt7 ?> value="7">7</option>
                            <option <?php echo $opt8 ?> value="8">8</option>
                            <option <?php echo $opt9 ?> value="9">9</option>
                            <option <?php echo $opt10 ?> value="10">10</option>
                        </select>
                    </td>
                    <td>
                        <?php
                            $opta1 = "checked";
                            $opta2 = "";
                            
                            if (isset($activo)) {
                                switch ($activo) {
                                    case 1:
                                        $opta1 = "checked";
                                        $opta2 = "";
                                        break;
                                    
                                    case 0:
                                        $opta1 = "";
                                        $opta2 = "checked";
                                        break;
                                }
                            }
                    ?>
                        <div class="col-md-10 mx-auto form-inline text-center">
                            <label class="form-check-label" for="exampleRadios1">Si</label>
                            <input class="form-check-input" type="radio" name="activo" id="exampleRadios1" value="1"
                                <?php echo $opta1?>>
                        </div>
                    </td>
                    <td>
                        <div class="col-md-10 mx-auto form-inline text-center">
                            <label class="form-check-label" for="exampleRadios2">No</label>
                            <input class="form-check-input" type="radio" name="activo" id="exampleRadios2" value="0"
                                <?php echo $opta2?>>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="4">Carrera</td>
                    <td colspan="2">Cr&eacute;ditos</td>
                </tr>
                <tr>
                    <?php
                    $optc1 = "";
                    $optc2 = "";
                    $optc3 = "";
                    if (isset($carrera)) {
                        switch ($carrera) {
                            case 'ELEC':
                                $optc1 = "selected";
                                break;
                            case 'MECA':
                                $optc2 = "selected";
                                break;
                            case 'INDU':
                                $optc3 = "selected";
                                break;
                        }
                    }
                ?>
                    <td colspan="4"><select class="form-control" name="carrera" id="carrera">
                            <option value="" hidden></option>
                            <option value="ELEC" <?php echo $optc1?>>Ingenier&iacute;a Electr&oacute;nica</option>
                            <option value="MECA" <?php echo $optc2?>>Ingenier&iacute;a Mecatr&oacute;nica</option>
                            <option value="INDU" <?php echo $optc3?>>Ingenier&iacute;a Industrial</option>
                        </select></td>
                    <td colspan="2"><input class="form-control" type="number" name="creditos" id="creditos"
                            value="<?php ;echo isset($creditos)?$creditos:''?>"></td>
                </tr>
            </tbody>

        </table>

    </div>

</form>

<!-- Button trigger modal -->
<div class="col-md-12 text-center mt-5 mx-auto">
    <?php
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            $nombreButton = "Guardar";
            $mensaje = "&iquest;Est&aacute; seguro que quiere modificar este curso&#63;";
            $argumento = "'actualizar'";
        } else {
            $nombreButton = "Registrar";
            $mensaje = "&iquest;Est&aacute; seguro que quiere registrar este curso&#63;";
            $argumento = "'nuevo'";
        }
    ?>
    <input type="checkbox" id="btn-modal">
    <label for="btn-modal" class="btn btn-dark btn-modal mb-2">
    <?php echo $nombreButton?>
    </label>
    
    <div class="modal-propio">
        <div class="contenedor-modal">
            <div class="d-flex justify-content-between align-middle align-items-center">
                <h4 class="d-inline-block p-4" id="titulo-modal"><?php echo $mensaje?></h4>

                <label class="d-inline-block p-2 " for="btn-modal"><i class="fa fa-times" id="salir-modal"></i></label>
            </div>
            <hr class="p-4">
            <div class="contenido-modal p-4">
                <label class="btn btn-dark text-light" onclick="grabarCurso(<?php echo $argumento?>)">Aceptar</label>
                <label class="btn btn-light text-light bg-secondary" for="btn-modal">Cancelar</label>
            </div>
        </div>
    </div>
</div>



