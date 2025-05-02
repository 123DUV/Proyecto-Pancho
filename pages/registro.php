<?php
    include_once '../config.php';

?>

<!DOCTYPE html>
<html lang="es">
<?php
    include_once '../headers.php';
?>
<head>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        input[type="file"]{
            display: none;
        }
        .inputFalso{
            background-color: white;
            border-color: rebeccapurple;
            border-radius: 15px;
            padding: 5%;
            width: 100%;
            cursor: pointer;
            background-color:rgb(163, 163, 163);
            color: black;
            margin-top: 2%;
        }
        .inputFalso:hover{
            background-color:rgb(97, 96, 97);

        }
    </style>
</head>

<body>

    <section class="h-auto">
        <div class="container py-5 h-auto">
            <div class="row d-flex align-items-center justify-content-center h-auto">
            <h2 class="text-center mb-5 text-uppercase">Registrate</h2>
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="../uploads/draw2.svg" class="img-fluid" alt="register-image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form method="post" action="api">
                        <!-- User input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" class="form-control form-control-lg" id="nameUser" name="nameUser" />
                            <label class="form-label" for="nameUser">Nombre usuario <span style="color:red">*</span></label>
                        </div>
                        <!-- Phone input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="number" class="form-control form-control-lg" id="telefono" name="telefono" />
                            <label class="form-label" for="telefono">Teléfono <span style="color:red">*</span></label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <div class="input-group mb-1">
                                <input type="password" id="contra" class="form-control form-control-lg"
                                    autocomplete="new-password" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary bg-secondary" type="button" id="button-addon2"
                                    onclick="mostrarContra();"><i id="icono"
                                        class="bi bi-eye-slash text-white"></i></button>
                                <button type="button" class="btn btn-light" popovertarget="message"
                                    popovertargetaction="toggle"><i class="bi bi-question-circle"></i></button>

                                <div id="message" class="rounded p-2 bg-secondary"
                                    style="margin: 0 auto;text-align:center;" popover>
                                    <p class="text-white">
                                        La contraseña requiere:<br>
                                        1 minuscula<br>
                                        1 MAYUSCULA<br>
                                        1 numero (0-9)<br>
                                        1 carac. especial!!!<br>
                                        Entre 8 y 15 carac.<br>
                                        N o e s p a c i o s <br>
                                    </p>
                                </div>


                            </div>
                            <label for="contra" class="mx-1">Contraseña <span style="color:red">*</span></label>
                        </div>
                        <!--Imagen Perfil -->
                        <div class="d-flex flex-column mb-3">
                            <span>Definir imagen de perfil. (Opcional)</span>
                

                            <div id="divImagen">
                                <input id="inputImg" accept="image/*" type="file">
                                <label for="inputImg"  class="inputFalso overflow-hidden ">Cargar Imagen</label>
                                <div id="vistaPrevia">
                                    
                                </div>
                            </div>
                            

                        </div>

                        <!-- captcha-->
                        <div class="g-recaptcha" data-sitekey="6LdJffgqAAAAAPKNIYQ35mOvtBLHuXkZcTry9Hef"></div>


                        <div class="d-flex justify-content-around align-items-center mb-4">


                            <a href="/pages/login">Iniciar sesión</a>
                        </div>

                        <!-- Submit button -->
                        <div class="d-flex justify-content-evenly align-items-center ">
                            <button id="enviar" type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-lg btn-block" onclick="enviarForm(event);">Iniciar</button>
                            <button type="button" class="btn btn-dark btn-lg btn-block "
                                onclick="volver();">Salir</button>
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0 text-muted">O</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <a data-mdb-ripple-init class="btn btn-primary btn-sm btn-block"
                                style="background-color: #3b5998" href="#!" role="button">
                                <i class="fab fa-facebook-f me-2"></i>Continua con Facebook
                            </a>
                            <a data-mdb-ripple-init class="btn btn-primary btn-sm btn-block"
                                style="background-color: #55acee" href="#!" role="button">
                                <i class="fab fa-twitter me-2"></i>Continua con Twitter</a>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>

        const controller = new AbortController();
        const signal = controller.signal;
        const divDesc = document.getElementById('desc');
        const botonInfo = document.getElementById('botonInfo');
        const botonMostrarC = document.getElementById('contra');
        const iconoCambio = document.getElementById('icono');
        const divInfoOculto = document.getElementById('oculto');
        var imagenPerfil;
        

        document.getElementById('inputImg').addEventListener("change", function(){
                let archivo = this.files.length > 0 ? Array.from(this.files).map(file=>file.name).join(" + "): "Ningun archivo seleccionado";
                $inputfalso = document.querySelector(".inputFalso");
                $inputfalso.textContent = archivo;
            });
            document.getElementById('inputImg').addEventListener('change', function(event){
                let filas = event.target.files;

                let limpiarPrev = document.getElementById('vistaPrevia');
                limpiarPrev.innerHTML = "";

                

                if(filas.length>0){
                    let reader = new FileReader();
                    reader.onload = function(e){
                        imagenPerfil = e.target.result;
                    let crearImg = document.createElement("img");
                    crearImg.src= imagenPerfil;
                    crearImg.style.width = '100%';
                   
                    crearImg.style.border = 'solid';
                    limpiarPrev.appendChild(crearImg);
                    }
                    reader.readAsDataURL(filas[0]);
                }
               
            });


       

        function mostrarContra() {
            if (botonMostrarC.type === "password") {
                botonMostrarC.type = "text";

            } else {
                botonMostrarC.type = "password"
            }

            icono.classList.toggle('bi-eye');
            icono.classList.toggle('bi-eye-slash')



        }

       
        function volver() {
            window.location.href = '/';
        }
        function irLogin() {
            window.location.href = '/pages/login';
        }

        function obtenerDatos() {
            event.preventDefault();
            const nameUser = document.getElementById('nameUser').value;

            if (nameUser.trim() === '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: 'Campo alias necesario'
                });
            } else {
                fetch(`<?php echo $BASE_URL?>api/get-user?user=${nameUser}`, {
                    method: 'GET',
                })
                    .then(respuesta => {
                        if (respuesta.ok) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuario obtenido',
                                text: 'Usuario obtenido correctamente'
                            });
                            return respuesta.json();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al obtener usuario'
                            })
                        }

                    })
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error("error: ", error);
                    })
            }
        }

        function enviarDatos() {

            const nameUser = document.getElementById('nameUser').value;
            const telefono = document.getElementById('telefono').value;
            const contra = document.getElementById('contra').value;
            
            const captchaResponse = grecaptcha.getResponse();
          
            var data = {
                nameUser: nameUser,
                telefono: telefono,
                contra: contra,
                'g-recaptcha-response': captchaResponse,
                imagenPerfil: imagenPerfil
            }

            fetch("<?php echo $BASE_URL?>api/save-user", {
                method: "POST",
                signal: signal,
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    response.json()
                    if (response.ok) {
                        document.getElementById("enviar").disabled = true;
                        irLogin();
                    } else if (response.status === 409) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: 'Usuario ya en uso'
                        });

                    } else if (response.status === 400) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: "Completa el captcha"
                        })
                    }

                })
                .then(data => console.log(data))
                .catch(error => console.error("Error:", error))

        }

        function enviarForm(event) {
            event.preventDefault();

            const regexContra = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;
            const nameUser = document.getElementById('nameUser').value;
            const telefono = document.getElementById('telefono').value;
            const contra = document.getElementById('contra').value;
         


            if (nameUser.length < 3 || nameUser.length > 12) {
               
                Swal.fire({
                    title: "Info",
                    text: "El campo nombre debe tener entre 3 y 12 caracteres",
                    icon: "info"
                });

            } else if (telefono.length < 6) {
                Swal.fire({
                    title: "Info",
                    text: "Campo telefono incompleto",
                    icon: "info"
                });

            } else if (!regexContra.test(contra)) {
                Swal.fire({
                    title: "Info",
                    text: "La contraseña no cumple con las condiciones",
                    icon: "info"
                });


            }else {
                enviarDatos();
            }



        }




    </script>


</body>

</html>