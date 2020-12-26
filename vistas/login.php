<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <title>Iniciar sesi&oacute;n</title>
    <link rel="icon" href="img/logoupc.png">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <div class="row">

            <div class="col-md-6 px-0">
                <div class="columnaDerecha">
                    <div class="box text-center">
                        <header>Sistema de gesti&oacute;n de horarios UPC</header>
                        <p>
                            Accede mediante tu correo institucional y gestiona f&aacute;cilmente tu horario y cursos
                            UPC.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-0">
                <div class="columnaIzquierda">
                    <form action="homepage/" method="POST" class="myForm text-center" id="formularioInicio">
                        <img class="mb-0" src="img/logoupc.png" alt="" width="72" height="72">
                        <header>Iniciar sesi&oacute;n</header>
                        <div class="form-group">
                            <i class="fas fa-user"></i>
                            <input type="email" class="myInput" id="correo" name="correo"
                                placeholder="Ingrese su correo electr&oacute;nico" 
                                onkeypress="determinar(event)"
                                required>
                            <div class="invalid-feedback">
                                Complete este campo.
                            </div>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-envelope"></i>
                            <input type="password" class="myInput" id="contrasena" name="contrasena"
                                placeholder="Ingrese su contrase&ntilde;a" 
                                onkeypress="determinar(event)"
                                required>
                            <div class="invalid-feedback">
                                Complete este campo.
                            </div>
                        </div>
                        <input type="button" class="boton" id="btn_ingresar" onclick="ingresar()" value="INGRESAR">
                        <input type="checkbox" id="btn-modal">
                        <input type="text" id="uid" name="uid">
                        <!--modal-->
                        <div class="modal-propio">
                            <div class="contenedor-modal">
                            <div class="d-flex justify-content-between align-middle align-items-center datosIncorrectos">
                                <h4 class="p-0"></h4>

                                <label class="p-2 datosIncorrectos" for="btn-modal"><i class="fa fa-times"></i></label>
                            </div>
                                <div class="contenido-modal p-4">
                                    <div class="datosIncorrectos">
                                        <p>Sus datos son incorrectos</p>
                                    </div>
                                <div class="spinner-border text-danger cargando" role="status">
                                    
                                    <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="log" onkeypress="determinar(event)">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.js"
    integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-analytics.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-auth.js"></script>

<script>
// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
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

var auth = firebase.auth();
var user = firebase.auth().currentUser;
</script>

<script src="js/login.js"></script>

</html>