

function ingresar() {

    email = $('#correo').val();
    password = $('#contrasena').val();
    // console.log(email,password);
    $( "#btn-modal" ).click();
    $('.cargando').show();
    auth
    .signInWithEmailAndPassword(email,password)
    .then(
        userCredential=>{
            // console.log(userCredential)
            // console.log(userCredential.user.uid)
            // console.log(userCredential.user.email)
            $( "#btn-modal" ).click();
            $("#uid").val(userCredential.user.uid);
            $("#log").click();
        }
    )
    .catch(
        function(error) {
            // console.log(error.code);
            $('.datosIncorrectos').show();
            $('.cargando').hide();
        }
    )
    
}


function determinar(event){
    if(event.keyCode==13){
        event.preventDefault()
        ingresar()
    }
}
