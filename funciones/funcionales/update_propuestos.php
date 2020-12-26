<?php
require_once __DIR__.'/../../utils/conexion_db.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    
    if (isset($_POST['insertar'])) {
        $aula = $_POST['idAula'];
        $iddocente = $_POST['iddocente'];
        $seccion = $_POST['seccion'];
        $tipo_sesion = $_POST['tipo'];
        $sede = $_POST['sede'];
        $codcurso = $_POST['codCurso'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $dia = $_POST['dia'];
        $grupo = $_POST['grupo'];
        var_dump($_POST);
        $sql = "UPDATE horarios set iddocente=:iddocente   

            WHERE iddocente IS NULL AND codcurso = :codCurso ".
            "AND horaInicio = :hora_inicio AND horaFin = :hora_fin AND dia = :dia AND tipoSesion = :tiposesion".
            " AND seccion = :seccion AND grupo =:grupo AND idAula=:aula AND semestre = '2020-2' ";

        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
                                ':iddocente'=>$iddocente,
                                ':codCurso'=>$codcurso,
                                ':hora_inicio'=>$hora_inicio,
                                ':hora_fin'=>$hora_fin,
                                ':dia'=>$dia,
                                ':tiposesion'=> $tipo_sesion,
                                ':seccion' =>$seccion,
                                ':grupo'=>$grupo,
                                ':aula'=>$aula

                    ));
        } catch (Exception $ex) {
            echo "Ha ocurrido un error al obtener los datos ".$ex;
        }
    } elseif (isset($_POST['eliminar'])) {
        var_dump($_POST);
        $aula = $_POST['aula'];
        $iddocente = $_POST['iddocente'];
        $seccion = $_POST['seccion'];
        $tipo_sesion = $_POST['tipo'];
        $sede = $_POST['sede'];
        $codcurso = $_POST['codCurso'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $dia = $_POST['dia'];
        $grupo = $_POST['grupo'];

        $sql = "UPDATE horarios  SET   iddocente= NULL
             WHERE codCurso = :codCurso ".
            " AND horaInicio = :hora_inicio AND horaFin = :hora_fin AND dia = :dia AND tiposesion = :tiposesion".
            " AND seccion = :seccion AND grupo =:grupo AND idDocente=:iddocente ";
    
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
                                ':iddocente'=>$iddocente,
                                ':codCurso'=>$codcurso,
                                ':hora_inicio'=>$hora_inicio,
                                ':hora_fin'=>$hora_fin,
                                ':dia'=>$dia,
                                ':tiposesion'=> $tipo_sesion,
                                ':seccion' =>$seccion,
                                ':grupo'=>$grupo

                    ));
        } catch (Exception $ex) {
            echo "Ha ocurrido un error al obtener los datos ".$ex;
        }
    }
}
