<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" type="image/png" href="./img/icono-form.jpg">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: rgb(210, 247, 255);
            background: linear-gradient(0deg, rgba(210, 247, 255, 1) 25%, rgba(13, 204, 255, 1) 100%);
            background-repeat: no-repeat;
        }

        #botonVolver {
            position: relative;
            top: 5vh;
        }

        form {
            text-align: center;
            width: 50%;
            margin: 0 auto;
            height: 100vh;
            padding-top: 25vh;
        }
        .text-justify{
            text-align: center;
            text-align-last: center;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center" id="botonVolver">
        <button type="button" class="btn btn-dark mx-2 text-center" onclick="history.go(-1);"><i
                class="bi bi-arrow-left"></i> Volver</button>
    </div>
    <form class="form" id="formCorreo" method="post">
        <h2 class="titulo">Registrate</h2>

        <p type="Alias:"><input placeholder="Nombre" name="nameUser" class="form-control" id="nameUser"></input></p>

        <p type="Phone:"><input placeholder="Phone" type="number" class="form-control" name="telefono"
                id="telefono"></input></p>
        <p type="Password: "><input placeholder="Password" aria-describedby="desc" type="password" class="form-control"
                name="password" id="password" autocomplete="new-password"></input></p>
        <div id="desc">
           <p class="text-justify">
           Minimo 8 caracteres<br>
            Maximo 15<br>
            Al menos una mayúscula<br>
            Al menos una minuscula<br>
            Al menos un dígito<br>
            No espacios en blanco<br>
            Al menos 1 caracter especial<br>
           </p></div>
        <div class="d-flex justify-content-center">

            <button type="button" class="btn btn-dark" id="botonEnvio" onclick="enviarForm();">Enviar</button>
            <!-- <button type="button" class="btn btn-dark mx-2" id="botonEnvi" onclick="obtenerDatos();">get info</button> -->
        </div>

    </form>


    <div>

    </div>

    <script>

        const controller = new AbortController();
        const signal = controller.signal;
        const divDesc = document.getElementById('desc');
        divDesc.style.display = 'none';

        function volver() {
            window.location.href = 'index.php';
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
                fetch(`https://localhost/app_duv/api.php/get-user?user=${nameUser}`, {
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
            const contra = document.getElementById('password').value;

            var data = {
                nameUser: nameUser,
                telefono: telefono,
                contra: contra
            }

            fetch("http://localhost/app_duv/api.php/save-user", {
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Listo',
                            text: 'Registrado correctamente'
                        })
                    } else if (!response.ok) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Usuario ya en uso'
                        });
                        controller.abort();
                    }

                })
                .then(data => console.log(data))
                .catch(error => console.error("Error:", error))

        }

        function enviarForm() {
            const regexContra = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;
            const nameUser = document.getElementById('nameUser').value;
            const telefono = document.getElementById('telefono').value;
            const contra = document.getElementById('password').value;


            if (nameUser.length < 3) {
                Swal.fire({
                    title: "Info",
                    text: "Campo nombre incompleto",
                    icon: "info"
                });

            } else if (telefono.length < 6) {
                Swal.fire({
                    title: "Info",
                    text: "Campo telefono incompleto",
                    icon: "info"
                });

            } else if (!regexContra.test(contra.value)) {
                Swal.fire({
                    title: "Info",
                    text: "La contraseña no cumple con las condiciones",
                    icon: "info"
                });
                divDesc.style.display = 'block';

            } else {

                enviarDatos();



            }



        }
    </script>


</body>

</html>