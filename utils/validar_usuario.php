<?php
session_start();
include 'direcciones.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['correo']) && isset($_POST['contrasena'])) {
            $_SESSION['hora_ingreso']=date("Y-n-j H:i:s");
            require $conexion_DB;
            $usuario = $_POST["correo"];
            $clave = $_POST["contrasena"];
            $sql = "Select docentes.iddocente, docentes.nombre, docentes.apellidop, docentes.apellidom, usuarios.correo,
             usuarios.admin, usuarios.uacceso, usuarios.accesos".
            " from usuarios join docentes  on usuarios.correo = docentes.correo where usuarios.correo = :mail".
            " and usuarios.clave = aes_encrypt(:password,'upc')";

            try {
                $stmt=$pdo->prepare($sql);
                $stmt->execute(array(
                                ':mail'=>$usuario,
                                ':password'=>$clave
                ));
            } catch (Exception $ex) {
                header('Location: '.$pagina_inicio);
                exit();
            }
            if ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $admin = $fila['admin'];
                $accesos = $fila['accesos']+1;
                $nombre = $fila['nombre'];
                $apellidop = $fila['apellidop'];
                $apellidom = $fila['apellidom'];
                $iddocente = $fila['iddocente'];
                $_SESSION['correo']=$usuario;
                $_SESSION['admin']=$admin;
                $_SESSION['nombre']=$nombre;
                $_SESSION['apellidop']=$apellidop;
                $_SESSION['apellidom']=$apellidom;
                $_SESSION['iddocente'] = $iddocente;
                $_SESSION['hora_entrada']=date("Y-n-j H:i:s");
                $uacceso=date("Y-n-j H:i:s");

                $sql = "update usuarios set uacceso= :uacceso, accesos =:accesos WHERE correo = :mail";

                try {
                    $stmt=$pdo->prepare($sql);
                    $stmt->execute(array(
                                            ':mail'=>$_POST["correo"],
                                            ':uacceso'=>$uacceso,
                                            ':accesos'=>$accesos
                            ));
                } catch (Exception $ex) {
                    echo $ex;
                    header('Location: '.$pagina_inicio);
                    exit();
                }
                header("Location:".$archivo_menu);
                exit();
            } else {
                echo "<script language= javascript>
                alert('Su clave o usuario son errados.')
                self.location='".$pagina_inicio."'</script>";
                exit();
            }
        } else {
            echo "<script>
            location.href='../404.php';
                </script>";
            exit();
        }
} else {
    header("Location: ../../");
    die();
}

?>
