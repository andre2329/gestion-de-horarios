<?php

require_once __DIR__.'/../utils/conexion_db.php';
/**
       * 
       * Obtiene la disponibilidad
       *
       * @param string $iddocente
       * @return array 
       * 
       * Devuelve un array de arrays con:
       * idDocente |
       * semestre |
       * campus |
       * diaHora | 
       * uActualizacion |
       *
       */
function obtenerDisponibilidad($iddocente){
    
    global $pdo;
    $sql = "SELECT * FROM disponibilidad where idDocente=:id";
    
    try {

        $stmt=$pdo->prepare($sql);
        $stmt->execute(
            array(
                ':id'=> $iddocente
            )
        );
    } catch (Exception $ex) {
        echo $ex;
        exit();
    }
    if ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        
        return $fila;
    }else{
        return 0;
    }
}
//$arrayDisponibilidades = obtenerDisponibilidad("1111");

//var_dump(obtenerDisponibilidad("1111"));


function obtenerDatosDocente($iddocente){
    if($iddocente==0){
        $sql ="SELECT * FROM docentes where 1";

        global $pdo;
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
                            ':iddocente'=>$iddocente
            ));
        } catch (Exception $ex) {
            echo $ex;
        }
        $fila = array();
        if($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            return $fila;
        }else{
            return null;
        }
    }else{
        $sql ="SELECT * FROM docentes 
        INNER JOIN users ON docentes.id=users.id
        where docentes.idDocente=:iddocente";

            global $pdo;
            try {
                $stmt=$pdo->prepare($sql);
                $stmt->execute(array(
                                ':iddocente'=>$iddocente
                ));
            } catch (Exception $ex) {
                echo $ex;
            }
            $fila = array();
            if($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
                return $fila;
            }else{
                return null;
            }
    }
    
}

function obtenerDatosCurso($codCurso){
    if($codCurso ==0){
        $sql ="SELECT * FROM cursos where 1";

        global $pdo;
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute();
        } catch (Exception $ex) {
            echo $ex;
        }
        $fila = array();
        if($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            return $fila;
        }else{
            return null;
        }
    }else{
        $sql ="SELECT * FROM cursos where codCurso=:codCurso";

        global $pdo;
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
                            ':codCurso'=>$codCurso
            ));
        } catch (Exception $ex) {
            echo $ex;
        }
        $fila = array();
        if($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            return $fila;
        }else{
            return null;
        }
    }
    
}

function obtenerDatosHorarios($id){
    if($id ==0){
        $sql ="SELECT * ,aulas.nombre AS nombreAula,cursos.nombre AS nombreCurso FROM horarios
        INNER JOIN cursos 
        ON horarios.codCurso = cursos.codCurso
        INNER JOIN aulas 
        ON horarios.idAula = aulas.idAula
        where 1";

        global $pdo;
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute();
        } catch (Exception $ex) {
            echo $ex;
        }
        $fila = array();
        if($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            return $fila;
        }else{
            return null;
        }
    }else{
        $sql ="SELECT *,aulas.nombre AS nombreAula ,cursos.nombre AS nombreCurso FROM horarios
        INNER JOIN cursos 
        ON horarios.codCurso = cursos.codCurso
        INNER JOIN aulas 
        ON horarios.idAula = aulas.idAula
         where id=:id";

        global $pdo;
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
                            ':id'=>$id
            ));
        } catch (Exception $ex) {
            echo $ex;
        }
        $fila = array();
        if($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $fila;
        }else{
            return null;
        }
    }
    
}

function obtenerDatosAula($idAula,$sede,$tipo){
    if($idAula==0){
        $sql ="SELECT * FROM aulas where sede=:sede AND tipo=:tipo";
        global $pdo;
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
                ':sede'=>$sede,
                ':tipo'=>$tipo
            ));
        } catch (Exception $ex) {
            echo $ex;
        }
        $fila = array();
        if($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            return $fila;
        }else{
            return null;
        }
    }else{
        $sql ="SELECT * FROM aulas where idAula=:idAula";
        global $pdo;
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute();
        } catch (Exception $ex) {
            echo $ex;
        }
        $fila = array();
        if($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $fila;
        }else{
            return null;
        }
    }

}
?>