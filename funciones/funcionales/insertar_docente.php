<?php
if ($_SERVER['REQUEST_METHOD']=="POST") {
        session_start();
    if (isset($_SESSION['isAdmin'])&&isset($_SESSION['id'])) {
        if ($_SESSION['isAdmin']==1) {
            require_once '../../funciones/insertarPHP.php';
            var_dump($_POST);
            if(isset($_POST['actualizar'])){
                var_dump($_POST);
                $isAdmin = $_POST['admin'];
                $idDocente = $_POST['codigo'];
                $nombres = $_POST['nombres'];
                $apellidop = $_POST['apellidop'];
                $apellidom = $_POST['apellidom'];
                $carrera = $_POST['direccion'];
                $contrato = $_POST['contrato'];
                $habilitado =$_POST['habilitado'];
                $horas_max = $_POST['maxhoras'];
                $horas_min = $_POST['minhoras'];
                $resultado = actualizarDocente($isAdmin,$idDocente,$nombres,$apellidop,$apellidom,
                $carrera,$contrato,$habilitado,$horas_max,$horas_min);
                
            }else{
                $id = $_POST['id'];
                $isAdmin = $_POST['admin'];
                $idDocente = $_POST['codigo'];
                $nombres = $_POST['nombres'];
                $apellidop = $_POST['apellidop'];
                $apellidom = $_POST['apellidom'];
                $carrera = $_POST['direccion'];
                $contrato = $_POST['contrato'];
                $habilitado =$_POST['habilitado'];
                $horas_max = $_POST['maxhoras'];
                $horas_min = $_POST['minhoras'];
                $correo = $_POST['correo'];
    
                $resultado = insertarDocente($id,$isAdmin,$idDocente,$nombres,$apellidop,$apellidom,
                $carrera,$contrato,$habilitado,$horas_max,$horas_min,$correo);
    
                echo $resultado;
            }
            
            
            
            

            
        } else {
            echo "Usted no tiene los permisos para esta función";
        }
    }
}
    ?>