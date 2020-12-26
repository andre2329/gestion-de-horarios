<?php session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["uid"])){

        //var_dump($_POST);
        $uid = $_POST["uid"];
        require_once __DIR__.'/../utils/conexion_db.php';

        $sql = "SELECT * FROM users 
        INNER JOIN docentes
        ON users.id=docentes.id WHERE users.id=:id";
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':id'=> $uid
                )
            );
        } catch (Exception $ex) {
            echo $ex;
            exit();
        }
        if ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //var_dump($fila);
            $_SESSION["id"]=$fila["id"];
            $_SESSION["isAdmin"]=$fila["isAdmin"];
            $_SESSION["iddocente"]=$fila["idDocente"];
            $accesos = $fila["accesos"];

            $sql = "UPDATE users SET last_access=CURRENT_TIMESTAMP,accesos=:accesos 
                    WHERE id=:id";
            try {
                $stmt=$pdo->prepare($sql);
                $stmt->execute(
                    array(
                        ':accesos'=>$accesos+1,
                        ':id'=> $uid
                    )
                );
            } catch (Exception $ex) {
                echo $ex;
                exit();
            }
            if($fila["isAdmin"]==1){
                require_once __DIR__.'/../vistas/menuAdmin.php';
            }else{
                require_once __DIR__.'/../vistas/menuClient.php';
            }



        }else{
            return null;
        }

    }else{
        
    }
}else{

    if(isset($_SESSION["id"])&&isset($_SESSION["isAdmin"]) ){

        if($_SESSION["isAdmin"]==1){
            require_once __DIR__.'/../vistas/menuAdmin.php';
        }else{
            require_once __DIR__.'/../vistas/menuClient.php';
        }

    }else{
        
        echo '<script type="text/javascript">
                window.location ="./../"
            </script>';
            die();
            exit();
    }

}

?>
