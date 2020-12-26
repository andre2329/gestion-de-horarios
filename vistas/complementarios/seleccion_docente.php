<?php

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_POST['ventana'])) {
        switch ($_POST['ventana']) {
        case 'insertarDisponibilidad':
            $funcion = 'disponibilidadDocente(this.value)';
            $titulo = "DISPONIBILIDAD HORARIA";
            break;
        case 'editarDocente':
            $funcion = 'editarDocente(this.value)';
            $titulo = "EDITAR DOCENTE";
            break;
        case 'verHorarioPropuesto':
            $funcion = 'verHorarioPropuestoDocente(this.value)';
            $titulo = "HORARIO PROPUESTO DOCENTE";
            break;
        case 'resumenDisponibilidad':
            $funcion = 'disponibilidadDocenteResumen(this.value)';
            $titulo = "DISPONIBILIDAD HORARIA";
            break;
            
    } ?>

<div class="container marketing ">
    <br><br>
    <form class="text-center  h-100 justify-content-center align-items-center" id="grabaDocente">
        <h2 class=" text-center"><?php echo $titulo; ?></h2>
        <br>
        <br>
        <div class="form-group row text-center">

            <label for="iddocente" class="col-md-6 ">Seleccione docente:</label>
            <div class="col-md-6">
                <select onchange="<?php echo $funcion; ?>" name="iddocente" id="iddocente" class="form-control"
                    required>
                    <option value="" selected hidden>...</option>
        <?php
               require_once '../../funciones/obtenerPHP.php';
                $datos = obtenerDatosDocente(0);
                if($datos!=null){
                    foreach ($datos as $docente) {
                        $id_docente = $docente['idDocente'];
                        $nomb = $docente['name'];
                        $ap = $docente['apellidoP'];
                        $am = $docente['apellidoM'];
                                      
                        echo '<option value="'.$id_docente.'">'.$nomb.' '.$ap.' '.$am.'</option>';
                    }
                }
               
         ?>

                </select>
            </div>
        </div>
    </form>
</div>
<?php
    }
}
?>