<?php
require_once '../../funciones/obtenerPHP.php';
    session_start();
    if ($_SESSION['isAdmin']==1) {
        $error = false;
                    
        
        
        $resultado = obtenerDatosDocente($_POST['editarDocente']);
        //var_dump($resultado);
        if ($resultado) {
            //var_dump($fila);
            $codigo = $resultado['idDocente'];
            $nombres = $resultado['name'];
            $apellidop = $resultado['apellidoP'];
            $apellidom = $resultado['apellidoM'];
            $correo = $resultado['correo'];
            $direccion = $resultado['carrera'];
            $contrato = $resultado['contrato'];
            $habilitado = $resultado['habilitado'];
            $maxhoras = $resultado['horasMax'];
            $minhoras = $resultado['horasMin'];
            $admin = $resultado['isAdmin'];
        }


    }
?>

<div class="mt-5">
    <form class="ml-5 text-center  h-100 justify-content-center align-items-center" id="actualizaDocente">
        <div class=" ml-5 justify-content-md-center ">
            <div class=" form-group row text-center ">
                <label for="codigo" class="col-sm-2 col-form-label">C&oacute;digo:</label>
                <div class="col-2">
                    <input maxlength=4 type="text" class="form-control" id="codigo" name="codigo"
                        placeholder="4 d&iacute;gitos" value="<?php echo (isset($codigo))?$codigo:'';?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="nombres" class="col-sm-2 col-form-label">Nombres:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nombres" name="nombres"
                        placeholder="Ingrese los nombres" value="<?php echo (isset($nombres))?$nombres:'';?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="apellidop" class="col-sm-2 col-form-label">Apellido paterno:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="apellidop" name="apellidop"
                        placeholder="Ingrese el apellido paterno"
                        value="<?php echo (isset($apellidop))?$apellidop:'';?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="apellidom" class="col-sm-2 col-form-label">Apellido materno:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="apellidom" name="apellidom"
                        placeholder="Ingrese el apellido materno"
                        value="<?php echo (isset($apellidom))?$apellidom:'';?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="correo" class="col-sm-2 col-form-label">Correo electr&oacute;nico:</label>
                <div class="col-md-6">
                    <input type="correo" class="form-control" id="correo" name="correo"
                        disabled=true placeholder="Ingrese el correo electr&oacute;nico"
                        value="<?php echo (isset($correo))?$correo:'';?>">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="direccion" class="col-sm-2 col-form-label">Direcci&oacute;n:</label>
                <div class="col-md-6">
                    <select name="direccion" id="direccion" class="form-control">
                        <?php

                    $isVacio = false;
                    $isElec = false;
                    $isMeca = false;
                    $isCiencias = false;
                    $isIndu = false;
                    if (isset($direccion)) {
                        switch ($direccion) {
                            case '':
                                $isVacio = true;
                                break;
                            case 'elec':
                                $isElec = true;
                                break;
                            case 'meca':
                                $isMeca = true;
                                break;
                            case 'ciencias':
                                $isCiencias = true;
                                break;
                            case 'indu':
                                $isIndu = true;
                                break;
                        }
                    }
                    ?>
                        <option value="" <?php echo ($isVacio)?'selected':'';?> hidden>...</option>
                        <option value="elec" <?php echo ($isElec)?'selected':'';?>>Ing. Electr&oacute;nica</option>
                        <option value="meca" <?php echo ($isMeca)?'selected':'';?>>Ing. Mecatr&oacute;nica</option>
                        <option value="indu" <?php echo ($isIndu)?'selected':'';?>>Ing. Industrial</option>
                        <option value="ciencias" <?php echo ($isCiencias)?'selected':'';?>>Ciencias</option>
                        
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="contrato" class="col-sm-2 col-form-label">Contrato:</label>
                <div class="col-md-6">
                    <select name="contrato" id="contrato" class="form-control">
                        <?php

                $isVacio = false;
                $staff = false;
                $contratado = false;
                $dictante = false;
                $parcial = false;
                $investigador = false;
                if (isset($contrato)) {
                    switch ($contrato) {
                        case '':
                            $isVacio = true;
                            break;
                        case 'staff':
                            $staff = true;
                            break;
                        case 'contratado':
                            $contratado = true;
                            break;
                        case 'dictante':
                            $dictante = true;
                            break;
                        case 'parcial':
                            $parcial = true;
                            break;
                        case 'investigador':
                            $investigador = true;
                            break;
                    }
                }
                ?>

                        <option value="" <?php echo ($isVacio)?'selected':'';?> hidden>...</option>
                        <option value="staff" <?php echo ($staff)?'selected':'';?>>Staff</option>
                        <option value="contratado" <?php echo ($contratado)?'selected':'';?>>Contratado</option>
                        <option value="dictante" <?php echo ($dictante)?'selected':'';?>>Dictante</option>
                        <option value="parcial" <?php echo ($parcial)?'selected':'';?>>Parcial</option>
                        <option value="investigador" <?php echo ($investigador)?'selected':'';?>>Investigador</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="habilitado" class="col-sm-2 col-form-label">Habilitado:</label>
                <div class="col-md-6">
                    <select name="habilitado" id="habilitado" class="form-control" required>
                        <?php

                        $isVacio = false;
                        $SI = false;
                        $NO = false;
                        if (isset($habilitado)) {
                            switch ($habilitado) {
                                case '':
                                    $isVacio = true;
                                    break;
                                case 1:
                                    $SI = true;
                                    break;
                                case 0:
                                    $NO = true;
                                    break;
                            }
                        }
                ?>
                        <option value="" <?php echo ($isVacio)?'selected':'';?> hidden>...</option>
                        <option value="1" <?php echo ($SI)?'selected':'';?>>SI</option>
                        <option value="0" <?php echo ($NO)?'selected':'';?>>NO</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="admin" class="col-sm-2 col-form-label">Admin:</label>
                <div class="col-md-6">
                    <select name="admin" id="admin" class="form-control" required>
                        <?php

                        $isVacio = false;
                        $SI = false;
                        $NO = false;
                        if (isset($admin)) {
                            switch ($admin) {
                                case '':
                                    $isVacio = true;
                                    break;
                                case 1:
                                    $SI = true;
                                    break;
                                case 0:
                                    $NO = true;
                                    break;
                            }
                        }
                ?>
                        <option value="" <?php echo ($isVacio)?'selected':'';?> hidden>...</option>
                        <option value="1" <?php echo ($SI)?'selected':'';?>>SI</option>
                        <option value="0" <?php echo ($NO)?'selected':'';?>>NO</option>
                    </select>
                </div>
            </div>
            <div class=" form-group row text-center ">
                <label for="maxhoras" class="col-sm-2 col-form-label">M&aacute;ximo de horas:</label>
                <div class="col-2">
                    <input maxlength=2 type="text" class="form-control" id="maxhoras" name="maxhoras"
                        value="<?php echo (isset($maxhoras))?$maxhoras:'';?>">
                </div>
            </div>
            <div class=" form-group row text-center ">
                <label for="minhoras" class="col-sm-2 col-form-label">M&iacute;nimo de horas:</label>
                <div class="col-2">
                    <input maxlength=2 type="text" class="form-control" id="minhoras" name="minhoras"
                        value="<?php echo (isset($minhoras))?$minhoras:'';?>">
                </div>
            </div>
        </div>
    </form>
    <script>
    </script>
    <div class="text-center mb-5">
        <input type="checkbox" id="btn-modal">
            <label for="btn-modal" class="btn btn-dark btn-modal">
                Guardar
            </label>

            <div class="modal-propio">
                <div class="contenedor-modal">
                    <div class="d-flex justify-content-between align-middle align-items-center">
                        <h4 class="d-inline-block p-4" id="titulo-modal">&iquest;Est&aacute; seguro que quiere grabar este
                            estos datos&#63;</h4>

                        <label class="d-inline-block p-2 " for="btn-modal"><i class="fa fa-times"
                                id="salir-modal"></i></label>
                    </div>
                    <hr class="p-4">
                    <div class="contenido-modal p-4">
                        <label class="btn btn-dark text-light" onclick="actualizarDocente()">Aceptar</label>
                        <label class="btn btn-light text-light bg-secondary" for="btn-modal">Cancelar</label>
                    </div>
                </div>
            </div>
    </div>
    

    
</div>