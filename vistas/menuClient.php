<?php



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <title>Men&uacute; Principal</title>
    <link rel="icon" href="../img/logoupc.png">
    <link rel="stylesheet" href="../css/menu.css">

</head>

<body>

    <div class="d-flex ">
        
        <?php //require_once __DIR__.'../vistas/complementarios/sideBarAdmin.php';
        $hola = __DIR__.'/complementarios/sideBarClient.php';
        require_once $hola;
        ?>


        <div class="text-center col-md-12 px-0 align-middle header-principal" style="z-index: 900; ">

            <div class="text-light text-center bg-dark px-0 align-middle text-center d-flex justify-content-between align-items-center encabezado " style="height: 92px;">
                <h2 style="margin-left: 104px;">
                    Sistema de gesti&oacute;n de horarios UPC
                </h2>
                <ul style="list-style: none; height: 100%;" class="d-flex align-middle align-items-center menu-area-2">
                    <li class="d-flex align-middle align-items-center px-5">
                        <a href="# " class="d-block p-2 text-light "><i class="fa fa-user "></i><br><?php
                        require_once __DIR__.'/../utils/conexion_db.php';
                        $sql = "SELECT * FROM docentes
                        where id=:id";
                                          
                        try {
                            $stmt=$pdo->prepare($sql);
                            $stmt->execute(array(
                                ':id'=>$_SESSION['id']
                            ));
                        } catch (Exception $ex) {
                            echo "Ha ocurrido un error al obtener los datos ".$ex;
                        }
                        
                        if ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            //var_dump($fila);
                            echo $fila['name'].' '.$fila['apellidoP'].' '.$fila["apellidoM"];
                        }
                        ?></a>
                        <ul class="d-block text-dark ">
                            
                            <li class="d-block text-dark ">
                                <a class="d-block p-2 text-light  text-dark" href="# " onclick="cambiarP()">Cambiar contrase&ntilde;a</a>
                                <hr>
                            </li>
                            <li class="d-block text-dark ">
                                <a class="d-block p-2 text-light  text-dark" href="#" onclick="cerrarSesion()">Cerrar sesi&oacute;n</a>
                                <hr>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="text-center p-3 imagen-principal" style="position: absolute;z-index: 999 ">
            <img src="../img/logoupc.png " alt="logoupc " width="60" height="60">
        </div>
    </div>
    <div style="width: 92px;">

    </div>
    <div id="main1" class="text-center align-middle col-md-8" style="background-color: white;">
        <h2>¡Bienvenido al sistema de gesti&oacute;n de horarios de la UPC!</h2>
        <hr>
        <p>Usted se encuentra en el modo Cliente. Nos encontramos en el semestre 2020-2. Los horarios de Ing. Electrónica se encuentran ingresados en un 78% y los horarios de Ing. Mecatrónica al 90%.</p>
    </div>
    <br>

    <div id="main2" class="text-center align-middle col-md-8" style="background-color: white;">
        <br>

        <h2>OPCIONES DISPONIBLES</h2>
        <hr>
        <table class="col-md-12 table">
            <tbody>
                <tr>
                    <td>
                        <a class="text-dark" href="# " onclick="disponibilidadDocente()">Insertar disponibilidad horaria</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a class="text-dark" href="# " onclick="verHorarioPropuestoDocente()">Ver mi horario Propuesto</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a class="text-dark" href="# " onclick="cambiarP()">Cambiar contrase&ntilde;a</a>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>

    <div id="main3" class="text-center align-middle col-md-8" style="background-color: white;">
    </div>

    <!-- Button trigger modal -->


</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js " integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa " crossorigin="anonymous "></script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-analytics.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-auth.js"></script>
<script>
    var firebaseConfig = {
    apiKey: "AIzaSyCK0SrcYyJt9p3xv05E616rTG40jiqwoX0",
    authDomain: "horarios-7b345.firebaseapp.com",
    databaseURL: "https://horarios-7b345.firebaseio.com",
    projectId: "horarios-7b345",
    storageBucket: "horarios-7b345.appspot.com",
    messagingSenderId: "266538468616",
    appId: "1:266538468616:web:8c4e00972e15efd42cd8bd",
    measurementId: "G-EYTMTFXPXF"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();

const auth = firebase.auth();
const user = firebase.auth().currentUser;
</script>
<script src="../js/funcionesClient.js"></script>

</html>