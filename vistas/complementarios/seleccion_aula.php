<?php

require_once './../../utils/conexion_db.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $string = "<option value='' hidden>...</option>";
    if(isset($_POST["sede"]) && isset($_POST["tipo"])){
        $sede =$_POST["sede"];
        $tipo =$_POST["tipo"];
        if($tipo=="LAB"){
            $sql ="SELECT * FROM aulas where (sede=:sede) AND (tipo=:tipo OR tipo='COM') ";
        }
        else{
            $sql ="SELECT * FROM aulas where sede=:sede AND tipo=:tipo ";
        }

        global $pdo;
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
                ':sede'=>$sede,
                ':tipo'=>$tipo,
            ));
        } catch (Exception $ex) {
            echo $ex;
        }
        if($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)){
           
            foreach ($fila as $aula ) {
                
                $string=$string."<option value=".$aula["idAula"]." >".$aula['nombre']."(".$aula['tipo'].")</option>";
                
            }

        }

        
    }
    echo $string;
}

?>