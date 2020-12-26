<?php
require_once '../../funciones/obtenerPHP.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    ?>

<div class="container marketing ">
    <br><br>
    <form class="text-center  h-100 justify-content-center align-items-center" id="grabaDocente">
        <h2 class=" text-center">Modificar horario</h2>
        <br>
        <br>
        <div class="form-group row text-center">

            <label for="iddocente" class="col-md-6 ">Seleccione horario:</label>
            <div class="col-md-6">
                <select onchange="cargarHorario(this.value)" name="horario" id="horario" class="form-control"
                    required>
                    <option value="" selected hidden>...</option>
        <?php
               
                $datos = obtenerDatosHorarios(0);
                
                if($datos!=null){
                    foreach ($datos as $curso) {
                        $id = $curso['id'];
                        $nomb = $curso['nombreCurso'];
                        $horaInicio = $curso['horaInicio'];
                        $sede = $curso['sede'];
                        $tipo = $curso['tipo'];
                        echo '<option value="'.$id.'">'.$sede.'-'.$horaInicio.':00-'.$tipo.'-'.$nomb.'</option>';
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

?>