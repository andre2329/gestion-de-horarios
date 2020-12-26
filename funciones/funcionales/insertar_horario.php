<?php
require_once '../../funciones/insertarPHP.php';
session_start();
if(isset($_SESSION['isAdmin']) && $_SERVER['REQUEST_METHOD']=="POST"){
            
            if ($_SESSION['isAdmin']==1){
                $iddocente = $_SESSION["iddocenteInsertar"];
            }else{
                $iddocente = $_SESSION["iddocente"];
            }
            $arreglo = $_POST;
            
            insertarHorario_D($iddocente,$arreglo);
    
}

?>