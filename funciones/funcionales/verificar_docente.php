<?php
if ($_SERVER['REQUEST_METHOD']=="POST") {
    session_start();

    if (isset($_SESSION['isAdmin'])&&isset($_SESSION['id'])) {

        if ($_SESSION['isAdmin']==1) {

            require_once '../../utils/conexion_db.php';

            $error = false;
            $sql =" SELECT * FROM docentes where correo=:correo OR iddocente =:iddocente";
        
            try {
                $stmt=$pdo->prepare($sql);
                $stmt->execute(array(
                                        ':correo'=>$_POST['correo'],
                                        ':iddocente'=>$_POST['codigo']
                        ));
            } catch (Exception $ex) {
                $error = true;
                echo $ex;
            }
            if ($error) {
                echo  "error";
            } elseif ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "existe";
            }
            else{
                echo "libre";
            }

        }


    }


}


?>