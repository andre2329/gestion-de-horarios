<?php

require_once __DIR__.'/../../utils/conexion_db.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $sql =" DELETE FROM `horarios` WHERE id=:id";
           
            try {
                $stmt=$pdo->prepare($sql);
                $stmt->execute(array(
                                ':id'=>$id
                ));
            } catch (Exception $ex) {
                $error = true;
                echo $ex;
            }

    }


}
require_once './../../api/updateCursosFB.php';
updateCursosFB();


?>