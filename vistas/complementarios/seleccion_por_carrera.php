<?php
require_once __DIR__.'/../../utils/conexion_db.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    ?>

<div class="container marketing ">
    <br><br>
    <form class="text-center  h-100 justify-content-center align-items-center" id="grabaDocente">
        <h2 class=" text-center">Ver horarios por carrera</h2>
        <br>
        <br>
        <div class="form-group row text-center">

            <label for="idcurso" class="col-md-6 ">Seleccione la carrera:</label>
            <div class="col-md-6">
                <select onchange="cargarHorariosCarrera(this.value)" name="idcurso" id="idcurso" class="form-control" required>
                    <option value="" selected hidden>...</option>
                    <option value="ELEC">Ing. Electr&oacute;nica</option>
                    <option value="MECA">Ing. Mecatr&oacute;nica</option>
                    <option value="INDU">Ing. Industrial</option>
                          
                </select>
            </div>
        </div>
    </form>
</div>
<?php
}

?>