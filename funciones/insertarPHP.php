<?php

require_once __DIR__.'/../utils/conexion_db.php';
function insertarDocente($id, $isAdmin, $idDocente, $nombres, $apellidop, $apellidom, $carrera, $contrato, $habilitado, $horas_max, $horas_min, $correo)
{
    

    $sql =" INSERT INTO `users`(`id`, `last_access`, `accesos`, `isAdmin`) 
            VALUES (:id,CURRENT_TIMESTAMP,0,:isAdmin) ";
    global $pdo;
    try {
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
                                        ':id'=>$id,
                                        ':isAdmin'=>$isAdmin,
                        ));
    } catch (Exception $ex) {
        $error = true;
        echo $ex;
    }
    if ($error) {
        return 1;
    } else {
        $sql ="INSERT INTO `docentes`(`idDocente`, `id`, `name`, `apellidoP`, `apellidoM`, `carrera`, `contrato`, `habilitado`, `horasMax`, `horasMin`, `correo`, `fotoLink`) 
                      VALUES (:iddocente,:id,:nombre,:apellidop,:apellidom,:carrera,:contrato,:habilitado,:horas_max,:horas_min,:correo,NULL)" ;
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
                                        ':iddocente'=>$idDocente,
                                        ':id'=>$id,
                                        ':nombre'=>$nombres,
                                        ':apellidop'=>$apellidop,
                                        ':apellidom'=>$apellidom,
                                        ':carrera'=>$carrera,
                                        ':contrato'=>$contrato,
                                        ':habilitado'=>$habilitado,
                                        ':horas_max'=>$horas_max,
                                        ':horas_min'=>$horas_min,
                                        ':correo'=>$correo
                        ));
        } catch (Exception $ex) {
            $error = true;
            echo $ex;
        }

        if ($error) {
            return 1;
        } else {
            return 0;
        }
    }
}

function insertarHorario_D($iddocente,$arreglo)
{
    $sql =" DELETE FROM disponibilidad WHERE iddocente = :iddocente  ";
    global $pdo;
    try {
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
                                ':iddocente'=>$iddocente
                ));
    } catch (Exception $ex) {
        echo $ex;
    }

    foreach ($arreglo as $dia_hora => $campus) {
        if ($arreglo[$dia_hora] !=="NO") {
            //echo $campus;
            $sql ="INSERT INTO `disponibilidad`(`idDocente`, `semestre`, `campus`, `diaHora`, `uActualizacion`) VALUES 
            ( :iddocente, '2020-2', :campus, :dia_hora, CURRENT_TIMESTAMP)";

            try {
                $stmt=$pdo->prepare($sql);
                $stmt->execute(array(
                                ':iddocente'=>$iddocente,
                                ':campus'=>$campus,
                                ':dia_hora'=>$dia_hora
                ));
            } catch (Exception $ex) {
                echo $ex;
            }
        }
    }
}

function actualizarDocente($isAdmin, $idDocente, $nombres, $apellidop, $apellidom, $carrera, $contrato, $habilitado, $horas_max, $horas_min){
    
    $error = false;
    $sql =" SELECT id FROM docentes where idDocente=:iddocente ";
    global $pdo;
    try {
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
                                        ':iddocente'=>$idDocente
                        ));
    } catch (Exception $ex) {
        $error = true;
        echo $ex;
    }
    $id=0;
    if ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $fila['id'];
        var_dump($fila);
    }
    if ($error) {
        return 1;
    } else {
        $sql ="UPDATE `docentes` SET `idDocente`=:iddocente,`name`=:nombre,`apellidoP`=:apellidop,
        `apellidoM`=:apellidom,`carrera`=:carrera,`contrato`=:contrato,`habilitado`=:habilitado,
        `horasMax`=:horas_max,`horasMin`=:horas_min WHERE id=:id" ;
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
                                        ':iddocente'=>$idDocente,
                                        ':nombre'=>$nombres,
                                        ':apellidop'=>$apellidop,
                                        ':apellidom'=>$apellidom,
                                        ':carrera'=>$carrera,
                                        ':contrato'=>$contrato,
                                        ':habilitado'=>$habilitado,
                                        ':horas_max'=>$horas_max,
                                        ':horas_min'=>$horas_min,
                                        ':id'=>$id
                        ));
        } catch (Exception $ex) {
            $error = true;
            echo $ex;
        }

        if ($error) {
            return 1;
        } else {
            $sql ="UPDATE `users` SET `isAdmin`=:isAdmin WHERE id=:id" ;
                try {
                    $stmt=$pdo->prepare($sql);
                    $stmt->execute(array(
                                                ':isAdmin'=>$isAdmin,
                                                ':id'=>$id
                                ));
                } catch (Exception $ex) {
                    $error = true;
                    echo $ex;
                }
            return 0;
        }
    }
}
function insertarHorarioCurso($codCurso,$idDocente,$seccion,$tipoSesion,$dia,$horaInicio,$horaFin,$idAula,$grupo,$vacantes,$semestre){

    
    
    $sql ="INSERT INTO `horarios`(`id`, `codCurso`, `idDocente`, `seccion`,
     `tipoSesion`, `dia`, `horaInicio`, `horaFin`, `idAula`, `grupo`, `estado`,
      `vacantes`, `semestre`, `uActualizacion`)
        VALUES 
        (NULL,:codCurso,:idDocente,:seccion,:tipoSesion,:dia,:horaInicio,:horaFin,:idAula,:grupo,
        'Abierto',:vacantes,:semestre,CURRENT_TIMESTAMP
        )
        ";
        if($idDocente=="NULL"){
            $idDocente=null;
        }
            global $pdo;
            try {
                $stmt=$pdo->prepare($sql);
                $stmt->execute(array(
                                ':codCurso'=>$codCurso,
                                ':idDocente'=>$idDocente,
                                ':seccion'=>$seccion,
                                ':tipoSesion'=>$tipoSesion,
                                ':dia'=>$dia,
                                ':horaInicio'=>$horaInicio,
                                ':horaFin'=>$horaFin,
                                ':idAula'=>$idAula,
                                ':grupo'=>$grupo,
                                ':vacantes'=>$vacantes,
                                ':semestre'=>$semestre
                ));
            } catch (Exception $ex) {
                echo $ex;
            }
    
}
function actualizarHorarioCurso($id,$codCurso,$idDocente,$seccion,$tipoSesion,$dia,$horaInicio,$horaFin,$idAula,$grupo,$semestre){

    
    $sql ="UPDATE `horarios` SET `codCurso`=:codCurso,
    `idDocente`=:idDocente,`seccion`=:seccion,`tipoSesion`=:tipoSesion,
    `dia`=:dia,`horaInicio`=:horaInicio,`horaFin`=:horaFin,`idAula`=:idAula,
    `grupo`=:grupo,
    `uActualizacion`=CURRENT_TIMESTAMP WHERE id=:id";
        if($idDocente=="NULL"){
            $idDocente=null;
        }
            global $pdo;
            try {
                $stmt=$pdo->prepare($sql);
                $stmt->execute(array(
                                ':codCurso'=>$codCurso,
                                ':idDocente'=>$idDocente,
                                ':seccion'=>$seccion,
                                ':tipoSesion'=>$tipoSesion,
                                ':dia'=>$dia,
                                ':horaInicio'=>$horaInicio,
                                ':horaFin'=>$horaFin,
                                ':idAula'=>$idAula,
                                ':grupo'=>$grupo,
                                ':id'=>$id
                ));
            } catch (Exception $ex) {
                echo $ex;
            }
            echo "exito";
    
}