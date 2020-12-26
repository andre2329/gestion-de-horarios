<?php
require_once __DIR__.'/../../utils/conexion_db.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    ?>

<div class="container marketing ">
    <br><br>
    <form class="text-center  h-100 justify-content-center align-items-center" id="grabaDocente">
        <h2 class=" text-center">Editar curso</h2>
        <br>
        <br>
        <div class="form-group row text-center">

            <label for="idcurso" class="col-md-6 ">Seleccione curso:</label>
            <div class="col-md-6">
                <select onchange="grabarCurso('obtener')" name="idcurso" id="idcurso" class="form-control" required>
                    <option value="" selected hidden>...</option>
                    <?php
                          
                      
    $sql = "Select * from cursos where 1 order by codCurso asc";
                      
    try {
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
    } catch (Exception $ex) {
        echo "Ha ocurrido un error al obtener los datos ".$ex;
    }
    $posiciones = array();
    $campus = array();
    if ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        foreach ($fila as $esp) {
            $codcurso = $esp['codCurso'];
            $nomb = $esp['nombre'];
                              
            echo '<option value="'.$codcurso.'">'.$codcurso.' '.$nomb.'</option>';
        }
    } ?>

                </select>
            </div>
        </div>
    </form>
</div>
<?php
}

?>