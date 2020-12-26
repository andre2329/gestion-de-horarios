<?php
require_once __DIR__.'/../utils/conexion_db.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $id = $_POST['id'];

    $sql = "SELECT * from horarios
    
    INNER JOIN aulas
    ON horarios.idAula=aulas.idAula
    where codCurso=:id order by aulas.sede asc";
                      
    try {
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
            ':id'=>$id
        ));
    } catch (Exception $ex) {
        echo "Ha ocurrido un error al obtener los datos ".$ex;
    }
    

?>
    <table class="table">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Sede</th>
                <th>Seccion</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Aula</th>
            </tr>
        </thead>
        <tbody>
            <?php
if ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
    foreach ($fila as $esp) {
        $tipo = $esp['tipoSesion'];
        $sede = $esp['sede'];
        $seccion = $esp['seccion'];
        $horaInicio = $esp['horaInicio'];
        $horaFin = $esp['horaFin'];
        $aula = $esp['nombre'];
                          
        echo '<tr>';
            echo '<td>'.$tipo.'</td>';
            echo '<td>'.$sede.'</td>';
            echo '<td>'.$seccion.'</td>';
            echo '<td>'.$horaInicio.':00</td>';
            echo '<td>'.$horaFin.':00</td>';
            echo '<td>'.$aula.'</td>';
        echo '</tr>';
    }
} else{
    echo "<tr><h1 class='text-danger'>No se encontraron horarios</h1><tr>";
}
            ?>
        </tbody>
    </table>
<?php



}



?>