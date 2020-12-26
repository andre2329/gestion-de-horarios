<?php
require_once __DIR__.'/../../utils/conexion_db.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    ?>

<div class="container marketing ">
    <br><br>
    <form class="text-center  h-100 justify-content-center align-items-center" id="grabaDocente">
        <h2 class=" text-center">Ver horarios por ciclo</h2>
        <br>
        <br>
        <div class="form-group row text-center">

            <label for="idcurso" class="col-md-6 ">Seleccione ciclo:</label>
            <div class="col-md-6">
                <select onchange="cargarHorariosCiclo(this.value)" name="idcurso" id="idcurso" class="form-control" required>
                    <option value="" selected hidden>...</option>
                    <option value="1">Ciclo 1</option>
                    <option value="2">Ciclo 2</option>
                    <option value="3">Ciclo 3</option>
                    <option value="4">Ciclo 4</option>
                    <option value="5">Ciclo 5</option>
                    <option value="6">Ciclo 6</option>
                    <option value="7">Ciclo 7</option>
                    <option value="8">Ciclo 8</option>
                    <option value="9">Ciclo 9</option>
                    <option value="10">Ciclo 10</option>
                          
                </select>
            </div>
        </div>
    </form>
</div>
<?php
}

?>