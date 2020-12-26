<?php
require_once '../../funciones/insertarPHP.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    var_dump($_POST);
    if(isset($_POST['insertar'])){
        
        $codCurso = explode("-",$_POST['curso']);
        $idDocente = $_POST["docenteTeoria"];
        $seccion = $_POST["seccion"];
        $tipoSesion = "TEO";
        $dia = $_POST["diaTeoria"];
        $horaInicio = $_POST["horaInicioTeoria"];
        $horaInicio = (int)(explode(":",$horaInicio)[0]+0);
        $horaFin = $_POST["horaInicioTeoria"]+$_POST["maxTeoria"];
        $idAula = $_POST["aulaTeoria"];
        $grupo = "0";
        $vacantes = $_POST["vacantes"];
        $semestre = "2020-2";
        insertarHorarioCurso($codCurso[0],$idDocente,$seccion,$tipoSesion,$dia,$horaInicio,$horaFin,$idAula,
        $grupo,$vacantes,$semestre);

        if(isset($_POST["docenteLaboratorio1"])){
            $idDocente = $_POST["docenteLaboratorio1"];
            $seccion = $_POST["seccion"];
            $tipoSesion = "LAB";
            $dia = $_POST["diaLaboratorio1"];
            $horaInicio = $_POST["horaInicioLaboratorio1"];
            $horaInicio = (int)(explode(":",$horaInicio)[0]+0);
            $horaFin = $_POST["horaInicioLaboratorio1"]+$_POST["maxLabo"];
            $idAula = $_POST["aulaLaboratorio1"];
            $grupo = "1";
            $estado = "Abierto";
            $vacantes = "20";
            $semestre = "2020-2";
            insertarHorarioCurso($codCurso[0],$idDocente,$seccion,$tipoSesion,$dia,$horaInicio,$horaFin,$idAula,
            $grupo,$vacantes,$semestre);
        }
        if(isset($_POST["docenteLaboratorio2"])){
            $idDocente = $_POST["docenteLaboratorio2"];
            $seccion = $_POST["seccion"];
            $tipoSesion = "LAB";
            $dia = $_POST["diaLaboratorio2"];
            $horaInicio = $_POST["horaInicioLaboratorio2"];
            $horaInicio = (int)(explode(":",$horaInicio)[0]+0);
            $horaFin = $_POST["horaInicioLaboratorio2"]+$_POST["maxLabo"];
            $idAula = $_POST["aulaLaboratorio2"];
            $grupo = "2";
            $estado = "Abierto";
            $vacantes = "20";
            $semestre = "2020-2";
            insertarHorarioCurso($codCurso[0],$idDocente,$seccion,$tipoSesion,$dia,$horaInicio,$horaFin,$idAula,
            $grupo,$vacantes,$semestre);
        }
    
        echo "exito";
    
    
    }else{
        $codCurso = $_POST['codCurso'];
        $idDocente = $_POST["docente"];
        $seccion = $_POST["seccion"];
        $tipoSesion = $_POST["tipo"];
        $dia = $_POST["dia"];
        $horaInicio = $_POST["horaInicio"];
        $horaInicio = (int)(explode(":",$horaInicio)[0]+0);
        $horaFin = $_POST["horaInicio"]+$_POST["maxTeoria"];
        $idAula = $_POST["aula"];
        $grupo = $_POST["grupo"];
        $semestre = "2020-2";
        $id = $_POST["id"];
        actualizarHorarioCurso($id,$codCurso,$idDocente,$seccion,$tipoSesion,$dia,$horaInicio,$horaFin,$idAula,
        $grupo,$semestre);
    }
}

?>